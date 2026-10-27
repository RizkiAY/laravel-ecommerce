<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class CartController extends Controller
{
    /**
     * Ambil keranjang milik user yang sedang login.
     * Format array dipertahankan agar kompatibel dengan view.
     */
    private function getCart(): array
    {
        return CartItem::where('user_id', auth()->id())
            ->get()
            ->mapWithKeys(function ($item) {
                return [
                    $item->product_id => [
                        'quantity' => (int) $item->quantity,
                    ],
                ];
            })
            ->all();
    }

    public function index()
    {
        $cart = $this->getCart();

        $products = Product::whereIn('id', array_keys($cart))
            ->get()
            ->keyBy('id');

        // Hapus item jika produknya sudah tidak tersedia.
        foreach ($cart as $id => $item) {
            if (!isset($products[$id])) {
                CartItem::where('user_id', auth()->id())
                    ->where('product_id', $id)
                    ->delete();

                unset($cart[$id]);
            }
        }

        $total = 0;

        foreach ($cart as $id => $item) {
            $total += (float) $products[$id]->price
                * (int) $item['quantity'];
        }

        return view('cart.index', compact(
            'cart',
            'products',
            'total'
        ));
    }

    public function add(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int) $validated['quantity'];

        if ($product->stock < 1) {
            return back()->with('error', 'Produk sedang habis.');
        }

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        $currentQuantity = $cartItem
            ? (int) $cartItem->quantity
            : 0;

        if ($currentQuantity + $quantity > $product->stock) {
            return back()->with(
                'error',
                'Jumlah melebihi stok yang tersedia.'
            );
        }

        CartItem::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
            [
                'quantity' => $currentQuantity + $quantity,
            ]
        );

        return redirect('/keranjang')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function remove(Product $product)
    {
        CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->delete();

        return redirect('/keranjang')
            ->with('success', 'Produk dihapus dari keranjang.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        $quantity = (int) $validated['quantity'];

        if ($product->stock < 1) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Produk sedang habis.',
                ], 422);
            }

            return back()->with('error', 'Produk sedang habis.');
        }

        if ($quantity > $product->stock) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Jumlah melebihi stok yang tersedia.',
                ], 422);
            }

            return back()->with(
                'error',
                'Jumlah melebihi stok yang tersedia.'
            );
        }

        $cartItem = CartItem::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if (!$cartItem) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Produk tidak ditemukan di keranjang.',
                ], 404);
            }

            return redirect('/keranjang')
                ->with('error', 'Produk tidak ditemukan di keranjang.');
        }

        $cartItem->update([
            'quantity' => $quantity,
        ]);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'quantity' => $quantity,
            ]);
        }

        return redirect('/keranjang')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function checkout(Request $request)
    {
        // Setelah pesanan berhasil, tampilkan halaman konfirmasi.
        if (session('order_success')) {
            return view('cart.checkout', [
                'cart' => [],
                'products' => collect(),
                'total' => 0,
            ]);
        }

        $cart = $this->getCart();

        $selectedIds = $request->input(
            'selected_products',
            session('selected_products', [])
        );

        if (!is_array($selectedIds) || empty($selectedIds)) {
            return redirect('/keranjang')
                ->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $selectedIds = array_values(array_unique(
            array_map('strval', $selectedIds)
        ));

        // Hanya izinkan produk yang ada di keranjang user ini.
        $selectedCart = array_intersect_key(
            $cart,
            array_flip($selectedIds)
        );

        if (empty($selectedCart)) {
            return redirect('/keranjang')
                ->with(
                    'error',
                    'Produk yang dipilih tidak ditemukan di keranjang.'
                );
        }

        session()->put(
            'selected_products',
            array_map('strval', array_keys($selectedCart))
        );

        $products = Product::whereIn('id', array_keys($selectedCart))
            ->get()
            ->keyBy('id');

        $total = 0;

        foreach ($selectedCart as $id => $item) {
            if (isset($products[$id])) {
                $total += (float) $products[$id]->price
                    * (int) $item['quantity'];
            }
        }

        return view('cart.checkout', [
            'cart' => $selectedCart,
            'products' => $products,
            'total' => $total,
        ]);
    }

    public function processCheckout(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string', 'max:2000'],
        ]);

        $userId = auth()->id();
        $selectedIds = session()->get('selected_products', []);

        if (!is_array($selectedIds) || empty($selectedIds)) {
            return redirect('/keranjang')
                ->with('error', 'Pilih minimal satu produk untuk checkout.');
        }

        $selectedIds = array_values(array_unique(
            array_map('intval', $selectedIds)
        ));

        // Ambil hanya item yang dipilih dan milik user yang login.
        $selectedItems = CartItem::where('user_id', $userId)
            ->whereIn('product_id', $selectedIds)
            ->get();

        if ($selectedItems->isEmpty()) {
            return redirect('/keranjang')
                ->with(
                    'error',
                    'Produk yang dipilih tidak ditemukan di keranjang.'
                );
        }

        $order = DB::transaction(function () use (
            $validated,
            $selectedItems,
            $userId
        ) {
            $orderItems = [];
            $total = 0;

            foreach ($selectedItems as $cartItem) {
                $id = $cartItem->product_id;
                $quantity = (int) $cartItem->quantity;

                if ($quantity < 1) {
                    throw ValidationException::withMessages([
                        'cart' => 'Jumlah produk di keranjang tidak valid.',
                    ]);
                }

                $product = Product::whereKey($id)
                    ->lockForUpdate()
                    ->first();

                if (!$product) {
                    throw ValidationException::withMessages([
                        'cart' => "Produk dengan ID {$id} tidak ditemukan.",
                    ]);
                }

                if ($quantity > $product->stock) {
                    throw ValidationException::withMessages([
                        'cart' => "Stok {$product->name} tidak mencukupi. Stok tersedia: {$product->stock}.",
                    ]);
                }

                $subtotal = (float) $product->price * $quantity;

                $orderItems[] = [
                    'product' => $product,
                    'product_name' => $product->name,
                    'price' => $product->price,
                    'quantity' => $quantity,
                    'subtotal' => round($subtotal, 2),
                ];

                $total += $subtotal;
            }

            $order = Order::create([
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'total' => round($total, 2),
                'status' => 'pending',
            ]);

            foreach ($orderItems as $item) {
                $order->items()->create([
                    'product_id' => $item['product']->id,
                    'product_name' => $item['product_name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);

                $item['product']->decrement(
                    'stock',
                    $item['quantity']
                );
            }

            // Hapus item yang sudah dibeli dari keranjang user ini.
            CartItem::where('user_id', $userId)
                ->whereIn(
                    'product_id',
                    $selectedItems->pluck('product_id')->all()
                )
                ->delete();

            return $order;
        });

        session()->forget('selected_products');

        return redirect('/checkout')
            ->with('order_success', true)
            ->with('order_id', $order->id);
    }
}
