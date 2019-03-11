<html>
    <head>    
        <title>Invertory</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />   
        <meta name="keywords" content="American Inventroy best App" />
        @include('layouts.header')
    </head>
    <body>
         <div class="page-container" style="margin-bottom:7em;overflow-y:auto;">
            <div class="left-content" style="width:100%;">
                <div class="mother-grid-inner" >
        @yield('content')
        </div>
    </div>
 
</div>
<div class="copyrights" style="width:100%;position:fixed;bottom:0px;background-color:white;">
                <div class="col-xs-4"> <a href="{{route('profile')}}"><i class="fa fa-file-text-o"> </i></a></div>
                <div class="col-xs-4"> <a href="{{route('user')}}"><i class="fa fa-eye"> </i></a></div> 
                <div class="col-xs-4"><a href="{{route('inventory')}}"><i class="fa fa-envelope-o"> </i></a></div>   
</div>
    </body>
        @include('layouts.footer')
</html>