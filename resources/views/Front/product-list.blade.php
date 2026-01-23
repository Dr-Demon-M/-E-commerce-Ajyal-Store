<x-front-layout title="Cart">

    <x-slot:breadcrumb>
        <div class="breadcrumbs">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-6 col-12">
                        <div class="breadcrumbs-content">
                            <h1 class="page-title">Cart</h1>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12">
                        <ul class="breadcrumb-nav">
                            <li><a href="{{ route('home') }}"><i class="lni lni-home"></i> Home</a></li>
                            <li><a href="#">Shop</a></li>
                            <li>All Product</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </x-slot:breadcrumb>


    <!-- Start Product Grids -->
    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">
                    <!-- Start Product Sidebar -->
                    <div class="product-sidebar">
                        <!-- Start Single Widget -->
                        <div class="single-widget search">
                            <h3>Search Product</h3>
                            <form action="#">
                                <input type="text" placeholder="Search Here...">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                        </div>
                        <!-- End Single Widget -->
                        <!-- Start Single Widget -->
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @foreach ($categories as $cat)
                                    <li>
                                        <a
                                            href="{{ route('products.index', $cat->slug) }}">{{ $cat->name }}</a><span>({{ $cat->products->count() }})</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- End Single Widget -->

                        <form id="filterForm" action="{{ url()->current() }}" method="GET">

                            <!-- Price Range -->
                            <div class="single-widget range">
                                <h3>Price Range</h3>
                                <input type="range" class="form-range" name="max_price" step="1" min="100"
                                    max="15000" value="{{ request('max_price', 15000) }}"
                                    oninput="rangePrimary.value=this.value" id="priceRange">
                                <div class="range-inner">
                                    <label>$</label>
                                    <input type="text" id="rangePrimary" value="{{ request('max_price', 15000) }}"
                                        readonly />
                                </div>
                            </div>

                            <!-- Store Filter -->
                            <div class="single-widget condition">
                                <h3>Filter by Brand</h3>
                                @foreach ($stores as $store)
                                    <div class="form-check">
                                        <input class="form-check-input brand-checkbox" type="checkbox" name="brands[]"
                                            value="{{ $store->id }}" id="store_{{ $store->id }}"
                                            {{ in_array($store->id, request()->get('brands', [])) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="store_{{ $store->id }}">
                                            {{ $store->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </form>
                    </div>
                    <!-- End Product Sidebar -->
                </div>

                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="product-sorting">
                                        <label for="sorting">Sort by:</label>
                                        <select class="form-control" id="sorting">
                                            <option>Popularity</option>
                                            <option>Low - High Price</option>
                                            <option>High - Low Price</option>
                                            <option>Average Rating</option>
                                            <option>A - Z Order</option>
                                            <option>Z - A Order</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                    class="lni lni-list"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @forelse ($products as $product)
                                        <div class="col-lg-4 col-md-6 col-12">
                                            <!-- Start Single Product -->
                                            <div class="single-product">
                                                <div class="product-image">
                                                    <img src="{{ $product->image_url }}" alt="#"
                                                        style="width:400px; height:300px; object-fit:cover;">
                                                    <div class="button">
                                                        <form action="{{ route('cart.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id"
                                                                value="{{ $product->id }}">
                                                            <div class="button">
                                                                <button type="submit" class="btn"><i
                                                                        class="lni lni-cart"></i> Add to Cart</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="product-info">
                                                    <span class="category">{{ $product->category->name }}</span>
                                                    <h4 class="title">
                                                        <a
                                                            href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                                    </h4>
                                                    <ul class="review">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <li>
                                                                <i
                                                                    class="lni {{ $i <= $product->rate ? 'lni-star-filled' : 'lni-star' }}"></i>
                                                            </li>
                                                        @endfor
                                                        <li><span>{{ number_format($product->rate, 1) }} Review(s)</span></li>
                                                    </ul>
                                                    <div class="price">
                                                        <span>{{ currency($product->price) }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Product -->
                                        </div>
                                    @empty
                                        <div class="card text-center my-4">
                                            <div class="card-body py-5">
                                                <h4 class="mb-2">No Products Found</h4>
                                                <p class="text-muted mb-3">Try changing your filters or search
                                                    again.</p>
                                                <a href="{{ url()->current() }}" class="btn btn-primary">
                                                    Reset Filters
                                                </a>
                                            </div>
                                        </div>
                                    @endforelse
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Pagination -->
                                        <div class="pagination left">
                                            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                        </div>
                                        <!--/ End Pagination -->
                                    </div>
                                </div>
                            </div>


                            <div class="tab-pane fade" id="nav-list" role="tabpanel"
                                aria-labelledby="nav-list-tab">
                                <div class="row">
                                    @foreach ($products as $product)
                                        <div class="col-lg-12 col-md-12 col-12">
                                            <!-- Start Single Product -->
                                            <div class="single-product">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-4 col-md-4 col-12">
                                                        <div class="product-image">
                                                            <img src="{{ $product->image_url }}" alt="#"
                                                                style="width:300px; height:250px; object-fit:cover;">
                                                            <div class="button">
                                                                <form action="{{ route('cart.store') }}"
                                                                    method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="product_id"
                                                                        value="{{ $product->id }}">
                                                                    <div class="button">
                                                                        <button type="submit" class="btn"><i
                                                                                class="lni lni-cart"></i> Add to
                                                                            Cart</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-12">
                                                        <div class="product-info">
                                                            <span
                                                                class="category">{{ $product->category->name }}</span>
                                                            <h4 class="title">
                                                                <a href="product-grids.html">{{ $product->name }}</a>
                                                            </h4>
                                                            <ul class="review">
                                                                <li><i class="lni lni-star-filled"></i></li>
                                                                <li><i class="lni lni-star-filled"></i></li>
                                                                <li><i class="lni lni-star-filled"></i></li>
                                                                <li><i class="lni lni-star-filled"></i></li>
                                                                <li><i class="lni lni-star"></i></li>
                                                                <li><span>4.0 Review(s)</span></li>
                                                            </ul>
                                                            <div class="price">
                                                                <span>{{ currency($product->price) }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Single Product -->
                                        </div>
                                    @endforeach
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Pagination -->
                                        <div class="pagination left">
                                            {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
                                        </div>
                                        <!--/ End Pagination -->
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Product Grids -->

    @push('scripts')
        <script>
            document.querySelectorAll('.brand-checkbox').forEach((checkbox) => {
                checkbox.addEventListener('change', function() {
                    document.getElementById('filterForm').submit();
                });
            });
        </script>
        <script>
            let priceTimer = null;
            document.getElementById('priceRange').addEventListener('input', function() {
                clearTimeout(priceTimer);
                document.getElementById('rangePrimary').value = this.value;
                priceTimer = setTimeout(() => {
                    document.getElementById('filterForm').submit();
                }, 2000);
            });
        </script>

        </script>
    @endpush

</x-front-layout>
