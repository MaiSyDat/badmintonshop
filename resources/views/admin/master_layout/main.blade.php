<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default"
    data-admin-path="/assets/css/admin/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>@yield('title')</title>

    <meta name="description" content="" />

    @include('admin.component.head')

</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->
            @include('admin.component.sidebar')
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">
                <!-- Navbar -->

                @include('admin.component.nav')

                <!-- Content wrapper -->
                <main>
                    @yield('main')
                </main>
                <!-- Content wrapper -->

                <!-- Footer -->
                @include('admin.component.footer')
                <!-- / Footer -->
            </div>
            <!-- / Layout page -->
        </div>
    </div>

    @include('admin.component.script')
    @yield('sctipt')
</body>

</html>
