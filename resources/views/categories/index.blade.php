 @extends('layouts.admin')

@section('title', 'Kategori')
@section('page_heading', 'Kelola Kategori')
@section('page_description', 'Tambah dan kelola kategori produk toko KOTOKO.')

@section('content')

    <style>
        /* PANEL UTAMA */
        .category-panel {
            padding: 24px;
            margin-bottom: 24px;
            background: #111827;
            color: #e2e8f0;
            border: 1px solid #334155;
            border-radius: 14px;
        }

        .category-panel h2 {
            margin: 0 0 20px;
            color: #f8fafc;
            font-size: 19px;
            font-weight: 700;
        }

        /* FORM KATEGORI */
        .category-form label {
            display: block;
            margin-bottom: 7px;
            color: #f1f5f9;
            font-size: 14px;
            font-weight: 700;
        }

        .category-form input,
        .category-form textarea {
            display: block;
            width: 100%;
            box-sizing: border-box;
            padding: 12px;
            margin: 8px 0 16px;
            border: 1px solid #475569;
            border-radius: 7px;
            background: #0f172a;
            color: #f1f5f9;
            font: inherit;
        }

        .category-form input::placeholder,
        .category-form textarea::placeholder {
            color: #94a3b8;
        }

        .category-form input:focus,
        .category-form textarea:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 1px;
            border-color: #3b82f6;
        }

        /* TOMBOL */
        .category-button {
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
            transition: background 0.2s, border-color 0.2s;
        }

        .category-button:hover {
            background: #0049e6;
        }

        .category-button-edit {
            background: #e39000;
            border-color: #d97706;
        }

        .category-button-edit:hover {
            background: #e39000;
        }

        .category-button-delete {
            background: #e40000;
            border-color: #dc2626;
        }

        .category-button-delete:hover {
            background: #e40000;
        }

        .category-button:focus-visible {
            outline: 2px solid #93c5fd;
            outline-offset: 3px;
        }

        /* VALIDASI FORM */
        .category-error {
            margin: -10px 0 14px;
            color: #fca5a5;
            font-size: 13px;
        }

        /* NOTIFIKASI */
        .category-success {
            margin-bottom: 20px;
            padding: 12px 16px;
            color: #bbf7d0;
            background: #052e16;
            border: 1px solid #166534;
            border-radius: 8px;
        }

        .category-alert-error {
            margin-bottom: 20px;
            padding: 12px 16px;
            color: #fecaca;
            background: #450a0a;
            border: 1px solid #991b1b;
            border-radius: 8px;
        }

        /* DAFTAR KATEGORI */
        .category-list {
            display: grid;
            gap: 12px;
        }

        .category-item {
            padding: 16px;
            background: #0f172a;
            color: #e2e8f0;
            border: 1px solid #334155;
            border-radius: 9px;
            overflow-wrap: anywhere;
        }

        .category-item strong {
            color: #f8fafc;
            font-size: 15px;
            font-weight: 700;
        }

        .category-item p {
            margin: 8px 0 0;
            color: #cbd5e1;
            font-size: 14px;
            line-height: 1.6;
        }

        .category-item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            flex-wrap: wrap;
        }

        .category-actions {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .category-actions form {
            margin: 0;
        }

        /* KONDISI KATEGORI KOSONG */
        .category-empty {
            padding: 20px;
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 9px;
            color: #cbd5e1;
        }

        /* RESPONSIVE */
        @media (max-width: 600px) {
            .category-panel {
                padding: 18px;
            }

            .category-item-header {
                flex-direction: column;
            }
        }
    </style>

    <!-- @if (session('success'))
        <div class="category-success">
            {{ session('success') }}
        </div>
    @endif -->

    @if (session('error'))
        <div class="category-alert-error">
            {{ session('error') }}
        </div>
    @endif

    <section class="category-panel">
        <h2>Tambah Kategori</h2>

        <form
            action="{{ url('/kategori') }}"
            method="POST"
            class="category-form"
        >
            @csrf

            <label for="name">Nama Kategori</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
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
                rows="3"
                placeholder="Deskripsi kategori"
            >{{ old('description') }}</textarea>

            @error('description')
                <p class="category-error">{{ $message }}</p>
            @enderror

            <button type="submit" class="category-button">
                Simpan Kategori
            </button>
        </form>
    </section>

    <section class="category-panel">
        <h2>Daftar Kategori ({{ $categories->count() }})</h2>

        @if ($categories->isEmpty())
            <div class="category-empty">
                Belum ada kategori. Silakan tambahkan kategori pertama.
            </div>
        @else
            <div class="category-list">
                @foreach ($categories as $category)
                    <div class="category-item">
                        <div class="category-item-header">
                            <div>
                                <strong>{{ $category->name }}</strong>

                                @if ($category->description)
                                    <p>{{ $category->description }}</p>
                                @endif
                            </div>

                            <div class="category-actions">
                                <a
                                    href="{{ url('/kategori/' . $category->id . '/edit') }}"
                                    class="category-button category-button-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ url('/kategori/' . $category->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori {{ addslashes($category->name) }}?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="category-button category-button-delete"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </section>
@endsection