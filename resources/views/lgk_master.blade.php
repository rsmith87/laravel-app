<!--
 * CoreUI - Open Source Bootstrap Admin Template
 * @version v1.0.6
 * @link http://coreui.io
 * Copyright (c) 2017 creativeLabs Łukasz Holeczek
 * @license MIT
 -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Legal Case Management made easy.">
  <meta name="keyword" content="Case Management, Legal Case Management">
  <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
  <title>Legalkeeper</title>

  <!-- Icons -->
  <link rel="stylesheet" href="{{ asset('font-awesome-5.7.2/css/all.css') }}">
  <link rel="stylesheet" href="{{ asset('font-awesome-5.7.2/css/brands.css') }}">
  <link href="{{ asset('css/simple-line-icons.css') }}" rel="stylesheet">

  @yield('extra_css')

  <!-- Main styles for this application -->
  <link href="{{ asset('css/style.css') }}" rel="stylesheet">
  
  <!-- Styles required by this views -->
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">  
  <script type="text/javascript" src="{{ asset('js/vendor/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/vendor/popper.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>



</head>
<!-- BODY options, add following classes to body to change options
'.header-fixed' - Fixed Header
'.brand-minimized' - Minimized brand (Only symbol)
'.sidebar-fixed' - Fixed Sidebar
'.sidebar-hidden' - Hidden Sidebar
'.sidebar-off-canvas' - Off Canvas Sidebar
'.sidebar-minimized'- Minimized Sidebar (Only icons)
'.sidebar-compact'    - Compact Sidebar
'.aside-menu-fixed' - Fixed Aside Menu
'.aside-menu-hidden'- Hidden Aside Menu
'.aside-menu-off-canvas' - Off Canvas Aside Menu
'.breadcrumb-fixed'- Fixed Breadcrumb
'.footer-fixed'- Fixed footer
-->

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  @include('lgk_panel.navbar')
  
  <div class="app-body">
    @include('lgk_panel.sidebar')
    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      @include('lgk_panel.breadcrumb')

      @yield('content')
      <!-- /.container-fluid -->
    </main>

    @include('lgk_panel.asidemenu')

  </div>

  @include('lgk_panel.footer')

  @include('lgk_panel.scripts')
  @yield('myscript')

</body>
<script type="text/javascript" src="{{ asset('js/jquery.input-mask.min.js') }}"></script>
@yield('extra_js')
<script type="text/javascript" src="{{ asset('js/scripts.js') }}"></script>
</html>