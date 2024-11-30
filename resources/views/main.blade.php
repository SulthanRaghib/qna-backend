@include('layout.header')
@include('layout.sidebar')

<div class="content-wrapper">
    <section class="content">
        @yield('content')
    </section>
</div>

@include('layout.footer')
