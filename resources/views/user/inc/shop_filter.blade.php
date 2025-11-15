{{-- Start --}}
@if (request()->query())
    <div class="single__widget widget__bg d-none">
        <h2 class="widget__title h3">Brands</h2>
        <ul class="widget__categories--menu"> {{-- style="overflow-y: scroll; height:200px;" --}}
            <?php
            $category = App\Models\Category::where('id', request()->category_id)->orWhere('parent_id', request()->category_id)->first();
            ?>
            @if ($category->parent)
                {{-- $category->parent->title --}}

                @if (count($category->parent->child) > 0)
                    @foreach ($category->parent->child as $p_category)
                        @if (count($p_category->child) > 0)
                            <li class="widget__categories--menu__list ms-2 me-1">
                                {{-- sub category with sub sub category  --}}
                                <label class="widget__categories--menu__label d-flex align-items-center">
                                    <img class="widget__categories--menu__img"
                                        src="{{ asset('images/category/' . $p_category->image) }}"
                                        alt="{{ $p_category->title }}">
                                    <span
                                        class="widget__categories--menu__text text-dark">{{ $p_category->title }}</span>
                                    <svg class="widget__categories--menu__arrowdown--icon"
                                        xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                            transform="translate(-6 -8.59)" fill="currentColor"></path>
                                    </svg>
                                </label>
                                <ul class="widget__categories--sub__menu" style="display: block;">
                                    @foreach ($p_category->child as $inner_sub_category)
                                        <li class="widget__categories--sub__menu--list ms-2">
                                            <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                                href="{{ route('products', ['category_id' => $inner_sub_category->id]) }}">
                                                <img class="widget__categories--sub__menu--img"
                                                    src="{{ asset('images/category/' . $inner_sub_category->image) }}"
                                                    alt="{{ $inner_sub_category->title }}">
                                                <span
                                                    class="widget__categories--sub__menu--text text-dark">{{ $inner_sub_category->title }}</span>
                                            </a>
                                        </li>
                                    @endforeach

                                </ul>
                            </li>
                        @else
                            <li class="widget__categories--sub__menu--list">
                                <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                    href="{{ route('products', ['category_id' => $p_category->id]) }}">
                                    <img class="widget__categories--sub__menu--img rounded shadow"
                                        src="{{ $p_category->image ? asset('images/category/' . $p_category->image) : asset('assets/dumy.png') }}"
                                        alt="{{ $p_category->title }}">

                                    <span
                                        class="widget__categories--sub__menu--text text-dark">{{ $p_category->title }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach
        </ul>
        </li>
@endif
@else
@foreach ($categories as $category)
    @if (count($category->child) > 0)
        @foreach ($category->child as $p_category)
            @if (count($p_category->child) > 0)
                <li class="widget__categories--menu__list ms-2 me-1">
                    {{-- sub category with sub sub category  --}}
                    <label class="widget__categories--menu__label d-flex align-items-center">
                        <img class="widget__categories--menu__img"
                            src="{{ asset('images/category/' . $p_category->image) }}" alt="{{ $p_category->title }}">
                        <span class="widget__categories--menu__text text-dark">{{ $p_category->title }}</span>
                        <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                            width="12.355" height="8.394">
                            <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                transform="translate(-6 -8.59)" fill="currentColor"></path>
                        </svg>
                    </label>
                    <ul class="widget__categories--sub__menu" style="display: block;">
                        @foreach ($p_category->child as $inner_sub_category)
                            <li class="widget__categories--sub__menu--list ms-2">
                                <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                    href="{{ route('products', ['category_id' => $inner_sub_category->id]) }}">
                                    <img class="widget__categories--sub__menu--img"
                                        src="{{ asset('images/category/' . $inner_sub_category->image) }}"
                                        alt="{{ $inner_sub_category->title }}">
                                    <span
                                        class="widget__categories--sub__menu--text text-dark">{{ $inner_sub_category->title }}</span>
                                </a>
                            </li>
                        @endforeach

                    </ul>
                </li>
            @else
                <li class="widget__categories--sub__menu--list">
                    <a class="widget__categories--sub__menu--link d-flex align-items-center"
                        href="{{ route('products', ['category_id' => $p_category->id]) }}">
                        <img class="widget__categories--sub__menu--img rounded shadow"
                            src="{{ $p_category->image ? asset('images/category/' . $p_category->image) : asset('assets/dumy.png') }}"
                            alt="{{ $p_category->title }}">

                        <span class="widget__categories--sub__menu--text text-dark">{{ $p_category->title }}</span>
                    </a>
                </li>
            @endif
        @endforeach
        </ul>
        </li>
    @endif
@endforeach

@endif
</ul>
</div>
@endif
{{-- end --}}
<div style="position:sticky">
    <div class="single__widget widget__bg">
        <h2 class="widget__title h3">Categories</h2>
        <ul class="widget__categories--menu"> {{-- style="overflow-y: scroll; height:200px;" --}}
            @foreach ($categories as $category)
                @if (count($category->child) > 0)
                    {{-- main category with sub categories --}}
                    <li class="widget__categories--menu__list active">
                        <a href="{{ route('products', parameters: ['category_id' => $category->id]) }}"
                            class="widget__categories--sub__menu--list m-0 pt-2 d-flex align-items-center">
                            <img class="widget__categories--menu__img rounded shadow"
                                src="{{ $category->image ? asset('images/category/' . $category->image) : asset('assets/dumy.png') }}"
                                alt="{{ $category->title }}">
                            <span class="widget__categories--menu__text text-dark">{{ $category->title }}</span>
                            {{-- <svg class="widget__categories--menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg"
                                width="12.355" height="8.394">
                                <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                    transform="translate(-6 -8.59)" fill="currentColor"></path>
                            </svg> --}}
                        </a>

                        {{-- sub categories --}}
                        <ul class="widget__categories--sub__menu" style="box-sizing: border-box; display: block;">
                            @foreach ($category->child as $p_category)
                                {{-- @if (count($p_category->child) > 0)
                                    <li class="widget__categories--menu__list ms-2 me-1">
                                        <label class="widget__categories--menu__label d-flex align-items-center">
                                            <img class="widget__categories--menu__img rounded shadow"
                                                src="{{ $p_category->image ? asset('images/category/' . $p_category->image) : asset('assets/dumy.png') }}"
                                                alt="{{ $p_category->title }}">
                                            <span
                                                class="widget__categories--menu__text text-dark">{{ $p_category->title }}</span>
                                            <svg class="widget__categories--menu__arrowdown--icon"
                                                xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394">
                                                <path
                                                    d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z"
                                                    transform="translate(-6 -8.59)" fill="currentColor"></path>
                                            </svg>
                                        </label>

                                        <ul class="widget__categories--sub__menu">
                                            @foreach ($p_category->child as $inner_sub_category)
                                                <li class="widget__categories--sub__menu--list ms-2">
                                                    <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                                        href="{{ route('products', ['category_id' => $inner_sub_category->id]) }}">
                                                        <img class="widget__categories--sub__menu--img rounded shadow"
                                                            src="{{ $inner_sub_category->image ? asset('images/category/' . $inner_sub_category->image) : asset('assets/dumy.png') }}"
                                                            alt="{{ $inner_sub_category->title }}">
                                                        <span
                                                            class="widget__categories--sub__menu--text text-dark">{{ $inner_sub_category->title }}</span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @else --}}
                                    {{-- subcategory without inner subcategories --}}
                                    <li class="widget__categories--sub__menu--list">
                                        <a class="widget__categories--sub__menu--link d-flex align-items-center"
                                            href="{{ route('products', ['category_id' => $p_category->id]) }}">
                                            <img class="widget__categories--sub__menu--img rounded shadow"
                                                src="{{ $p_category->image ? asset('images/category/' . $p_category->image) : asset('assets/dumy.png') }}"
                                                alt="{{ $p_category->title }}">
                                            <span
                                                class="widget__categories--sub__menu--text text-dark">{{ $p_category->title }}</span>
                                        </a>
                                    </li>
                                {{-- @endif --}}
                            @endforeach
                        </ul>
                    </li>
                @else
                    {{-- category without any subcategory --}}
                    <li class="widget__categories--menu__list">
                        <a class="widget__categories--menu__label d-flex align-items-center"
                            href="{{ route('products', ['category_id' => $category->id]) }}">
                            <img class="widget__categories--menu__img rounded shadow"
                                src="{{ $category->image ? asset('images/category/' . $category->image) : asset('assets/dumy.png') }}"
                                alt="{{ $category->title }}">
                            <span class="widget__categories--menu__text text-dark">{{ $category->title }}</span>
                        </a>
                    </li>
                @endif
            @endforeach

        </ul>
    </div>
</div>
