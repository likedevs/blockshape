<div id="header">
    <div layout="row" layout-align="center">
        <div layout="column" flex="75">
            <div layout="row" layout-align="left">
                <div flex="20">
                    <a href="/" class="logo">
                        <img src="/images/logo.png" alt=""/>
                    </a>
                </div>
            </div>

            <div layout="row">
                <div flex class="x-left">

                    <div class="customer-name">
                        <h3 class="md-display-1">{{ $user->name }}</h3>
                    </div>

                </div>

                <div flex>
                    <div layout="row">
                        <div flex>
                            <div class="customer-image">
                                <img src="{{ $user->imageUrl(App\User::IMAGE_SIZE_MEDIUM) }}" alt="" class="circular shadow">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
