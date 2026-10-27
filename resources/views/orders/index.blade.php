
@extends('layouts.admin')

@section('title', 'Pesanan')
@section('page_heading', 'Kelola Pesanan')
@section('page_description', 'Lihat detail pesanan pelanggan dan perbarui statusnya.')

@section('content')

    <style>
        /* DAFTAR PESANAN */
        .orders-list {
            display: grid;
            gap: 20px;
        }

        .order-card {
            min-width: 0;
            padding: 22px;
            background: #111827;
            color: #e2e8f0;
            border: 1px solid #334155;
            border-radius: 14px;
            box-shadow: 0 4px 14px rgb(0 0 0 / 15%);
        }

        /* HEADER PESANAN */
        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            flex-wrap: wrap;
            gap: 18px;
            padding-bottom: 18px;
            border-bottom: 1px solid #334155;
        }

        .order-header h2 {
            margin: 0 0 14px;
            color: #f8fafc;
            font-size: 19px;
            font-weight: 700;
        }

        .order-info p {
            margin: 7px 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.6;
            overflow-wrap: anywhere;
        }

        .order-info strong {
            color: #f1f5f9;
        }

        .order-date {
            margin-top: 10px;
            color: #94a3b8;
            font-size: 13px;
        }

        /* BADGE STATUS */
        .order-status {
            display: inline-block;
            padding: 6px 11px;
            border: 1px solid #92400e;
            border-radius: 20px;
            background: #451a03;
            color: #fcd34d;
            font-size: 12px;
            font-weight: 700;
        }

        .status-pending {
            background: #451a03;
            color: #fcd34d;
            border-color: #92400e;
        }

        .status-diproses {
            background: #172554;
            color: #bfdbfe;
            border-color: #1d4ed8;
        }

        .status-dikirim {
            background: #2e1065;
            color: #ddd6fe;
            border-color: #6d28d9;
        }

        .status-selesai {
            background: #052e16;
            color: #bbf7d0;
            border-color: #15803d;
        }

        .status-dibatalkan {
            background: #450a0a;
            color: #fecaca;
            border-color: #b91c1c;
        }

        /* JUDUL DETAIL BARANG */
        .order-section-title {
            margin: 22px 0 12px;
            color: #f8fafc;
            font-size: 16px;
            font-weight: 700;
        }

        /* TABEL BARANG */
        .order-table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid #334155;
            border-radius: 8px;
        }

        .order-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            color: #e2e8f0;
            background: #111827;
        }

        .order-table th,
        .order-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #334155;
            text-align: left;
        }

        .order-table th {
            background: #1e293b;
            color: #f1f5f9;
            font-weight: 700;
            white-space: nowrap;
        }

        .order-table td {
            background: #111827;
            color: #cbd5e1;
            overflow-wrap: anywhere;
        }

        .order-table tbody tr:last-child td {
            border-bottom: none;
        }

        .order-table tbody tr:hover td {
            background: #1e293b;
        }

        /* TOTAL PESANAN */
        .order-total {
            margin-top: 18px;
            color: #f8fafc;
            text-align: right;
            font-size: 19px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        /* FORM UBAH STATUS */
        .order-update {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 22px;
            padding-top: 18px;
            border-top: 1px solid #334155;
        }

        .order-update label {
            width: 100%;
            color: #f1f5f9;
            font-size: 14px;
        }

        .order-update select {
            min-width: 180px;
            max-width: 100%;
            padding: 11px 12px;
            border: 1px solid #475569;
            border-radius: 8px;
            background: #0f172a;
            color: #f1f5f9;
            font: inherit;
        }

        .order-update select option {
            background: #111827;
            color: #f1f5f9;
        }

        .order-update select:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 1px;
            border-color: #3b82f6;
        }

        .order-update button {
            padding: 11px 16px;
            border: 1px solid #3b82f6;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
        }

        .order-update button:hover {
            background: #1d4ed8;
        }

        /* BELUM ADA PESANAN */
        .order-empty {
            padding: 40px 20px;
            border: 1px dashed #475569;
            border-radius: 14px;
            background: #111827;
            color: #e2e8f0;
            text-align: center;
        }

        .order-empty h2 {
            margin-top: 0;
            color: #f8fafc;
            font-size: 19px;
        }

        .order-empty p {
            color: #cbd5e1;
            font-size: 14px;
        }

        /* PESAN VALIDASI */
        .order-error {
            margin-bottom: 18px;
            padding: 13px 16px;
            border: 1px solid #991b1b;
            border-radius: 8px;
            background: #450a0a;
            color: #fecaca;
        }

        /* PAGINATION */
        .orders-pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 24px;
            font-size: 14px;
        }

        .page-button {
            display: inline-block;
            padding: 9px 14px;
            border: 1px solid #475569;
            border-radius: 8px;
            background: #111827;
            color: #e2e8f0;
            text-decoration: none;
            font-size: 14px;
            line-height: 1.4;
            transition: background 0.2s, color 0.2s;
        }

        .page-button:hover:not(.disabled) {
            background: #2563eb;
            border-color: #3b82f6;
            color: #ffffff;
        }

        .page-button.disabled {
            background: #1e293b;
            color: #64748b;
            border-color: #334155;
            cursor: not-allowed;
        }

        .page-info {
            color: #cbd5e1;
            font-size: 14px;
        }

        /* FOKUS KEYBOARD */
        .order-update button:focus-visible,
        .page-button:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: 3px;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            .order-card {
                padding: 16px;
            }

            .order-update {
                align-items: stretch;
                flex-direction: column;
            }

            .order-update select,
            .order-update button {
                width: 100%;
            }

            .order-total {
                font-size: 17px;
            }
        }
    </style>

    @if ($errors->any())
        <div style="margin-bottom: 18px; padding: 13px 16px; border-radius: 8px; background: #fee2e2; color: #b91c1c;">
            @foreach ($errors->all() as $error)
                <p style="margin: 4px 0;">{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if ($orders->isEmpty())
        <div class="order-empty">
            <h2>Belum ada pesanan</h2>
            <p>Pesanan yang berhasil dibuat akan muncul di halaman ini.</p>
        </div>
    @else
        <div class="orders-list">
            @foreach ($orders as $order)
                <article class="order-card">
                    <div class="order-header">
                        <div class="order-info">
                            <h2>Pesanan #{{ $order->id }}</h2>

                            <p>
                                <strong>Pelanggan:</strong>
                                {{ $order->customer_name }}
                            </p>

                            <p>
                                <strong>Telepon:</strong>
                                {{ $order->phone }}
                            </p>

                            <p>
                                <strong>Alamat:</strong>
                                {{ $order->address }}
                            </p>
                        </div>

                        <div>
                            <span class="order-status status-{{ $order->status }}">
                                {{ ucfirst($order->status) }}
                            </span>

                            <p class="order-date">
                                {{ $order->created_at->format('d-m-Y H:i') }}
                            </p>
                        </div>
                    </div>

                    <h3 class="order-section-title">Detail Barang</h3>

                    <div class="order-table-wrap">
                        <table class="order-table">
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($order->items as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>
                                            Rp {{ number_format((float) $item->price, 0, ',', '.') }}
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>
                                            Rp {{ number_format((float) $item->subtotal, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">
                                            Belum ada detail barang untuk pesanan ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="order-total">
                        Total: Rp {{ number_format((float) $order->total, 0, ',', '.') }}
                    </div>

                    <form
                        action="{{ url('/pesanan/' . $order->id . '/status') }}"
                        method="POST"
                        class="order-update"
                    >
                        @csrf
                        @method('PUT')

                        <label for="status-{{ $order->id }}">
                            <strong>Ubah Status Pesanan</strong>
                        </label>

                        <select
                            name="status"
                            id="status-{{ $order->id }}"
                            required
                        >
                            <option value="pending" @selected($order->status === 'pending')>
                                Pending
                            </option>
                            <option value="diproses" @selected($order->status === 'diproses')>
                                Diproses
                            </option>
                            <option value="dikirim" @selected($order->status === 'dikirim')>
                                Dikirim
                            </option>
                            <option value="selesai" @selected($order->status === 'selesai')>
                                Selesai
                            </option>
                            <option value="dibatalkan" @selected($order->status === 'dibatalkan')>
                                Dibatalkan
                            </option>
                        </select>

                        <button type="submit">Simpan Status</button>
                    </form>
                </article>

            @endforeach
        </div>

        <div class="orders-pagination">
            @if ($orders->previousPageUrl())
                <a href="{{ $orders->previousPageUrl() }}" class="page-button">
                    &laquo;
                </a>
            @else
                <span class="page-button disabled">
                    &laquo;
                </span>
            @endif

            <span class="page-info">
                Halaman {{ $orders->currentPage() }} / {{ $orders->lastPage() }}
            </span>

            @if ($orders->nextPageUrl())
                <a href="{{ $orders->nextPageUrl() }}" class="page-button">
                    &raquo;
                </a>
            @else
                <span class="page-button disabled">
                    &raquo;
                </span>
            @endif
        </div>

    @endif
@endsection

