<div class="catalog-layout">

    <aside class="catalog-sidebar">
        <form action="{{ url('/produk') }}" method="GET" class="catalog-filter-form">
            <div class="catalog-filter-heading">
                <h2>Filters</h2>
                <a href="{{ url('/produk') }}">Reset</a>
            </div>

            @if (!empty($stockFilter))
                <input type="hidden" name="stock" value="{{ $stockFilter }}">
            @endif

            <input
                type="hidden"
                name="search"
                value="{{ $search ?? request('search', '') }}"
            >

            {{-- 1. SORT BY --}}

            <div class="catalog-filter-section">
                <h3>Sort By</h3>

                <select name="sort_by" class="catalog-sort-select">
                    <option value="latest"
                        {{ request('sort_by', 'latest') === 'latest' ? 'selected' : '' }}>
                        Terbaru
                    </option>

                    <option value="price_asc"
                        {{ request('sort_by') === 'price_asc' ? 'selected' : '' }}>
                        Harga Terendah
                    </option>

                    <option value="price_desc"
                        {{ request('sort_by') === 'price_desc' ? 'selected' : '' }}>
                        Harga Tertinggi
                    </option>
                </select>
            </div>

            {{-- 2. CATEGORY --}}
            <section class="catalog-filter-section">
                <h3>Category</h3>

                <label class="catalog-radio">
                    <input
                        type="radio"
                        name="category_id"
                        value=""
                        {{ request('category_id', $categoryId ?? '') === '' ? 'checked' : '' }}
                    >
                    <span>Semua kategori</span>
                </label>

                @foreach ($categories as $category)
                    <label class="catalog-radio">
                        <input
                            type="radio"
                            name="category_id"
                            value="{{ $category->id }}"
                            {{ (string) request('category_id', $categoryId ?? '') === (string) $category->id ? 'checked' : '' }}
                        >
                        <span>{{ $category->name }}</span>
                    </label>
                @endforeach
            </section>

            {{-- 3. PRICE RANGE --}}
            <section class="catalog-filter-section">
                <h3>Price Range</h3>

                <label class="catalog-price-label" for="min_price">
                    Harga minimum (Rp)
                </label>
                <input
                    class="catalog-price-input"
                    id="min_price"
                    type="number"
                    name="min_price"
                    min="0"
                    step="1000"
                    value="{{ request('min_price') }}"
                    placeholder="Contoh: 10000"
                >

                <label class="catalog-price-label" for="max_price">
                    Harga maksimum (Rp)
                </label>
                <input
                    class="catalog-price-input"
                    id="max_price"
                    type="number"
                    name="max_price"
                    min="0"
                    step="1000"
                    value="{{ request('max_price') }}"
                    placeholder="Contoh: 500000"
                >
            </section>

            <button type="submit" class="catalog-apply-button">
                Apply Filters
            </button>
        </form>
    </aside>

    <section class="catalog-results">
        <div class="catalog-results-toolbar">
                <p class="catalog-total-items">
                    Showing
                    <strong>{{ $products->count() }}</strong>
                    Item(s)
                </p>
                @if (!empty($stockFilter))
                    <input type="hidden" name="stock" value="{{ $stockFilter }}">
                @endif

                <input
                    type="hidden"
                    name="sort_by"
                    value="{{ request('sort_by', 'latest') }}"
                >
                <input
                    type="hidden"
                    name="category_id"
                    value="{{ request('category_id', $categoryId ?? '') }}"
                >
                <input
                    type="hidden"
                    name="min_price"
                    value="{{ request('min_price') }}"
                >
                <input
                    type="hidden"
                    name="max_price"
                    value="{{ request('max_price') }}"
                >

            </form>

            @if (auth()->check() && auth()->user()->is_admin)
                <a class="product-add-button" href="{{ url('/produk/tambah') }}">
                    + Tambah Produk
                </a>
            @endif
        </div>

        @if ($products->isEmpty())
            <div class="product-empty">
                <h2>Produk tidak ditemukan</h2>
                <p>Coba ubah kata kunci atau sesuaikan filter produk.</p>
                <a href="{{ url('/produk') }}" class="product-detail-button">
                    Hapus Semua Filter
                </a>
            </div>
        @else
            <div class="product-grid">
                @foreach ($products as $product)
                    <article class="product-card">
                        <a href="{{ url('/produk/' . $product->id) }}"
                           class="product-image-link">
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
                                <p class="product-description">
                                    {{ $product->description }}
                                </p>
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

                            @if (auth()->check() && auth()->user()->is_admin)
                                <div class="product-admin-actions">
                                    <a href="{{ url('/produk/' . $product->id . '/edit') }}">
                                        Edit
                                    </a>

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
                            @endif
                        </div>
                    </article>
                @endforeach
            </div>

            @if (method_exists($products, 'links'))
                <div class="catalog-pagination">
                    {{ $products->withQueryString()->links() }}
                </div>
            @endif
        @endif
    </section>

</div>
