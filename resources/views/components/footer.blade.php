<nav class="navbar navbar-expand-md navbar-light fixed-bottom mt-5 footer-container">
    <div class="container-fluid d-flex justify-content-center">
        <a class="navbar-brand d-flex align-items-center" href="{{ Auth::guard('admin')->check() ? route('admin.home') : url('main') }}">
            <img src="{{asset('/images/logo_images/logo_g.png')}}" style="height: 26px; margin-right: 6px;">
            {{ config('app.name', 'Laravel') }}
        </a>
    </div>
</nav>
