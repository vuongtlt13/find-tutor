<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="_token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="images/edit.png">

    <title>Tìm gia sư ôn thi đại học - Tại Hà Nội</title>

    @yield('css')
    <link href="vendor/light/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="vendor/light/assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="vendor/light/assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="vendor/light/assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="vendor/light/assets/css/pages.css" rel="stylesheet" type="text/css" />
    <link href="vendor/light/assets/css/responsive.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="vendor/light/assets/js/modernizr.min.js"></script>
    <style>
        login:hover {
            text-decoration: underline;
        }

        login:active {
            text-decoration: underline;
        }
    </style>

</head>

<body class="fixed-left">

<!-- Begin page -->
<div id="wrapper">
    @include('layouts.header')
    @include('layouts.left')
    @yield('content')
</div>
<!-- END wrapper -->

<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="vendor/light/assets/js/jquery.min.js"></script>
<script src="vendor/light/assets/js/bootstrap.min.js"></script>
<script src="vendor/light/assets/js/detect.js"></script>
<script src="vendor/light/assets/js/fastclick.js"></script>
<script src="vendor/light/assets/js/jquery.slimscroll.js"></script>
<script src="vendor/light/assets/js/jquery.blockUI.js"></script>
<script src="vendor/light/assets/js/waves.js"></script>
<script src="vendor/light/assets/js/wow.min.js"></script>
<script src="vendor/light/assets/js/jquery.nicescroll.js"></script>
<script src="vendor/light/assets/js/jquery.scrollTo.min.js"></script>

@yield('script')

<script src="vendor/light/assets/js/jquery.core.js"></script>
<script src="vendor/light/assets/js/jquery.app.js"></script>
</body>
</html>