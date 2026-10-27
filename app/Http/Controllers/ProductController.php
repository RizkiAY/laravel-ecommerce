<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->query('search');
        $categoryId = $request->query('category_id');
        $stockFilter = $request->query('stock');

        $categories = \App\Models\Category::orderBy('name')->get();

        // Query dasar yang dipakai bersama
        $productsQuery = Product::query()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where('name', 'ilike', '%' . $search . '%');
            })
            ->when($categoryId, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            });

        // HALAMAN ADMIN: pertahankan pencarian dan kategori admin
        if (auth()->check() && auth()->user()->is_admin) {
            $products = (clone $productsQuery)
                ->when($stockFilter === 'habis', function ($query) {
                    $query->where('stock', '<=', 0);
                })
                ->when($stockFilter === 'menipis', function ($query) {
                    $query->whereBetween('stock', [1, 5]);
                })
                ->latest()
                ->get();

            return view('admin.products.index', compact(
                'products',
                'search',
                'categories',
                'categoryId',
                'stockFilter'
            ));
        }

        // HALAMAN KATALOG PENGGUNA: filter sidebar hanya di sini
        $sortBy = $request->query('sort_by', 'latest');
        $minPrice = $request->query('min_price');
        $maxPrice = $request->query('max_price');

        $productsQuery
            ->when(
                $minPrice !== null && $minPrice !== '',
                function ($query) use ($minPrice) {
                    $query->where('price', '>=', $minPrice);
                }
            )
            ->when(
                $maxPrice !== null && $maxPrice !== '',
                function ($query) use ($maxPrice) {
                    $query->where('price', '<=', $maxPrice);
                }
            );

        switch ($sortBy) {
            case 'price_asc':
                $productsQuery->orderBy('price', 'asc');
                break;

            case 'price_desc':
                $productsQuery->orderBy('price', 'desc');
                break;

            default:
                $sortBy = 'latest';
                $productsQuery->latest();
                break;
        }

        $products = $productsQuery
            ->paginate(12)
            ->withQueryString();

        return view('products.index', compact(
            'products',
            'search',
            'categories',
            'categoryId',
            'stockFilter',
            'sortBy',
            'minPrice',
            'maxPrice'
        ));
    }


    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function create()
    {
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        Product::create($validated);

        return redirect('/produk')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit(Product $product)
    {
        $categories = \App\Models\Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:categories,id'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product->update($validated);

        return redirect('/produk')
            ->with('success', 'Produk berhasil diperbarui!');
    }

    public function destroy(Product $product)
    {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect('/produk')
            ->with('success', 'Produk berhasil dihapus!');
    }

}
