@include('admin.layouts.head')
    <div class="container-scroller">

      <!-- partial:partials/_sidebar.html -->
@include('admin.layouts.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
@include('admin.layouts.nav')
        <!-- partial -->
        <div class="main-panel">
{{-- @include('admin.layouts.body') --}}
          <div class="content-wrapper">

        @yield('content')
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
@include('admin.layouts.footer')
