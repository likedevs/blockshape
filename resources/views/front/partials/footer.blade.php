<!-- Footer Area -->
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h3 class="green">Contacts</h3>
                <div class="phones">
                    <a href="https://discord.com/invite/6cMryUfBZG" target="_blank">https://discord.com/invite/6cMryUfBZG</a>
                </div>
                <div class="email">
                    <a href="#">blockshapetop@gmail.com</a>
                </div>

            </div>
            <div class="col-md-3 pages">
                <h3 class="blue">Pages</h3>
                <a href="/">Home</a>
                <a href="/page/about_author">About</a>
                <a href="/page/subscriptions">Pricing Plans</a>
                <a href="/page/videos">Video</a>
            </div>
            <div class="col-md-3 links">
                @if (!Auth::user())
                    <a href="/login">Register Now</a>
                @endif
                <a href="/cart">Cart</a>
                <a href="/account">Account</a>
            </div>
            <div class="col-md-3 other">
                <img src="{{  asset('assets/BS-Logo.png') }}">
                <h4>Get one week free</h4>
                <a href="/login">Register Now</a>
            </div>
        </div>
    </div>
</div>
