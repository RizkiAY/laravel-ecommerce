<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{

    public function index()
    {
        $orders = Order::with('items')
            ->latest()
            ->paginate(5);

        return view('orders.index', compact('orders'));
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
