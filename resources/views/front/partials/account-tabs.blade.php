<!-- Tabs Area -->
<div class="tabs-block">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="avatar">
                    {{-- <img src="{{  asset('front-assets/img/avatar.png') }}"> --}}
                    <img src="{{  asset('images/noavatar.png') }}">
                </div>
            </div>
            <div class="col-md-5 greeting">
                <h2>Hi, <span>{{ Auth::user()->first_name }}</span></h2>
            </div>

            <div class="col-md-3 valid">
                <div class="date">
                    <label>Subscription valid until</label>
                    <section>
                        @if (!is_null(getSubscrEnd()))
                            <?php
                            $date = new DateTime(getSubscrEnd()->end);
                            ?>
                            {{ date_format($date, 'd M, Y') }}
                        @endif
                    </section>
                </div>
                <div class="date">
                    <label>Today's date</label>
                    <section><input
                                id="input_01"
                                class="datepicker"
                                name="date"
                                type="text"
                                autofocuss
                                value=""
                                data-value="2017-09-08">
                    </section>
                </div>
            </div>
        </div>
        <div class="row tabs">
            <div class="col-md-12">
                <ul>
                    {{--                    @if (!empty($tabsMenu))--}}
                    {{--                        @foreach ($tabsMenu as $key => $tab)--}}
                    {{--                            @if ($tab->slug == 'messages')--}}
                    {{--                                <li class="{{ $tab->class }}"><a--}}
                    {{--                                            href="{{ route('account.page', ['page' => $tab->slug]) }}"><span>{{ $tab->name }}</span><i>{{ $messagesCount }}</i></a>--}}
                    {{--                                </li>--}}
                    {{--                            @else--}}
                    {{--                                <li class="{{ $tab->class }}"><a--}}
                    {{--                                            href="{{ route('account.page', ['page' => $tab->slug]) }}"><span>{{ $tab->name }}</span></a>--}}
                    {{--                                </li>--}}
                    {{--                            @endif--}}
                    {{--                        @endforeach--}}
                    {{--                    @endif--}}
                    <li class="green"><a href="{{ url('account') }}"><span>Dashboard</span></a></li>
                    <li class="caribbean"><a href="{{ url('account/edit') }}"><span>Profile</span></a></li>
                    <li class="amethyst"><a href="{{ url('account/parameters') }}"><span>Parameters</span></a></li>
                    <li class="flamenco"><a href="{{ url('account/graph') }}"><span>Results tracker</span></a></li>
                </ul>
            </div>
            <div class="col-md-12 tab-line {{ $activeMenu }}"></div>
        </div>
    </div>
</div>
