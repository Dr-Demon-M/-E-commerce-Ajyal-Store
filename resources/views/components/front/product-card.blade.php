                <div class="col-lg-3 col-md-6 col-12">
                    <!-- Start Single Product -->
                    <div class="single-product">
                        <div class="product-image">
                            <img src="{{ $product->image_Url }}" style=" width: 319px; height: 319px; object-fit: cover;">
                            @if ($product->compare_price)
                                <span class="sale-tag">%{{ $product->sale_percent }}</span>
                            @endif
                            <form action="{{ route('cart.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="button">
                                    <button type="submit" class="btn"><i class="lni lni-cart"></i> Add to Cart</button>
                                </div>
                            </form>
                        </div>
                        <div class="product-info">
                            <span class="category">{{ $product->category->name }}</span>
                            <h4 class="title">
                                <a href="{{ route('allProduct.show', "$product->slug") }}">{{ $product->name }}</a>
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
                                @if ($product->compare_price)
                                    <span class="discount-price">{{ currency($product->compare_price) }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- End Single Product -->
                </div>
