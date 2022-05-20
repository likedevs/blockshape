{{--<div class="top-line">--}}
{{--    <div class="container">--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3 socials">--}}
{{--                <a class="fb" href="#"></a>--}}
{{--                <a class="twitter" href="#"></a>--}}
{{--                <a class="google" href="#"></a>--}}
{{--                <a class="youtube" href="#"></a>--}}
{{--            </div>--}}

{{--            <div class="col-md-3">--}}
{{--                <a href="{{ route('page', ['page' => 'consultation']) }}" class="consult">Consultație cu Galina</a>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 search">--}}
{{--                <form method="get" action="{{ route('search') }}">--}}
{{--                    <input type="text" name="search" placeholder="Cautare">--}}
{{--                </form>--}}
{{--            </div>--}}
{{--            <div class="col-md-3 top-menu">--}}
{{--                <a href="{{ route('page', ['page' => 'contacts']) }}">Contacte</a>--}}
{{--                @if (Auth::user())--}}
{{--                    <a href="{{ route('auth.logout') }}">Iesire</a>--}}
{{--                @else--}}
{{--                    <a href="{{ route('login') }}">Logare/Inregistrare</a>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<!-- Header Area -->
<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-2 logo">
                <a href="{{ route('home') }}"><img src="{{ asset('assets/BS-Logo.png') }}"></a>
            </div>
            <div class="col-md-7 menu">
                <ul>
                    <li><a href="{{ url('/page/about_author') }}">About</a></li>
                    <li><a href="{{ url('/page/subscriptions')  }}">Pricing Plan</a></li>
                    <li><a href="{{ url('/page/videos')  }}">Video</a></li>
                    <li><a href="{{ url('/page/contacts')  }}">Contcts</a></li>
                </ul>
            </div>
            <div class="col-md-3 menu-btns">
                <a href="{{ route('account') }}" class="account-btn">Cabinet</a>
                <a href="#" class="cart-btn">{{ Helper::getCartCount() }}</a>
            </div>
        </div>
    </div>
</div>
