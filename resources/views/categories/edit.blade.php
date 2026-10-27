@extends('layouts.admin')

@section('title', 'Edit Kategori')
@section('page_heading', 'Edit Kategori')
@section('page_description', 'Perbarui nama dan deskripsi kategori produk.')

@section('content')
    <style>
        .category-panel {
            padding: 24px;
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 14px;
        }

        .category-form label {
            display: block;
            margin-bottom: 7px;
            font-size: 14px;
            font-weight: bold;
        }

        .category-form input,
        .category-form textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            margin: 8px 0 16px;
            border: 1px solid #cbd5e1;
            border-radius: 7px;
            font: inherit;
        }

        .category-button {
            display: inline-block;
            padding: 11px 16px;
            color: white;
            background: #2563eb;
            border: none;
            border-radius: 7px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }

        .category-button:hover {
            background: #1d4ed8;
        }

        .category-button-cancel {
            background: #64748b;
        }

        .category-button-cancel:hover {
            background: #475569;
        }

        .category-error {
            margin: -10px 0 14px;
            color: #dc2626;
            font-size: 13px;
        }

        .category-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        /* DARK MODE: EDIT KATEGORI */
        .category-panel {
            background: #111827 !important;
            color: #e2e8f0 !important;
            border-color: #334155 !important;
        }

        /* Judul halaman dan panel */
        .category-panel h1,
        .category-panel h2,
        .category-panel h3,
        .category-panel h4 {
            color: #f8fafc !important;
        }

        /* Label form */
        .category-form label,
        .category-panel label {
            color: #f1f5f9 !important;
            font-weight: 700;
        }

        /* Input dan textarea */
        .category-form input,
        .category-form textarea,
        .category-panel input,
        .category-panel textarea {
            background: #0f172a !important;
            color: #f1f5f9 !important;
            border: 1px solid #475569 !important;
        }

        /* Placeholder */
        .category-form input::placeholder,
        .category-form textarea::placeholder,
        .category-panel input::placeholder,
        .category-panel textarea::placeholder {
            color: #94a3b8 !important;
        }

        /* Teks deskripsi dan informasi */
        .category-panel p,
        .category-panel small,
        .category-panel .text-muted {
            color: #cbd5e1 !important;
        }

        /* Pesan validasi */
        .category-error {
            color: #fca5a5 !important;
        }

        /* Tombol dengan teks yang terbaca */
        .category-button {
            color: #ffffff !important;
        }

        /* Link kembali */
        .category-panel a:not(.category-button) {
            color: #93c5fd;
        }

        .category-panel a:not(.category-button):hover {
            color: #bfdbfe;
        }

    </style>

    <section class="category-panel">
        <form
            action="{{ url('/kategori/' . $category->id) }}"
            method="POST"
            class="category-form"
        >
            @csrf
            @method('PUT')

            <label for="name">Nama Kategori</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $category->name) }}"
                placeholder="Contoh: Elektronik"
                required
            >

            @error('name')
                <p class="category-error">{{ $message }}</p>
            @enderror

            <label for="description">Deskripsi (opsional)</label>
            <textarea
                id="description"
                name="description"
                rows="4"
                placeholder="Deskripsi kategori"
            >{{ old('description', $category->description) }}</textarea>

            @error('description')
                <p class="category-error">{{ $message }}</p>
            @enderror

            <div class="category-actions">
                <button type="submit" class="category-button">
                    Simpan Perubahan
                </button>

                <a
                    href="{{ url('/kategori') }}"
                    class="category-button category-button-cancel"
                >
                    Batal
                </a>
            </div>
        </form>
    </section>
@endsection