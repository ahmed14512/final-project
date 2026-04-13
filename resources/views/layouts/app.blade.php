<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device=width, inital-scale=1.0">
    <title>@yield('Title', 'Home')</title>

    {{--CSS--}}
    <link  href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/app.css')}}" rel="stylesheet" >
    @yield('styles')
</head>

<body>
    
{{--navigation--}}
   
<nav>
    
    {{--logo--}}
    <div  class="navbar-brand" href="#">
        <a href="#" class="navbar-logo">
         <img src="{{asset('images/logo.jpg')}}" class="logo" >
        </a>
    
        <ul class="nav-links">
            <li>Item 1</li>
            <li>Item 2</li>
            <li>Item 3</li>
            <li>Item 4</li>
        </ul>
    </div>
    <div class="btns">
        <button class="btn">Login</button>

    </div>

</nav>



<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
</body>

