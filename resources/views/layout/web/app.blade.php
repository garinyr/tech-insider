<!DOCTYPE html>
<html lang="en">
  

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <link rel="shortcut icon" href="{{ URL::asset('foto/favicon.png') }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Tech Insider Clothing</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="{{ URL::asset('template/web/css/bootstrap.css') }}">

    <!-- Custom styles for this template -->
    
    <link href="{{ URL::asset('template/web/css/style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('template/web/css/responsive.css') }}" rel="stylesheet">
    <style>
      a{
          text-decoraction:none;
      }
      </style>
    
	 @yield('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
      <div class="container">
    @include('partials.web.header')

    <!-- begin:content -->
   
      <!-- begin:logo -->
      @yield('content')
      <!-- end:random-product -->
      @include('partials.web.footer')
    </div>
    <!-- end:content -->

    
    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    @yield('js')
    <script src="{{ URL::asset('template/web/js/jquery.js') }}"></script>
    <script src="{{ URL::asset('template/web/js/bootstrap.min.js') }}"></script>
    <script src="{{ URL::asset('template/web/js/masonry.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('template/web/js/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ URL::asset('template/web/js/script.js') }}"></script>

  </body>
</html>
