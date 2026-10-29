@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page_heading', 'Kelola Produk')
@section('page_description', 'Cari, lihat, dan kelola produk toko KOTOKO.')

@section('content')

    <style>
        
        .admin-name {
            font-weight: 700;
        }

        /* TOOLBAR DAN FILTER */
        .product-toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 22px;
        }

        .product-filter {
            display: flex;
            gap: 9px;
            flex-wrap: wrap;
            flex: 1;
        }

        .product-filter input,
        .product-filter select {
            min-width: 150px;
            padding: 11px 12px;
            border: 1px solid #475569;
            border-radius: 8px;
            background: #0f172a;
            color: #f1f5f9;
            font-size: 14px;
        }

        .product-filter input::placeholder {
            color: #94a3b8;
        }

        .product-filter input:focus,
        .product-filter select:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 1px;
            border-color: #3b82f6;
        }

        .product-filter select option {
            background: #111827;
            color: #f1f5f9;
        }

        /* TOMBOL FILTER DAN DETAIL PRODUK */
        .product-filter button,
        .product-detail-button {
            display: inline-block;
            padding: 10px 14px;
            background: #0049e6;
            color: #ffffff !important;
            border: 1px solid #3b82f6;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            font-family: inherit;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease;
        }

        .product-filter button:hover,
        .product-detail-button:hover {
            background-color: #0550f2;
            border-color: #60a5fa;
            color: #ffffff !important;
        }

        /* TOMBOL TAMBAH PRODUK */
        .product-add-button {
            display: inline-block;
            padding: 10px 14px;
            background: #02ad41;
            color: #ffffff !important;
            border: 1px solid #21c95f;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            font-family: inherit;
            transition: background-color 0.2s ease,
                        border-color 0.2s ease;
        }

        .product-add-button:hover {
            background-color: #04c54b;
            border-color: #079c3d;
        }

        /* TOMBOL DETAIL PRODUK */
        .product-detail-button {
            display: block;
            text-align: center;
        }

        /* TOMBOL RESET */
        .product-filter a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            align-self: center;
            min-height: 42px;
            box-sizing: border-box;
            padding: 10px 14px;
            background: transparent;
            color: #00a8f0;
            border: 1px solid transparent;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            font-family: inherit;
            transition: color 0.2s ease,
                        border-color 0.2s ease;
        }

        .product-filter a:hover {
            color: #69bfe1;
            border-color: #334155;
            text-decoration: none;
        }

        /* PESAN SUKSES */
        .product-success {
            margin-bottom: 18px;
            padding: 13px 16px;
            border: 1px solid #166534;
            border-radius: 8px;
            background: #052e16;
            color: #bbf7d0;
        }

        /* GRID DAN CARD PRODUK */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 20px;
        }

        .product-card {
            min-width: 0;
            overflow: hidden;
            border: 1px solid #334155;
            border-radius: 13px;
            background: #111827;
            color: #e2e8f0;
            box-shadow: 0 4px 14px rgb(0 0 0 / 15%);
            transition: border-color 0.2s, transform 0.2s, box-shadow 0.2s;
        }

        .product-card:hover {
            border-color: #475569;
            box-shadow: 0 8px 22px rgb(0 0 0 / 25%);
            transform: translateY(-2px);
        }

        /* FRAME PUTIH GAMBAR PRODUK */
        .product-image-link {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 210px;
            padding: 18px;
            overflow: hidden;
            background: #ffffff;
            border-bottom: 1px solid #334155;
            color: inherit;
            text-decoration: none;
        }

        .product-image {
            display: block;
            width: 100%;
            height: 100%;
            object-fit: contain;
            background: #ffffff;
        }

        .product-image-placeholder {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: #ffffff;
            color: #99958d;
            font-size: 45px;
        }

        .product-image-placeholder {
            color: #94a3b8;
            font-size: 45px;
        }

        .product-card-body {
            padding: 17px;
            background: #111827;
            color: #e2e8f0;
        }

        /* KATEGORI */

        .product-category {
            display: inline-block;
            margin-bottom: 9px;
            padding: 5px 9px;
            border: 1px solid #1e40af;
            border-radius: 20px;
            background: #172554;
            color: #83bafd;
            font-size: 12px;
            font-weight: 700;
        }

        /* NAMA DAN DESKRIPSI */
        .product-name {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            overflow: hidden;

            margin: 0 0 9px;
            color: #f8fafc;
            font-size: 17px;
            font-weight: 700;
            overflow-wrap: anywhere;
            line-height: 1.4;
        }

        .product-name a {
            color: #f8fafc;
            text-decoration: none;
        }

        .product-name a:hover {
            color: #93c5fd;
        }

        .product-description {
            display: -webkit-box;
            overflow: hidden;
            margin: 0 0 12px;
            color: #cbd5e1;
            font-size: 13px;
            line-height: 1.6;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        /* HARGA DAN STOK */
        .product-price {
            margin: 12px 0 7px;
            color: #60a5fa;
            font-size: 19px;
            font-weight: 700;
            overflow-wrap: anywhere;
        }

        .product-stock {
            margin-bottom: 14px;
            color: #cbd5e1;
            font-size: 13px;
        }

        .product-out-of-stock {
            color: #fca5a5;
            font-weight: 700;
        }

        /* TOMBOL DETAIL */
        .product-detail-button {
            display: block;
            text-align: center;
        }

        /* AKSI ADMIN: EDIT DAN HAPUS */
        .product-admin-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 15px;
            padding-top: 13px;
            border-top: 1px solid #334155;
        }

        .product-admin-actions a {
            color: #f09800;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .product-admin-actions a:hover {
            color: #e1b569;
            text-decoration: none;
        }

        .product-admin-actions form {
            margin: 0;
        }

        .product-admin-actions button {
            padding: 0;
            border: none;
            background: transparent;
            color: #ed0000;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
        }

        .product-admin-actions button:hover {
            color: #eb6c6c;
            text-decoration: none;
        }

        /* KONDISI PRODUK KOSONG */
        .product-empty {
            padding: 35px 20px;
            border: 1px solid #334155;
            border-radius: 12px;
            background: #111827;
            color: #e2e8f0;
            text-align: center;
        }

        .product-empty h2 {
            margin-top: 0;
            color: #f8fafc;
            font-size: 18px;
        }

        .product-empty p {
            color: #cbd5e1;
        }

        /* AKSESIBILITAS FOKUS */
        .product-filter button:focus-visible,
        .product-add-button:focus-visible,
        .product-detail-button:focus-visible,
        .product-admin-actions a:focus-visible,
        .product-admin-actions button:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: 3px;
        }

        /* RESPONSIVE */
        @media (max-width: 1100px) {
            .product-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 600px) {
            .product-grid {
                grid-template-columns: 1fr;
            }

            .product-filter {
                flex-direction: column;
            }

            .product-filter input,
            .product-filter select,
            .product-filter button {
                width: 100%;
            }

            .product-add-button {
                width: 100%;
                text-align: center;
            }
        }

        /* SAMAKAN TINGGI ELEMEN DENGAN TOMBOL TAMBAH PRODUK */
        .product-filter input,
        .product-filter select {
            height: auto;
            min-height: 0;
            padding: 10px 12px;
            box-sizing: border-box;
            font-size: 14px;
            line-height: normal;
        }

        .product-filter button,
        .product-filter a {
            height: auto;
            min-height: 0;
            padding: 10px 14px;
            box-sizing: border-box;
            font-size: 14px;
            line-height: normal;
        }
    </style>

    @include('admin.products.partials.catalog')
@endsection
