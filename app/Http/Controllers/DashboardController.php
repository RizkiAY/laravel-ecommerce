<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Order;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalOrders = Order::count();

        $totalOutOfStock = Product::where('stock', '<=', 0)->count();
        $totalLowStock = Product::whereBetween('stock', [1, 5])->count();
        // Ringkasan jumlah pesanan berdasarkan status
        $ordersPending = Order::where('status', 'pending')->count();
        $ordersDiproses = Order::where('status', 'diproses')->count();
        $ordersDikirim = Order::where('status', 'dikirim')->count();
        $ordersSelesai = Order::where('status', 'selesai')->count();
        $ordersDibatalkan = Order::where('status', 'dibatalkan')->count();

        $totalSales = Order::whereIn('status', [
            'diproses',
            'dikirim',
            'selesai',
        ])->sum('total');

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalOrders',
            'totalSales',
            'totalOutOfStock',
            'totalLowStock',
            'ordersPending',
            'ordersDiproses',
            'ordersDikirim',
            'ordersSelesai',
            'ordersDibatalkan'
        ));
    }
}