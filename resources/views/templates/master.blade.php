<!DOCTYPE html>
<html lang="en">
  <head>

    @include('templates._partials._head')

    @include('templates._partials._styles')

  </head>
  <body class="page-profile">

    @include('templates._partials._header')

    @yield('content')

    @include('templates._partials._footer')

    @include('templates.components.modals')

    @include('templates._partials._scripts')

  </body>
</html>
