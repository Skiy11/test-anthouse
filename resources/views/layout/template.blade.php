<!DOCTYPE html>
<html lang="en">
    <head>
        @include('include.head')
    </head>
    <body>

        <header>
            @include('include.header')
        </header>

        <div id="content">
            <div class="row">
                @yield('content')
            </div>
        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="{{route('/') . '/css/bootstrap/dist/js/bootstrap.min.js'}}"></script>

    </body>
</html>
