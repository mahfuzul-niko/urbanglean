<style>
    .header__topbar {
        padding: 5px !important;
    }

    .header__topbar {
        background-color: <?php echo optional($business)->header_topbar_bg_color; ?> !important;
        border-bottom: 2px solid var(--logo-color);
    }

    .header__shipping--text__link:hover {
        color: var(--logo-color)
    }

    .header_topbar_text_color {
        color: <?php echo optional($business)->header_topbar_text_color; ?> !important;
    }
</style>
<div class="row">
    <marquee behavior="scroll" direction="left">{{ optional($business)->header_marquee_text }}</marquee>
</div>
<div class="header__topbar d-sm-2-none">
    <div class="container-fluid">
        <div class="header__topbar--inner d-flex align-items-center justify-content-between">
            <div class="header__shipping">
                <ul class="header__shipping--wrapper d-flex">
                    {{-- Call --}}
                    {{-- <li class="header__shipping--text"><a href="tel:{{ optional($business)->phone }}"
                            class="header__shipping--text__link header_topbar_text_color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-phone">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                            {{ optional($business)->phone }}</a></li> --}}
                    <li class="header__shipping--text"><a href="{{ optional($business)->facebook }}"
                            class="header__shipping--text__link header_topbar_text_color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-facebook">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.5l.5-4H14V7a1 1 0 0 1 1-1h3z" />
                            </svg>

                            </svg>FaceBook</a></li>
                    <li class="header__shipping--text"><a href="{{ optional($business)->instagram }}"
                            class="header__shipping--text__link header_topbar_text_color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-instagram">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>

                            </svg>Instagram</a></li>

                    <li class="header__shipping--text"><a href="{{ route('order.track') }}"
                            class="header__shipping--text__link header_topbar_text_color">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-truck">
                                <rect x="1" y="3" width="15" height="13"></rect>
                                <polygon points="16 8 20 8 23 11 23 16 16 16 16 8"></polygon>
                                <circle cx="5.5" cy="18.5" r="2.5"></circle>
                                <circle cx="18.5" cy="18.5" r="2.5"></circle>
                            </svg>
                            Track Your Order</a></li>
                </ul>
            </div>
            <div class="language__currency">
                <ul class="d-flex align-items-center">
                    {{-- Account --}}
                    @if (Auth::check())
                        <li class="header__shipping--text d-lg-block">
                            <a href="{{ route('customer.account') }}"
                                class="header__shipping--text__link header_topbar_text_color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                {{ user()->name }} </a>
                        </li>
                    @else
                        <li class="header__shipping--text  d-lg-block">
                            <a href="{{ route('login') }}"
                                class="header__shipping--text__link header_topbar_text_color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="feather feather-user-check">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <polyline points="17 11 19 13 23 9"></polyline>
                                </svg>
                                Login </a>
                        </li>
                        <li class="header__shipping--text d-lg-block">
                            <a href="{{ route('register') }}"
                                class="header__shipping--text__link header_topbar_text_color">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round" class="feather feather-user-plus">
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="8.5" cy="7" r="4"></circle>
                                    <line x1="20" y1="8" x2="20" y2="14"></line>
                                    <line x1="23" y1="11" x2="17" y2="11"></line>
                                </svg>
                                Register </a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
