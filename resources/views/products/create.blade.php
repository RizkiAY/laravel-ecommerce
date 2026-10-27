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
            background: #f5f7fb;
            color: #1f2937;
        }

        header {
            background: white;
            padding: 20px 7%;
            border-bottom: 1px solid #e5e7eb;
        }

        .logo {
            color: #2563eb;
            font-size: 24px;
            font-weight: bold;
        }

        .container {
            max-width: 650px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        h1 {
            margin-top: 0;
        }

        .subtitle {
            color: #6b7280;
            margin-bottom: 28px;
        }

        .field {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font: inherit;
        }

        input:focus, textarea:focus {
            outline: 2px solid #93c5fd;
            border-color: #2563eb;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        .button {
            display: inline-block;
            padding: 12px 18px;
            background: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        .button:hover {
            background: #1d4ed8;
        }

        .secondary {
            background: #e5e7eb;
            color: #1f2937;
            margin-left: 8px;
        }

        .secondary:hover {
            background: #d1d5db;
        }

        .errors {
            background: #fee2e2;
            color: #991b1b;
            border-radius: 8px;
            padding: 12px 12px 12px 32px;
            margin-bottom: 20px;
        }

        @media (max-width: 500px) {
            .form-card {
                padding: 20px;
            }

            .secondary {
                margin: 10px 0 0;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">KOTOKO.</div>
    </header>

    <main class="container">
        <div class="form-card">
            <h1>Tambah Produk</h1>
            <p class="subtitle">Isi informasi produk yang ingin dijual.</p>

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
                        style="width:100%; padding:12px; border:1px solid #d1d5db; border-radius:8px; font:inherit;"
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
                    <small>Format JPG, PNG, atau WebP. Maksimal 2 MB.</small>
                </div>

                <button type="submit" class="button">
                    Simpan Produk
                </button>

                <a href="/produk" class="button secondary">
                    Batal
                </a>
            </form>
        </div>
    </main>
</body>
</html>
