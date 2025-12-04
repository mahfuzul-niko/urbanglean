@extends('user.inc.master')

@section('title')
    {{ optional($product)->title }}
@endsection
@section('description')
    {{ optional($product)->meta_description }}
@endsection
@section('keywords')
    {{ optional($product)->meta_keywords }}
@endsection

@section('content')

    <style>
        .variant__input--fieldset input[type=radio]:checked+label {
            border: 2px solid var(--secondary-color);
            color: var(--secondary-color);
        }

        /* .variant__size--value {
                                                width: 6rem !important;
                                            } */
        .single-product-bg-info {
            margin-bottom: 5px;
        }

        .product-details-tab-list {
            border: 1px solid var(--secondary-color);
        }

        .product-details-tab-list:hover {
            background-color: var(--secondary-color);
            color: var(--white-color);
        }

        .product-details-tab-list.active {
            background-color: var(--secondary-color);
            color: var(--white-color);
        }
    </style>

    @php

        $stock_price = $product->single_stock;
        
        $sale_text = 'sale';
        $stock_qty = '';
        $stock_qty_text = 'In Stock';

        if ($product->discount_type != 'no') {
            if ($product->discount_type == 'flat') {
                $sale_text = 'Discount ' . optional($product)->discount_amount . ' TK';
            } elseif ($product->discount_type == 'percentage') {
                $sale_text = 'Discount ' . optional($product)->discount_amount . '%';
            }
        }

        if ($product->type == 'single') {
            if (optional($stock_price)->qty <= 0) {
                $sale_text = 'Out of Stock';
                $stock_qty_text = 'Out of Stock';
            }
            $stock_qty = optional($stock_price)->qty . ' ' . optional($product)->unit_type;
        } else {
            
            $variations = $product->variation_stock;
            $min_price = $variations->min('price');
            $max_price = $variations->max('price');

            // Check if any variant is in stock
            $variant_in_stock = DB::table('product_stocks')
                ->where('product_id', $product->id)
                ->where(function ($query) {
                    $query->whereNotNull('variant')->orWhereNotNull('color');
                })
                ->where('qty', '>', 0)
                ->exists();

            if (!$variant_in_stock) {
                $sale_text = 'Out of Stock';
                $stock_qty_text = 'Out of Stock';
            }
        }

        $reviews = App\Models\ProductsReviews::where(['product_id' => optional($product)->id])
            ->where('is_active', 1)
            ->orderBy('id', 'DESC')
            ->get(['id', 'customer_id', 'review_star', 'review_text', 'is_active', 'created_at']);
        $review_count = count($reviews);

        $variationProductImages = App\Models\ProductStocks::where('product_id', optional($product)->id)
            ->where('image', '!=', null)
            ->get(['image', 'id']);
    @endphp
    <!-- Start product details section -->
    <section class="single-product-section-padding">
        <div class="container-fluid">
            {{-- breadcrump --}}
            <div class="row">
                <div class="
            col-xl-10 
            col-lg-10 
            col-md-10 
            col-8">

                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-home" style="margin-top: -7px ">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    @if (!is_null($product->category))
                        <span class="capitalize"> / <a class="duration-300" style="color: #000 !important"
                                href="">{{ $product->category->title }}</a></span>
                    @endif

                    @if (!is_null($product->product_category))
                        @foreach ($product->product_category as $res)
                            <span class="capitalize"> / <a class="duration-300" style="color: #000 !important"
                                    href="">
                                    @if (!is_null($res->category))
                                        {{ $res->category->title }}
                                    @endif
                                </a></span>
                        @endforeach
                    @endif

                </div>
            </div>
            <div class="row row-cols-lg-2 row-cols-md-2">
                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                    {{-- Product Media Preview --}}
                    <div class="product__details--media">
                        <div class="product__media--preview  swiper">
                            <div class="swiper-wrapper">
                                @foreach ($product->product_image as $image)
                                    <div class="swiper-slide">
                                        <div class="product__media--preview__items">
                                            <a class="product__media--preview__items--link glightbox"
                                                data-gallery="product-media-preview"
                                                href="{{ asset('images/product/' . $image->image) }}">
                                                <img class="product__media--preview__items--img"
                                                    src="{{ asset('images/product/' . $image->image) }}"
                                                    alt="{{ $product->title }}">
                                            </a>
                                            {{-- Media View Icon --}}
                                            <div class="product__media--view__icon">
                                                {{-- ❌ Removed glightbox here to avoid duplication 
                                 ✅ Instead, trigger the first glightbox link --}}
                                                <a style="color: #000 !important" class="product__media--view__icon--link"
                                                    href="{{ asset('images/product/' . $image->image) }}"
                                                    onclick="event.preventDefault(); this.closest('.product__media--preview__items').querySelector('.glightbox').click();">
                                                    <svg class="product__media--view__icon-svg"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                                                        </path>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                @if (count($variationProductImages) > 0)
                                    @foreach ($variationProductImages as $vImage)
                                        <div class="swiper-slide">
                                            <div class="product__media--preview__items">
                                                <a class="product__media--preview__items--link glightbox"
                                                    data-gallery="product-media-preview"
                                                    href="{{ asset('images/product/' . $vImage->image) }}">
                                                    <img class="product__media--preview__items--img"
                                                        src="{{ asset('images/product/' . $vImage->image) }}">
                                                </a>
                                                <div class="product__media--view__icon">
                                                    {{-- ❌ Removed glightbox here as well 
                                     ✅ Trigger first link instead --}}
                                                    <a class="product__media--view__icon--link"
                                                        href="{{ asset('images/product/' . $vImage->image) }}"
                                                        onclick="event.preventDefault(); this.closest('.product__media--preview__items').querySelector('.glightbox').click();">
                                                        <svg class="product__media--view__icon-svg"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                            fill="none" stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round">
                                                            <path
                                                                d="M8 3H5a2 2 0 0 0-2 2v3m18 0V5a2 2 0 0 0-2-2h-3m0 18h3a2 2 0 0 0 2-2v-3M3 16v3a2 2 0 0 0 2 2h3">
                                                            </path>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="product__media--nav swiper">
                            <div class="swiper-wrapper">
                                @foreach ($product->product_image as $image)
                                    <div class="swiper-slide">
                                        <div class="product__media--nav__items">
                                            <img class="product__media--nav__items--img"
                                                src="{{ asset('images/product/' . $image->image) }}"
                                                alt="{{ $product->title }}">
                                        </div>
                                    </div>
                                @endforeach
                                @if (count($variationProductImages) > 0)
                                    @foreach ($variationProductImages as $vImage)
                                        <div class="swiper-slide">
                                            <div class="product__media--nav__items">
                                                <img class="product__media--nav__items--img"
                                                    src="{{ asset('images/product/' . $vImage->image) }}"
                                                    alt="{{ $product->title }}">
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="swiper__nav--btn swiper-button-next"></div>
                            <div class="swiper__nav--btn swiper-button-prev"></div>
                        </div>
                    </div>

                </div>
                {{-- Product__details--info --}}
                <div class="col-xl-6 col-lg-6 col-md-6 col-12">
                    <div class="product__details--info">
                        {{-- Brand --}}
                        <div class="col-md-4 col-4">
                            @if (!is_null($product->brand))
                                <a class="w-24 h-auto block" href="#{{-- route('brand.products', [$product->brand->id, Str::slug($product->brand->title)]) --}}">
                                    <img class="h-full w-full" src="{{ asset('images/brand/' . $product->brand->image) }}"
                                        alt="{{ $product->brand->image }}" title="{{ $product->brand->title }}" /></a>
                            @endif
                        </div>
                        {{-- Name --}}
                        <h2 class="product__details--info__title mb-15" title="{{ $product->title }}">
                            {{ $product->title }}</h2>
                        <div class="row">
                            <div class="col-md-12 col-12">
                                @if (!is_null($product->category))
                                    <div class="product-categories">
                                        Category:
                                        <span class="product-category"><a
                                                href="#">{{ $product->category->title }}</a></span>
                                    </div>
                                @endif
                                <div class="mb-3">
                                    {{-- Price --}}
                                    @if ($product->type == 'single')
                                        @if ($product->discount_type != 'no')
                                            <?php
                                            if ($product->discount_type == 'flat') {
                                                $old_price = $stock_price->price - optional($product)->discount_amount;
                                            } elseif ($product->discount_type == 'percentage') {
                                                $discount_amount_tk = (optional($product)->discount_amount * $stock_price->price) / 100;
                                                $old_price = $stock_price->price - $discount_amount_tk;
                                            }
                                            ?>
                                            <span class="single-product-bg-info">Cash Discount Price:
                                                {{ number_format($old_price) }}৳
                                                <strike>
                                                    {{ number_format($stock_price->price) }}৳
                                                </strike>
                                            </span>
                                        @else
                                            <span class="single-product-bg-info">Cash Price:
                                                {{ number_format($stock_price->price) }}৳</span>
                                        @endif
                                    @else
                                        <span class="single-product-bg-info"
                                            id="product_price_info{{ optional($product)->id }}">Price Range:
                                            {{ number_format($min_price) }}৳ <span class="price__divided"></span>
                                            {{ number_format($max_price) }}৳ </span>
                                    @endif
                                    {{-- Status --}}
                                    <span class="single-product-bg-info">Status: {{ $stock_qty_text }}</span>
                                    {{-- Producr Code --}}
                                    <span class="single-product-bg-info">Product Code: {{ $product->code }}</span>
                                </div>
                            </div>
                        </div>

                        @if ($review_count > 0)
                            @php
                                $total_review_star = $reviews
                                    ->filter(function ($item) {
                                        return $item->review_star > 0;
                                    })
                                    ->sum('review_star');
                                $average_review = $total_review_star / $review_count;

                            @endphp
                            {{-- Review --}}
                            <div class="product__details--info__rating d-flex align-items-center mb-15">
                                <ul class="rating d-flex justify-content-center">
                                    @for ($j = 1; $j <= $average_review; $j++)
                                        <li class="rating__list">
                                            <span class="rating__list--icon">
                                                <svg class="rating__list--icon__svg" xmlns="http://www.w3.org/2000/svg"
                                                    width="14.105" height="14.732" viewBox="0 0 10.105 9.732">
                                                    <path data-name="star - Copy"
                                                        d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                        transform="translate(0 -0.018)" fill="currentColor"></path>
                                                </svg>
                                            </span>
                                        </li>
                                    @endfor
                                </ul>
                                <span class="product__items--rating__count--number">({{ $review_count }})</span>
                            </div>
                        @endif

                        <div id="variationImage">

                        </div>

                        @if (count(optional($product)->variation_stock) > 0)
                            <form action="javascript:void(0)" method="POST"
                                id="variation_form{{ optional($product)->id }}">
                                <div class="product__variant">
                                    @if ($product->type == 'variation')
                                        <input type="hidden" name="product_type" id="product_type" value="variation">
                                        @if (optional($product)->colors != '[]')
                                            <input type="hidden" name="color_info" id="color_info" value="1">
                                            <div class="product__variant--list mb-10">
                                                <fieldset class="variant__input--fieldset">
                                                    <legend class="product__variant--title mb-8">Color :</legend>
                                                    @foreach (json_decode(optional($product)->colors, true) as $color)
                                                        <?php
                                                        $color_info = color_info($color);
                                                        ?>
                                                        @if ($loop->first)
                                                            <input id="color_{{ $color }}"
                                                                onchange="select_variation({{ optional($product)->id }})"
                                                                value="{{ $color }}" name="color"
                                                                type="radio">
                                                            <label class="variant__color--value {{ $color_info->name }}"
                                                                style="background-color: {{ $color_info->code }} !important;"
                                                                for="color_{{ $color }}" data-toggle="tooltip"
                                                                data-placement="top"
                                                                title="{{ $color_info->name }}"></label>
                                                        @else
                                                            <input id="color_{{ $color }}"
                                                                onchange="select_variation({{ optional($product)->id }})"
                                                                value="{{ $color }}" name="color"
                                                                type="radio">
                                                            <label class="variant__color--value {{ $color_info->name }}"
                                                                style="background-color: {{ $color_info->code }} !important;"
                                                                for="color_{{ $color }}"
                                                                title="{{ $color_info->name }}"></label>
                                                        @endif
                                                    @endforeach
                                                </fieldset>
                                            </div>
                                        @else
                                            <input type="hidden" name="color_info" id="color_info" value="0">
                                        @endif
                                        @if (optional($product)->attributes != null)
                                            @foreach (json_decode(optional($product)->attributes, true) as $attribute)
                                                <?php
                                                $attribute_info = variation_info($attribute);
                                                ?>
                                                @if (!is_null($attribute_info))
                                                    <?php
                                                    $single_variation_info = single_variation_info($attribute_info->id, optional($product)->id);
                                                    ?>
                                                    @if (count($single_variation_info) > 0)
                                                        <div class="product__variant--list mb-15">
                                                            <fieldset
                                                                class="variant__input--fieldset {{ $attribute_info->title }}">
                                                                <legend class="product__variant--title mb-8">
                                                                    {{ $attribute_info->title }} :</legend>
                                                                <div
                                                                    id="single_variation_info_div{{ optional($product)->id }}">
                                                                    @foreach ($single_variation_info as $variation)
                                                                        <input
                                                                            id="{{ $attribute_info->title . $variation->id }}"
                                                                            onchange="select_variation({{ optional($product)->id }})"
                                                                            value="{{ $variation->id }}"
                                                                            name="attribute_variation" type="radio">
                                                                        <label
                                                                            class="variant__size--value {{ $variation->variant_output }}"
                                                                            for="{{ $attribute_info->title . $variation->id }}">{{ $variation->variant_output }}</label>
                                                                    @endforeach
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                        @endif
                                    @else
                                        <input type="hidden" name="product_type" id="product_type" value="single">
                                    @endif
                                    <input type="hidden" name="product_id" id="product_id"
                                        value="{{ optional($product)->id }}">
                                </div>

                            </form>
                        @endif


                        <form action="javascript:void(0)" id="add_to_server{{ optional($product)->id }}" method="post">
                            <input type="hidden" name="product_id" id="product_id"
                                value="{{ optional($product)->id }}">
                            <div class="product__variant--list quantity d-flex align-items-center mb-20">
                                <div class="quantity__box">
                                    <button type="button" class="quantity__value quickview__value--quantity decrease"
                                        onclick="quantity_change('de', {{ optional($product)->id }})"
                                        aria-label="quantity value" value="Decrease Value">-</button>
                                    <label>
                                        <input type="number"
                                            class="quantity__number quickview__value--number quantity__number_{{ optional($product)->id }}"
                                            name="cart_qty_input" id="cart_qty_input" value="1" />

                                    </label>
                                    <button type="button" class="quantity__value quickview__value--quantity increase"
                                        onclick="quantity_change('in', {{ optional($product)->id }})"
                                        aria-label="quantity value" value="Increase Value">+</button>
                                </div>

                                <div class="stock-qty d-none">
                                    <p class="ps-3" id="stock_qty_show{{ optional($product)->id }}">
                                        {{ $stock_qty }}</p>

                                </div>

                            </div>

                            <div>
                                <input type="hidden" name="selected_variation_id"
                                    id="selected_variation_id{{ optional($product)->id }}" value="">

                                @if ($product->type == 'single')
                                    <input type="hidden" name="product_type" id="product_type" value="single">
                                    <input type="hidden" name="stock_qty" id="stock_qty_{{ optional($product)->id }}"
                                        value="{{ optional($stock_price)->qty }}">
                                    @if (optional($stock_price)->qty > 0)
                                        <button class="ms-0 quickview__cart--btn primary__btn"
                                            onclick="addToCart({{ optional($product)->id }}, 'details', 'cart', 'single')"
                                            id="add_to_cart_button{{ optional($product)->id }}" type="button">
                                            Add To Cart
                                        </button>
                                        <button class="quickview__cart--btn primary__btn"
                                            id="buy_now_button{{ optional($product)->id }}"
                                            onclick="addToCart({{ optional($product)->id }}, 'details', 'checkout', 'single')"
                                            type="button">Buy Now</button>
                                    @endif
                                @else
                                    <input type="hidden" name="product_type" id="product_type" value="variation">
                                    <input type="hidden" name="stock_qty" id="stock_qty_{{ optional($product)->id }}"
                                        value="0">
{{-- here  --}}
                                    {{-- Buy Now  addToCart(product_id, selected_variation_id2, type, page, product_type2) --}}
                                    <button class="quickview__cart--btn primary__btn mx-3"
                                        id="buy_now_button{{ optional($product)->id }}"
                                        onclick="addToCart({{ $product->id }}, 5, 'details', 'checkout', 'variation')"
                                        type="button">Buy Now</button>
                                    {{-- Add to cart  addToCart(product_id, selected_variation_id2, type, page, product_type2) --}}
                                    <button class="ms-0 quickview__cart--btn primary__btn"
                                        id="add_to_cart_button{{ optional($product)->id }}"
                                        onclick="addToCart({{ $product->id }}, 5, 'details', 'cart', 'variation')"
                                        type="button">Add To Cart</button>

                                    <h3 class="m-3 text-danger fw-bold"
                                        id="notification_show{{ optional($product)->id }}" style="display: none;">Please
                                        Select a Variation</h3>
                                @endif
                                @if (optional($stock_price)->qty > 0)
                                    <a class="product__items--action__btn ms-0 mx-3"
                                        onclick="addToWishlist({{ $product->id }})" href="javascript:void(0)">
                                        <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg"
                                            width="25.51" height="23.443" viewBox="0 0 512 512">
                                            <path
                                                d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z"
                                                fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="32"></path>
                                        </svg>
                                        <span class="visually-hidden">Wishlist</span>
                                    </a>
                                @endif
                            </div>
                        </form>
                    </div>
                    {{-- </form> --}}
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- End product details section -->

    <!-- Start product details tab section -->
    <section class="product__details--tab__section">
        <div class="container-fluid">
            <div class="row row-cols-1">
                <div class="col-md-8 col-sm-12">
                    <ul class="product__details--tab d-flex mb-30 mt-5" style="border-bottom:1px solid #aba8a8;">
                        <li class="product-details-tab-list col mb-3 active" data-toggle="tab"
                            data-target="#Specification">Specification</li>
                        <li class="product-details-tab-list col mb-3" data-toggle="tab" data-target="#description">
                            Description</li>
                        <li class="product-details-tab-list col mb-3" data-toggle="tab" data-target="#reviews">Reviews
                        </li>
                    </ul>
                    <div class="product__details--tab__inner border-radius-10" style="overflow: scroll;">
                        <div class="tab_content">
                            <div id="Specification" class="tab_pane active show">
                                <div class="product__tab--content">
                                    {!! optional($product)->feature !!}
                                </div>
                            </div>
                            <div id="description" class="tab_pane">
                                <div class="product__tab--content">
                                    {!! optional($product)->description !!}
                                </div>
                            </div>

                            <div id="reviews" class="tab_pane">
                                <div class="product__reviews">

                                    <div class="reviews__comment--area">

                                        @if (count($reviews) > 0)
                                            @foreach ($reviews as $review)
                                                <div class="reviews__comment--list d-flex">
                                                    <div class="reviews__comment--thumb">
                                                        <img class="shadow rounded"
                                                            src="{{ asset('images/customer/' . optional($review->customer_info)->image) }}">
                                                    </div>
                                                    <div class="reviews__comment--content">
                                                        <div class="reviews__comment--top d-flex justify-content-between">
                                                            <div class="reviews__comment--top__left">
                                                                <h3 class="reviews__comment--content__title h4">
                                                                    {{ optional($review->customer_info)->name }}</h3>
                                                                <ul class="rating reviews__comment--rating d-flex">
                                                                    @for ($i = 1; $i <= optional($review)->review_star; $i++)
                                                                        <li class="rating__list">
                                                                            <span class="rating__list--icon">
                                                                                <svg class="rating__list--icon__svg"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    width="14.105" height="14.732"
                                                                                    viewBox="0 0 10.105 9.732">
                                                                                    <path data-name="star - Copy"
                                                                                        d="M9.837,3.5,6.73,3.039,5.338.179a.335.335,0,0,0-.571,0L3.375,3.039.268,3.5a.3.3,0,0,0-.178.514L2.347,6.242,1.813,9.4a.314.314,0,0,0,.464.316L5.052,8.232,7.827,9.712A.314.314,0,0,0,8.292,9.4L7.758,6.242l2.257-2.231A.3.3,0,0,0,9.837,3.5Z"
                                                                                        transform="translate(0 -0.018)"
                                                                                        fill="currentColor"></path>
                                                                                </svg>
                                                                            </span>
                                                                        </li>
                                                                    @endfor

                                                                </ul>
                                                            </div>
                                                            <span
                                                                class="reviews__comment--content__date">{{ date('M d, Y', strtotime($review->created_at)) }}</span>
                                                        </div>
                                                        <p class="reviews__comment--content__desc">{!! optional($review)->review_text !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End product details tab section -->

    <!-- Start product section -->
    <section class="product__section product__section--style3 section--padding">
        <div class="container-fluid product3__section--container">
            <div class="section__heading text-center mb-50">
                <h2 class="section__heading--maintitle">You may also like</h2>
            </div>
            <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                @foreach ($similar_products as $product)
                    @include('user.partials.product')
                @endforeach
            </div>
        </div>
        <input type="hidden" name="" id="baseURL" value="{{ url('/') }}">
    </section>
    <!-- End product section -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        let baseUrl = $('#baseURL').val();
       

        function select_variation(product_id) {
            $('#selected_variation_id' + product_id).val('');
            $('#stock_qty_' + product_id).html(0);
            $('#stock_qty_show' + product_id).html('');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('single.product.variation.check') }}",
                method: 'post',
                data: $('#variation_form' + product_id).serialize(),
                success: function(response) {
                     console.log('response:', response);
                    if (response.variation_status == 1) {
                        if (response.image != null) {
                            $('#variationImage').html('<img class="shadow border rounded" src="' + baseUrl +
                                '/images/product/' + response.image + '" width="250px">');
                        } else {
                            $('#variationImage').html('');
                        }

                        $('#product_price_info' + product_id).html(response.price_info);

                        if (response.qty > 0) {
                            $('#stock_qty_show' + product_id).html('In Stock');
                        }

                        $('#selected_variation_id' + product_id).val(response.id);
                        $('#stock_qty_' + product_id).val(response.qty);

                        if (response.qty > 0) {
                            $('#add_to_cart_button' + product_id).show();
                            $('#buy_now_button' + product_id).show();
                            $('#notification_show' + product_id).hide();
                        } else {
                            $('#add_to_cart_button' + product_id).hide();
                            $('#buy_now_button' + product_id).hide();
                            $('#notification_show' + product_id).text('Out of Stock');
                            $('#notification_show' + product_id).show();
                        }
                    } else {
                        if (response.color_dependent_variation_status == 1) {
                            $('#single_variation_info_div' + product_id).html(response
                                .color_dependent_variation);
                        }
                    }
                }
            });
        }

        // Automatically show the first variation by default
        $(document).ready(function() {
            $('.product__variant').each(function() {
                let product_id = $(this).closest('form').attr('id').replace('variation_form', '');
                let firstInput = $(this).find('input[type=radio]').first();
                if (firstInput.length > 0) {
                    firstInput.prop('checked', true); // select first variation
                    select_variation(product_id); // load its data
                }
            });
        });
    </script>


@endsection
