<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk | KOTOKO</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #020617;
            color: #f1f5f9;
        }

        main {
            max-width: 700px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: #111827;
            padding: 30px;
            border: 1px solid #334155;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }

        h1 {
            margin: 0 0 10px;
            color: #f8fafc;
            font-size: 25px;
        }

        .subtitle {
            margin: 0 0 28px;
            color: #94a3b8;
            font-size: 14px;
            line-height: 1.6;
        }

        .field {
            margin-bottom: 22px;
        }

        label {
            display: block;
            margin-bottom: 9px;
            color: #f1f5f9;
            font-size: 13px;
            font-weight: bold;
        }

        input,
        textarea,
        select {
            display: block;
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #475569;
            border-radius: 8px;
            background: #0f172a;
            color: #f1f5f9;
            font: inherit;
            font-size: 14px;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        input,
        select {
            min-height: 44px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.6;
        }

        input::placeholder,
        textarea::placeholder {
            color: #64748b;
        }

        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
        }

        select option {
            background: #111827;
            color: #f1f5f9;
        }

        input[type="file"] {
            padding: 8px;
            color: #cbd5e1;
        }

        input[type="file"]::file-selector-button {
            margin-right: 12px;
            padding: 8px 12px;
            border: 0;
            border-radius: 6px;
            background: #334155;
            color: #f1f5f9;
            font: inherit;
            cursor: pointer;
        }

        input[type="file"]::file-selector-button:hover {
            background: #475569;
        }

        .help-text {
            display: block;
            margin-top: 9px;
            color: #94a3b8;
            font-size: 12px;
            line-height: 1.5;
        }

        .errors {
            margin: 0 0 24px;
            padding: 14px 16px 14px 36px;
            border: 1px solid #7f1d1d;
            border-radius: 10px;
            background: #450a0a;
            color: #fecaca;
            font-size: 13px;
            line-height: 1.8;
        }

        .errors li {
            padding-left: 2px;
        }

        .form-actions {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px solid #334155;
        }

        .button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 44px;
            padding: 12px 18px;
            border: 1px solid transparent;
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            cursor: pointer;
            transition: background 0.2s, border-color 0.2s;
        }

        .primary {
            background: #2563eb;
            color: #ffffff;
        }

        .primary:hover {
            background: #1d4ed8;
        }

        .secondary {
            border-color: #475569;
            background: #1e293b;
            color: #cbd5e1;
        }

        .secondary:hover {
            border-color: #64748b;
            background: #334155;
            color: #ffffff;
        }

        .button:focus-visible {
            outline: 3px solid #60a5fa;
            outline-offset: 3px;
        }

        @media (max-width: 600px) {
            main {
                margin: 24px auto;
                padding: 0 14px;
            }

            .form-card {
                padding: 22px 18px;
            }

            h1 {
                font-size: 22px;
            }

            .form-actions {
                align-items: stretch;
            }

            .form-actions .button {
                flex: 1;
            }
        }
    </style>
</head>
<body>

    <main>
        <div class="form-card">
            <h1>Tambah Produk</h1>
            <p class="subtitle">
                Isi informasi produk yang ingin dijual.
            </p>

            @if ($errors->any())
                <ul class="errors">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="/produk" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="field">
                    <label for="name">Nama produk *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="category_id">Kategori *</label>
                    <select
                        id="category_id"
                        name="category_id"
                        required
                    >
                        <option value="">-- Pilih kategori --</option>

                        @foreach ($categories as $category)
                            <option
                                value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}
                            >
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="field">
                    <label for="description">Deskripsi</label>
                    <textarea
                        id="description"
                        name="description"
                    >{{ old('description') }}</textarea>
                </div>

                <div class="field">
                    <label for="price">Harga (Rp) *</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        min="0"
                        step="0.01"
                        value="{{ old('price') }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="stock">Stok *</label>
                    <input
                        type="number"
                        id="stock"
                        name="stock"
                        min="0"
                        step="1"
                        value="{{ old('stock', 0) }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="image">Foto produk (opsional)</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >
                    <small class="help-text">
                        Format JPG, PNG, atau WebP. Maksimal 2 MB.
                    </small>
                </div>

                <div class="form-actions">
                    <button type="submit" class="button primary">
                        Simpan Produk
                    </button>

                    <a href="/produk" class="button secondary">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </main>

</body>
</html>