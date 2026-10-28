<div class="product-toolbar">
    <form action="{{ url('/produk') }}" method="GET" class="product-filter">
        @if (!empty($stockFilter))
            <input type="hidden" name="stock" value="{{ $stockFilter }}">
        @endif

        <input
            type="text"
            name="search"
            value="{{ $search ?? '' }}"
            placeholder="Cari nama produk..."
        >

        <select name="category_id">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $category)
                <option
                    value="{{ $category->id }}"
                    {{ (string) ($categoryId ?? '') === (string) $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Cari</button>
        <a href="{{ url('/produk') }}">Reset</a>
    </form>

    <a class="product-add-button" href="{{ url('/produk/tambah') }}">
        + Tambah Produk
    </a>
</div>

@if ($products->isEmpty())
    <div class="product-empty">
        <h2>Produk tidak ditemukan</h2>
        <p>Coba gunakan kata kunci atau kategori lain.</p>
    </div>
@else
    <div class="product-grid">
        @foreach ($products as $product)
            <article class="product-card">
                <a href="{{ url('/produk/' . $product->id) }}" class="product-image-link">
                    @if ($product->image)
                        <img
                            class="product-image"
                            src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}"
                        >
                    @else
                        <div class="product-image-placeholder">📦</div>
                    @endif
                </a>

                <div class="product-card-body">
                    @if ($product->category)
                        <span class="product-category">
                            {{ $product->category->name }}
                        </span>
                    @endif

                    <h2 class="product-name">
                        <a href="{{ url('/produk/' . $product->id) }}">
                            {{ $product->name }}
                        </a>
                    </h2>

                    @if ($product->description)
                        <p class="product-description">{{ $product->description }}</p>
                    @endif

                    <div class="product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <div class="product-stock">
                        @if ($product->stock > 0)
                            Stok: {{ $product->stock }}
                        @else
                            <span class="product-out-of-stock">Stok habis</span>
                        @endif
                    </div>

                    <a class="product-detail-button"
                       href="{{ url('/produk/' . $product->id) }}">
                        Lihat Detail
                    </a>

                    <div class="product-admin-actions">
                        <a href="{{ url('/produk/' . $product->id . '/edit') }}">Edit</a>

                        <form
                            action="{{ url('/produk/' . $product->id) }}"
                            method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')"
                        >
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
@endif
