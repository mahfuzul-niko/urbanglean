<style>
    /* Wrapper */
    .product__img-wrapper {
        position: relative;
        display: inline-block;
        overflow: hidden;
        width: 100%;
        border-radius: 10px;
    }

    /* Default images */
    .product__primary--img,
    .product__secondary--img {
        display: block;
        width: 100%;
        transition: opacity 0.4s ease, transform 0.4s ease, visibility 0.4s ease;
    }

    /* Secondary hidden by default */
    .product__secondary--img {
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
        visibility: hidden;
        pointer-events: none;
    }

    /* ✅ Trigger swap when hovering the whole card */
    .product__items:hover .product__primary--img {
        opacity: 0;
        visibility: hidden;
        transform: scale(1.05);
    }

    .product__items:hover .product__secondary--img {
        opacity: 1;
        visibility: visible;
        transform: scale(1.05);
    }
</style>

@if (!empty($product))
    @php
        //$stock_price = $product->single_stock;
        $stock_price = DB::table('product_stocks')
            ->where('product_id', $product->id)
            ->where('variant', '=', null)
            ->where('color', '=', null)
            ->first(['price', 'qty']);
        $variant_in_stock = DB::table('product_stocks')
            ->where('product_id', $product->id)
            ->where(function ($query) {
                $query->whereNotNull('variant')->orWhereNotNull('color');
            })
            ->where('qty', '>', 0)
            ->exists();
        $sale_text = 'sale';

        if ($product->discount_type != 'no') {
            if ($product->discount_type == 'flat') {
                $sale_text = '-' . optional($product)->discount_amount . ' TK';
            } elseif ($product->discount_type == 'percentage') {
                $sale_text = '-' . optional($product)->discount_amount . '%';
            }
        }

        if ($product->type == 'single' && optional($stock_price)->qty <= 0) {
            $sale_text = 'Out of Stock';
        } else {
            $stock_price = DB::table('product_stocks')
                ->where('product_id', $product->id)
                ->first(['id', 'price', 'qty']);

            //$variations = $product->variation_stock;
            //$min_price = $variations->min('price');
            //$max_price = $variations->max('price');
        }

    @endphp

    <div class="col mb-30 py-3 rounded product_col">
        <div class="product__items">
            <div class="product__items--thumbnail">

                <a class="product__items--link"
                    href="{{ route('single.product', [$product->id, Str::slug($product->title)]) }}">
                    <div class="product__img-wrapper border-radius-10">
                        <img class="product__items--img product__primary--img product_img"
                            src="{{ asset('images/product/' . $product->thumbnail_image) }}"
                            alt="{{ $product->title }} one">

                        @if ($product->thumbnail_image2)
                            <img class="product__items--img product__secondary--img product_img"
                                src="{{ asset('images/product/' . $product->thumbnail_image2) }}"
                                alt="{{ $product->title }} two">
                        @endif
                    </div>
                </a>

                <div class="product__badge">
                    <span class="product__badge--items sale">{{ $sale_text }}</span>
                </div>
            </div>

            <div class="product__items--content text-center">
                {{-- <span class="product__items--content__subtitle">{{optional($product->brand)->title}}</span> --}}
                <h4 class="product__items--content__title"><a class="text-dark"
                        href="{{ route('single.product', [$product->id, Str::slug($product->title)]) }}">{{ Str::limit($product->title, 35) }}</a>
                </h4>

                <div class="product__items--price mb-3">
                    @if ($product->discount_type != 'no')
                        <?php
                        if ($product->discount_type == 'flat') {
                            $new_price = optional($stock_price)->price - optional($product)->discount_amount;
                        } elseif ($product->discount_type == 'percentage') {
                            $discount_amount_tk = (optional($product)->discount_amount * optional($stock_price)->price) / 100;
                            $new_price = optional($stock_price)->price - $discount_amount_tk;
                        }
                        
                        ?>
                        <span class="current__price">৳{{ number_format($new_price) }}</span>
                        <span class="price__divided"></span>
                        <span
                            class="old__price">৳{{ optional($stock_price)->price > 0 ? number_format(optional($stock_price)->price) : 0.0 }}</span>
                    @else
                        <span
                            class="current__price">৳{{ optional($stock_price)->price > 0 ? number_format(optional($stock_price)->price) : 0.0 }}</span>
                    @endif
                </div>
                {{-- <ul class="product__items--action">
                    <li class="product__items--action__list d-flex justify-content-center align-items-center gap-2">
                        @if ($product->type == 'single')
                            @if (optional($stock_price)->qty > 0)
                              
                                <button class="product__items--action__btn buy__now--cart"
                                    onclick="addToCart({{ $product->id }}, 'details', 'checkout', 'single')"
                                    type="button">
                                    <span class="add__to--cart__text"> Buy Now </span>
                                </button>
                               
                                <button class="product__items--action__btn add__to--cart" style=""
                                    onclick="addToCart({{ $product->id }}, 'only', 'cart', 'single')" type="button">
                                    <span class="add__to--cart__text"> Add to cart</span>
                                </button>
                            @else
                               
                                <a class="product__items--action__btn add__to--cart" href="javascript:void(0)">
                                    <span class="add__to--cart__text">Out of Stock </span>
                                </a>
                            @endif
                        @else
                          
                            @if
                                <a class="product__items--action__btn add__to--cart" style=""
                                    href="{{ route('single.product', [$product->id, Str::slug($product->title)]) }}">
                                    <span class="add__to--cart__text">Buy Now</span>
                                </a>
                            @else
                    
                                <a class="product__items--action__btn add__to--cart" href="javascript:void(0)">
                                    <span class="add__to--cart__text">Out of Stock </span>
                                </a>
                            @endif
                        @endif
                    </li>
                </ul> --}}
            </div>
        </div>
    </div>
@endif
