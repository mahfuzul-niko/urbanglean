
<!-- Start slider section -->
<div class="container-fluid">
    <div class="row slider-p pb-0">
        <div class="col-md-8 slider-pb">
            <section class="hero__slider--section">
                <div class="hero__slider--inner hero__slider--activation swiper">
                    <div class="hero__slider--wrapper swiper-wrapper">
                        @foreach($sliders as $slider) 
                        <div class="swiper-slide ">
                            <div class="hero__slider--items home1__slider--bg img-fluid" style="
                                background:url('{{ asset('images/slider/'.$slider->image ) }}'); 
                                ">
                                 <div class="container-fluid">
                                    <div class="hero__slider--items__inner">
                                        <div class="row row-cols-1">
                                            <div class="col">
                                                <div class="slider__content">
                                                    <p class="slider__content--desc desc1 mb-15">
                                                        {{-- <img class="slider__text--shape__icon" src="assets/img/icon/text-shape-icon.png" alt="text-shape-icon"> --}} {{-- New Collection --}}</p> 
                                                    {{--<h2 class="slider__content--maintitle h1">{!! optional($slider)->title !!}</h2>--}}
                                                    {{--<p class="slider__content--desc desc2 d-sm-2-none mb-40">{!! optional($slider)->description !!}</p>--}}    
                                                    <a class="slider__btn primary__btn" href="{{optional($slider)->link}}"> Show Collection
                                                        <svg class="primary__btn--arrow__icon" xmlns="http://www.w3.org/2000/svg" width="20.2" height="12.2" viewBox="0 0 6.2 6.2">
                                                        <path d="M7.1,4l-.546.546L8.716,6.713H4v.775H8.716L6.554,9.654,7.1,10.2,9.233,8.067,10.2,7.1Z" transform="translate(-4 -4)" fill="currentColor"></path>
                                                        </svg> 
                                                    </a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                        
                    </div>
                    <div class="swiper__nav--btn swiper-button-next"></div>
                    <div class="swiper__nav--btn swiper-button-prev"></div>
                </div>
            </section>
        </div>
        <div class="col-md-4">
            <div class="row mb--n28">
                <div class="col-lg-12 mb-28">
                    <div class="row row-cols-lg-2 row-cols-md-2 row-cols-sm-2 row-cols-1">
                        @foreach($sliderSideBanner as $slider) 
                            <div class="col-lg-12 col-md-12 col-6 mb-3">
                                <div class="banner__items">
                                    <a class="banner__items--thumbnail position__relative" href="{{optional($slider)->link}}">
                                        <img class="banner__items--thumbnail__img slider-side-banner" src="{{ asset('images/slider/side-banner/'.optional($slider)->image) }}" alt="banner-img"> 
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</div> 
<!-- End slider section -->