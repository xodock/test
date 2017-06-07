<html>
<head>
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link type="text/css" rel="stylesheet" href="css/app.css">
</head>
<body>
<div id="app">
    @yield('content')
</div>
</body>
<script type="text/javascript" charset="UTF-8" src="js/app.js"></script>
</html>