<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk | KOTOKO</title>

    <style>
        * { box-sizing: border-box; }

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

        main {
            max-width: 650px;
            margin: 40px auto;
            padding: 0 20px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
        }

        .field { margin-bottom: 20px; }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 8px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font: inherit;
        }

        textarea {
            min-height: 110px;
            resize: vertical;
        }

        button, .back {
            display: inline-block;
            padding: 12px 18px;
            border: 0;
            border-radius: 8px;
            font-size: 15px;
            text-decoration: none;
            cursor: pointer;
        }

        button {
            background: #2563eb;
            color: white;
        }

        .back {
            background: #e5e7eb;
            color: #1f2937;
            margin-left: 8px;
        }

        .errors {
            color: #991b1b;
            background: #fee2e2;
            padding: 12px 12px 12px 32px;
            border-radius: 8px;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">KOTOKO.</div>
    </header>

    <main>
        <div class="card">
            <h1>Edit Produk</h1>
            <p>Perbarui informasi produk di bawah ini.</p>

            @if ($errors->any())
                <ul class="errors">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <form action="/produk/{{ $product->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="field">
                    <label for="name">Nama produk *</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $product->name) }}"
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
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
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
                    >{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="field">
                    <label for="price">Harga (Rp) *</label>
                    <input
                        id="price"
                        name="price"
                        type="number"
                        min="0"
                        step="0.01"
                        value="{{ old('price', $product->price) }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="stock">Stok *</label>
                    <input
                        id="stock"
                        name="stock"
                        type="number"
                        min="0"
                        step="1"
                        value="{{ old('stock', $product->stock) }}"
                        required
                    >
                </div>

                <div class="field">
                    <label for="image">Ganti foto produk (opsional)</label>

                    @if ($product->image)
                        <p>Foto saat ini:</p>
                        <img
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                            style="width: 150px; height: 150px; object-fit: cover; border-radius: 8px;"
                        >
                    @endif

                    <input
                        type="file"
                        id="image"
                        name="image"
                        accept=".jpg,.jpeg,.png,.webp"
                    >

                    <small>Kosongkan jika tidak ingin mengganti foto.</small>
                </div>

                <button type="submit">Simpan Perubahan</button>
                <a href="/produk" class="back">Batal</a>
            </form>
        </div>
    </main>
</body>
</html>
