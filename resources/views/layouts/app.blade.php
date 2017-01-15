<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Welcome to Peacebook</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href='{{ asset("/css/mystyle_dashboard.css")}}'>




    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
</head>
<style>
body{
    background-color: #edf0f5;
    font-family: Tahoma;
}

p:nth-child(1){
    font-size: 30px;
    color:black;
}

p:nth-child(2){
    font-size: 20px;
    color:black;
}

.formcontrol, .panel, .form-control{
    border-radius: 0px;
}
</style>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style='background-color: #3B5998;'>
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                      <a class="navbar-brand" href='{{url("dashboard")}}' style="color:white">Peacebook</a>
            
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="{{ url('/login') }}" style='color: white'>Login</a></li>
                            <li><a href="{{ url('/register') }}" style='color: white'>Register</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
    <div style='position:absolute;
    bottom:0; width:100%;'>
    <div style='background-color: white; '

    <div class='text-center'>
        <ul class="list-inline">
          <li><a href=''>Signup</a></li>
          <li><a href=''>Login</a></li>
    </ul>
    <hr style="width:60%">
    <div>

    
     <div>
        <ul class="list-inline">
         
          <li><a href=''>English (US)</a></li>
          <li><a href=''>Filipino</a></li>
          <li><a href=''>Bisaya</a></li>
          <li><a href=''>Español</a></li>
          <li><a href=''>日本語</a></li>
          <li><a href=''>한국어</a></li>
          <li><a href=''>中文(简体)</a></li>
          <li><a href=''>لعربية</a></li>
          <li><a href=''>Português</a></li>
          <li><a href=''>(Brasil)Français(简体)</a></li>
          <li><a href=''>(France)Deutsch</a></li>      
    </ul>
    </div>
    </div>
      </div>
    <script src="/js/app.js"></script>
</body>
</html>
