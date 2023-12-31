<header class="header-wrap">
    <div class="header-wrap-inner">
        <header-search :categories="{{ $categories }}" :most-searched-keywords="{{ $mostSearchedKeywords }}"
                       is-most-searched-keywords-enabled="false"
{{--                       {{ setting('storefront_most_searched_keywords_enabled') }}--}}
                       initial-query="{{ request('query') }}" initial-category="{{ request('category') }}">
        </header-search>
        <div class="container">
            <div class="row flex-nowrap align-items-center justify-content-between position-relative">
                <div class="header-column-left">
                    <div class="sidebar-menu-icon-wrap">
                        <div class="sidebar-menu-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>
                    <div class="header-search-sm">
                        <i class="las la-search"></i>
                    </div>

                </div>
                <a href="{{ route('home') }}" class="">
                    @if (is_null($logo))
                        <h3>{{ setting('store_name') }}</h3>
                    @else
                        <img width="200px" src="{{ $logo }}" alt="logo">
                    @endif
                </a>


                <div class="header-column-right d-flex">
{{--                    <a href="{{ route('account.wishlist.index') }}" class="header-wishlist">--}}
{{--                        <div class="icon-wrap">--}}
{{--                            <i class="lar la-heart"></i>--}}
{{--                            <div class="count" v-text="wishlistCount"></div>--}}
{{--                        </div>--}}

{{--                        <span>{{ trans('storefront::layout.favorites') }}</span>--}}
{{--                    </a>--}}
                    <button class="icon-search"><i class="las la-search"></i></button>
                    <div class="header-cart">
                        <div class="icon-wrap">
                            <i class="las la-cart-arrow-down"></i>
                            <div class="count" v-text="cart.quantity"></div>
                        </div>

{{--                        <span v-html="cart.subTotal.inCurrentCurrency.formatted"></span>--}}
                    </div>
                    <div class="hearder-acc">
                        <a href="{{ route('account.dashboard.index') }}">
                            <i class="las la-user"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
