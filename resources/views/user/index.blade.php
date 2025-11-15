@extends('user.inc.master')
@php($business_info = business_info())

@section('title')
    Home
@endsection
@section('description')
    {{ optional($business_info)->meta_description }}
@endsection
@section('keywords')
    {{ optional($business_info)->meta_keywords }}
@endsection

@section('content')
    @include('user.partials.slider')

    {{-- Category --}}
    <section class="team__section py-4 mt-10">
        <div class="container-fluid">
            <div
                class="row 
            row-cols-xxl-6
            row-cols-xl-6
            row-cols-lg-6
            row-cols-md-3 
            row-cols-sm-3 
            row-cols-3
            justify-content-center
             ">
                @foreach ($featured_categories as $category)
                    <div class="p-2">
                        <div class="rounded shadow cat-zoom cat-py-5 cat-box">
                            <a href="{{ route('products', ['category_id' => $category->id]) }}">
                                <div class="row text-center">
                                    <div class="col-12">
                                        <img class="cat-image" style=""
                                            src="{{ asset('images/category/' . $category->image) }}"
                                            alt="{{ $category->title }}">
                                    </div>
                                    <div class="col-12 cat-title-box">
                                        <p class="cat-title"> {{ $category->title }} </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Flash Sale Offer --}}
    <div id="flash_sale_offer"></div>

    {{-- <section class="team__section py-5">
    <div class="container">
        <div class="section__heading text-center mb-50">
            <h2 title="Get your desired product from featured category" class="section__heading--maintitle">Featured Categories</h2>
        </div> 
            <div class="row 
                cat-cols-xxl-8
                cat-cols-xl-8 
                cat-cols-lg-8 
                cat-cols-md-6 
                cat-cols-sm-4 
                cat-cols-4
                ">
                 @foreach ($featured_categories as $category)
                 <div class="p-2">
                     <div class="rounded shadow cat-zoom cat-py-5 cat-box">
                         <a href="{{route('products', ['category_id'=>$category->id])}}">
                            <div class="row text-center">
                                <div class="col-12 mb-2">
                                    <img class="cat-image" style="" src="{{ asset('images/category/'.$category->image ) }}" alt="{{$category->title}}">
                                </div>
                                <div class="col-12 cat-title-box">
                                    <p class="cat-title"> {{$category->title}} </p> 
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                @endforeach
        </div>
    </div>
</section> --}}
    {{-- Featured Products --}}
    @if ($featured_products)
        <section class="product__section section--padding py-5">
            <div class="container-fluid">
                <div class="section__heading text-center mb-50">
                    <h2 title="Get your desired product from Featured Products" class="section__heading--maintitle">Featured
                        Products</h2>
                    <div class="btn_custom mb-2 ">
                        <a class=" rounded shop_more_btn"
                            href="{{ route('products.individual.group', ['slug' => 'featured']) }}">Shop More
                            <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2"
                                height="12.2" viewBox="0 0 6.2 6.2">
                                <path
                                    d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z"
                                    transform="translate(-4 -4)" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                {{-- <div class="section__heading mb-2 border-bottom d-flex d-none">
            <h2 class="section__heading--style2 flex-grow-1">Featured Products </h2>
            <div class="btn_custom mb-2 ">
                <a class=" rounded shop_more_btn" href="{{route('products.individual.group', ['slug'=>'featured'])}}">Shop More
                    <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                    <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                    </svg>
                </a>
            </div>
        </div> --}}
                <div class="product__section--inner">
                    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                        @foreach ($featured_products as $product)
                            @include('user.partials.product')
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif


    @include('user.partials.home_page_four_banner')
    {{-- Trending Now --}}
    @if ($trending_products)
        <section class="product__section section--padding pt-0" style="padding-bottom: 3rem !important;">
            <div class="container-fluid">
                <div class="section__heading text-center mb-50">
                    <h2 title="Get your desired product from Trending Now" class="section__heading--maintitle">Trending Now
                    </h2>
                    <div class="btn_custom mb-2 ">
                        <a class=" rounded shop_more_btn"
                            href="{{ route('products.individual.group', ['slug' => 'traending-now']) }}">Shop More
                            <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2"
                                height="12.2" viewBox="0 0 6.2 6.2">
                                <path
                                    d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z"
                                    transform="translate(-4 -4)" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                {{-- <div class="section__heading mb-2 border-bottom d-flex d-none">
            <h2 class="section__heading-- style2 flex-grow-1">Trending Now</h2>
            <div class="btn_custom mb-2">
                <a class=" rounded shop_more_btn" href="{{route('products.individual.group', ['slug'=>'traending-now'])}}">Shop More
                    <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                    <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                    </svg>
                </a>
            </div>
        </div> --}}
                <div class="product__section--inner">
                    <div class="row row-cols-xl-5 row-cols-lg-4 row-cols-md-3 row-cols-2 mb--n30">
                        @foreach ($trending_products as $product)
                            @include('user.partials.product')
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    @endif
    <div id="featured_products"></div>

    <div id="best_selling_productsStop"></div>
    {{-- featured brands section --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js" integrity="" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>
    <script>
        $(window).on('load', function() {
            //featured_products();
            best_selling_products();
            flash_sale_offer();
        });
    </script>
@endsection
