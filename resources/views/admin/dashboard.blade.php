
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page_heading', 'Dashboard')
@section('page_description', 'Ringkasan dan informasi toko online KOTOKO.')

@section('content')
    <h2 style="font-size:18px; margin:0 0 18px;">
        Ringkasan Toko
    </h2>

    <section class="dashboard-stats">
        <div class="dashboard-stat-card">
            <div class="dashboard-stat-label">Total Produk</div>
            <div class="dashboard-stat-value">
                {{ number_format($totalProducts, 0, ',', '.') }}
            </div>
            <div class="dashboard-stat-note">
                Produk yang terdaftar
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-label">Total Kategori</div>
            <div class="dashboard-stat-value">
                {{ number_format($totalCategories, 0, ',', '.') }}
            </div>
            <div class="dashboard-stat-note">
                Kategori produk
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-label">Total Pesanan</div>
            <div class="dashboard-stat-value">
                {{ number_format($totalOrders, 0, ',', '.') }}
            </div>
            <div class="dashboard-stat-note">
                Termasuk pesanan batal
            </div>
        </div>

        <div class="dashboard-stat-card">
            <div class="dashboard-stat-label">Nilai Penjualan</div>
            <div class="dashboard-stat-value dashboard-sales-value">
                Rp {{ number_format($totalSales, 0, ',', '.') }}
            </div>
            <div class="dashboard-stat-note">
                Tidak termasuk pending dan dibatalkan
            </div>
        </div>
    </section>

    <h2 class="dashboard-section-title">
        Ringkasan Stok Produk
    </h2>

    <section class="dashboard-stock-stats">
        <a href="{{ url('/produk?stock=habis') }}"
            class="dashboard-stock-card stock-empty dashboard-stock-link">
            <div class="dashboard-stock-icon">!</div>
            <div>
                <div class="dashboard-stock-label">Stok Habis</div>
                <div class="dashboard-stock-value">
                    {{ number_format($totalOutOfStock, 0, ',', '.') }}
                </div>
                <div class="dashboard-stock-note">
                    Produk dengan stok 0 atau kurang
                </div>
            </div>
        </a>

        <a href="{{ url('/produk?stock=menipis') }}"
            class="dashboard-stock-card stock-low dashboard-stock-link">
            <div class="dashboard-stock-icon">↓</div>
            <div>
                <div class="dashboard-stock-label">Stok Menipis</div>
                <div class="dashboard-stock-value">
                    {{ number_format($totalLowStock, 0, ',', '.') }}
                </div>
                <div class="dashboard-stock-note">
                    Produk dengan stok 1–5 unit
                </div>
            </div>
        </a>
    </section>

    <h2 class="dashboard-section-title">
        Ringkasan Status Pesanan
    </h2>

    <section class="dashboard-order-stats">
        <div class="dashboard-order-card order-pending">
            <div class="dashboard-order-label">Pending</div>
            <div class="dashboard-order-value">
                {{ number_format($ordersPending, 0, ',', '.') }}
            </div>
            <div class="dashboard-order-note">Menunggu diproses</div>
        </div>

        <div class="dashboard-order-card order-diproses">
            <div class="dashboard-order-label">Diproses</div>
            <div class="dashboard-order-value">
                {{ number_format($ordersDiproses, 0, ',', '.') }}
            </div>
            <div class="dashboard-order-note">Sedang disiapkan</div>
        </div>

        <div class="dashboard-order-card order-dikirim">
            <div class="dashboard-order-label">Dikirim</div>
            <div class="dashboard-order-value">
                {{ number_format($ordersDikirim, 0, ',', '.') }}
            </div>
            <div class="dashboard-order-note">Dalam pengiriman</div>
        </div>

        <div class="dashboard-order-card order-selesai">
            <div class="dashboard-order-label">Selesai</div>
            <div class="dashboard-order-value">
                {{ number_format($ordersSelesai, 0, ',', '.') }}
            </div>
            <div class="dashboard-order-note">Pesanan selesai</div>
        </div>

        <div class="dashboard-order-card order-dibatalkan">
            <div class="dashboard-order-label">Dibatalkan</div>
            <div class="dashboard-order-value">
                {{ number_format($ordersDibatalkan, 0, ',', '.') }}
            </div>
            <div class="dashboard-order-note">Pesanan dibatalkan</div>
        </div>
    </section>

@endsection

@push('styles')
<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
    }

    .dashboard-stat-card {
        padding: 22px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        box-shadow: 0 3px 10px rgba(15, 23, 42, 0.03);
    }

    .dashboard-stat-label {
        margin-bottom: 15px;
        color: #64748b;
        font-size: 13px;
    }

    .dashboard-stat-value {
        font-size: 27px;
        font-weight: bold;
        overflow-wrap: anywhere;
    }

    .dashboard-sales-value {
        font-size: 22px;
    }

    .dashboard-stat-note {
        margin-top: 10px;
        color: #94a3b8;
        font-size: 12px;
    }

    .dashboard-welcome {
        margin-top: 25px;
        padding: 25px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
    }

    .dashboard-welcome h2 {
        margin: 0 0 10px;
        font-size: 19px;
    }

    .dashboard-welcome p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
    }

    .dashboard-section-title {
        margin: 28px 0 18px;
        font-size: 18px;
    }

    .dashboard-order-stats {
        display: grid;
        grid-template-columns: repeat(5, minmax(0, 1fr));
        gap: 15px;
    }

    .dashboard-order-card {
        padding: 20px;
        border: 1px solid #334155;
        border-top: 4px solid #94a3b8;
        border-radius: 12px;
        background: #111827;
        color: #f1f5f9;
    }

    .order-pending {
        border-top-color: #d97706;
    }

    .order-diproses {
        border-top-color: #2563eb;
    }

    .order-dikirim {
        border-top-color: #7c3aed;
    }

    .order-selesai {
        border-top-color: #16a34a;
    }

    .order-dibatalkan {
        border-top-color: #dc2626;
    }

    .dashboard-order-label {
        color: #64748b;
        font-size: 13px;
        font-weight: bold;
    }

    .dashboard-order-value {
        margin-top: 12px;
        font-size: 30px;
        font-weight: bold;
        overflow-wrap: anywhere;
    }

    .dashboard-order-note {
        margin-top: 8px;
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.5;
    }

    @media (max-width: 1200px) {
        .dashboard-order-stats {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .dashboard-order-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
        }

        .dashboard-order-card {
            padding: 16px;
        }

        .dashboard-order-value {
            font-size: 25px;
        }
    }

    .dashboard-stock-stats {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
        margin-bottom: 28px;
    }

    .dashboard-stock-card {
        display: flex;
        align-items: center;
        gap: 16px;
        min-width: 0;
        padding: 22px;
        border: 1px solid #e2e8f0;
        border-radius: 14px;
        background: #111827;
        box-shadow: 0 3px 10px rgba(15, 23, 42, 0.03);
    }

    .stock-empty {
        border-left: 4px solid #dc2626;
    }

    .stock-low {
        border-left: 4px solid #d97706;
    }

    .dashboard-stock-icon {
        display: flex;
        flex-shrink: 0;
        align-items: center;
        justify-content: center;
        width: 46px;
        height: 46px;
        border-radius: 12px;
        background: #fee2e2;
        color: #b91c1c;
        font-size: 25px;
        font-weight: bold;
    }

    .stock-low .dashboard-stock-icon {
        background: #fef3c7;
        color: #92400e;
    }

    .dashboard-stock-label {
        color: #64748b;
        font-size: 13px;
        font-weight: bold;
    }

    .dashboard-stock-value {
        margin-top: 6px;
        font-size: 28px;
        font-weight: bold;
        overflow-wrap: anywhere;
    }

    .dashboard-stock-note {
        margin-top: 6px;
        color: #94a3b8;
        font-size: 12px;
        line-height: 1.5;
    }

    .dashboard-stock-link {
        color: inherit;
        text-decoration: none;
        cursor: pointer;
        transition: box-shadow 0.2s, transform 0.2s;
    }

    .dashboard-stock-link:hover {
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.08);
        transform: translateY(-2px);
    }

    .dashboard-stock-link:focus-visible {
        outline: 3px solid #2563eb;
        outline-offset: 3px;
    }

    /* DARK MODE: RINGKASAN STOK PRODUK */
    .dashboard-stock-card {
        background: #111827 !important;
        border-color: #334155;
        color: #f1f5f9;
    }

    .dashboard-stock-label,
    .dashboard-stock-value {
        color: #f1f5f9;
    }

    .dashboard-stock-note {
        color: #94a3b8;
    }

    /* DARK MODE: RINGKASAN STATUS PESANAN */
    .dashboard-order-card {
        background: #111827 !important;
        border-color: #334155;
        color: #f1f5f9;
    }

    .dashboard-order-label,
    .dashboard-order-value {
        color: #f1f5f9;
    }

    .dashboard-order-note {
        color: #94a3b8;
    }

    /* DARK MODE: RINGKASAN TOKO */
    .dashboard-stat-card {
        background: #111827 !important;
        color: #f1f5f9 !important;
        border: 1px solid #334155 !important;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
    }

    .dashboard-stat-label {
        color: #cbd5e1 !important;
    }

    .dashboard-stat-value {
        color: #f8fafc !important;
    }

    .dashboard-stat-note {
        color: #94a3b8 !important;
    }

    /* Samakan judul bagian dashboard */
    .dashboard-section-title,
    .admin-content > h2 {
        color: #f8fafc !important;
    }

    /* Pastikan semua card ringkasan konsisten */
    .dashboard-stock-card,
    .dashboard-order-card {
        background: #111827 !important;
        color: #f1f5f9 !important;
        border-color: #334155;
    }

    .dashboard-stock-label,
    .dashboard-stock-value,
    .dashboard-order-label,
    .dashboard-order-value {
        color: #f1f5f9 !important;
    }

    .dashboard-stock-note,
    .dashboard-order-note {
        color: #94a3b8 !important;
    }

    /* SAMAKAN KETEBALAN TEKS CARD RINGKASAN TOKO */

    /* Judul card: samakan dengan label stok dan status */
    .dashboard-stat-label {
        font-size: 13px;
        font-weight: bold;
        color: #f1f5f9 !important;
    }

    /* Angka utama: tebal seperti angka stok dan status */
    .dashboard-stat-value {
        font-size: 27px;
        font-weight: 700 !important;
        color: #f8fafc !important;
    }

    /* Ukuran khusus nilai penjualan tetap dipertahankan */
    .dashboard-sales-value {
        font-size: 22px;
        font-weight: 700 !important;
    }

    /* Keterangan card: tetap lebih tipis */
    .dashboard-stat-note {
        font-size: 12px;
        font-weight: 400 !important;
        color: #94a3b8 !important;
    }

    /* Pertahankan warna penanda status di bagian atas card */
    .order-pending {
        border-top-color: #f59e0b;
    }

    .order-diproses {
        border-top-color: #3b82f6;
    }

    .order-dikirim {
        border-top-color: #a78bfa;
    }

    .order-selesai {
        border-top-color: #22c55e;
    }

    .order-dibatalkan {
        border-top-color: #ef4444;
    }

    @media (max-width: 650px) {
        .dashboard-stock-stats {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .dashboard-stock-card {
            padding: 18px;
        }
    }

    @media (max-width: 1050px) {
        .dashboard-stats {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 650px) {
        .dashboard-stats {
            grid-template-columns: 1fr;
            gap: 12px;
        }

        .dashboard-stat-card {
            padding: 18px;
        }
    }
    
</style>
@endpush
