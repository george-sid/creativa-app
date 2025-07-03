<!DOCTYPE html>
<html lang="en">
    @include('layouts.header')
    <body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
        <div class="app-wrapper">
            @include('layouts.navbar')
            @include('layouts.leftMenu')
            <main class="app-main">
                @yield('content')
            </main>
            @include('layouts.footer')
        </div>
        @include('layouts.scripts')
    </body>
</html>