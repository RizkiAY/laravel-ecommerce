<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $allowedStatuses = [
            'pending',
            'diproses',
            'dikirim',
            'selesai',
            'dibatalkan',
        ];

        $status = $request->query('status', '');
        $orderId = $request->query('order_id', '');
        $customerId = $request->query('customer_id', '');

        $query = Order::with('items')->latest();

        // Filter berdasarkan status pesanan
        if (in_array($status, $allowedStatuses, true)) {
            $query->where('status', $status);
        } else {
            $status = '';
        }

        // Cari berdasarkan ID / nomor pesanan
        if ($orderId !== '' && ctype_digit((string) $orderId)) {
            $query->where('id', (int) $orderId);
        }

        // Cari berdasarkan ID pelanggan
        // Asumsi kolom ID pelanggan pada tabel orders adalah user_id.
        if ($customerId !== '' && ctype_digit((string) $customerId)) {
            $query->where('user_id', (int) $customerId);
        }
        
        $orders = $query->paginate(5)->withQueryString();

        return view('orders.index', compact(
            'orders',
            'status',
            'orderId',
            'customerId'
        ));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'string',
                Rule::in([
                    'pending',
                    'diproses',
                    'dikirim',
                    'selesai',
                    'dibatalkan',
                ]),
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect('/pesanan')
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }
}