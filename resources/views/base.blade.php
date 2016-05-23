<!DOCTYPE html>
<html lang="en">
<head>
  
    @include('includes.head')
  	@yield('styles')
</head>
<body>
   
    @yield('content')
    
    @include('includes.foot')
    
    @yield('scripts')
</body>
</html>