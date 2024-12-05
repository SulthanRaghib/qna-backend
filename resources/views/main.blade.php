@include('layout.header')
@include('layout.sidebar')

<div class="container">
    <div class="p-3">
        @yield('content')
    </div>
</div>


@include('layout.footer')
