<!DOCTYPE html>
<html>
<head>
	<title>@yield('title')</title>
	@include('Layout.Admin.header')
</head>
<body class="nav-md">
	<div class="container body dash-m" >
      <div class="main_container">
        
        @if(!Request::is('login') && !Request::is('register'))
        @include('Layout.Admin.topbar')
        @include('Layout.Admin.sidebar')
        @endif
        @yield('content')
        @include('Layout.Admin.footer')
        
      </div>
    </div>
</body>
</html>