<!-- vendor css -->
<link href="{{ asset('lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
<link href="{{ asset('lib/typicons.font/typicons.css') }}" rel="stylesheet">
<link href="{{ asset('lib/prismjs/themes/prism-vs.css') }}" rel="stylesheet">

@stack('css')

<!-- DashForge CSS -->
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.demo.css') }}">

<style type="text/css">

    body {
        background-color: #f5f6fa;
    }

    .card {
        box-shadow: 0 0 10px rgba(28, 39, 60, 0.05);
    }

</style>

@stack('css-script')
