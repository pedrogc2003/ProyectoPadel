<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Panda Padel Club</title>
    <link rel="stylesheet" href="{{ asset('css/plantilla.css') }}">
   
    <!-- Bootstrap CSS y JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    


</head>
<body>
    <header>
        <h1>Panda Padel Club</h1>
    </header>

    <div class="container">
        <br>
        <div id="theCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicadores -->
            <ol class="carousel-indicators">
                <li data-target="#theCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#theCarousel" data-slide-to="1"></li>
                <li data-target="#theCarousel" data-slide-to="2"></li>
                <li data-target="#theCarousel" data-slide-to="3"></li>
            </ol>

            <div class="carousel-inner" role="listbox">
                <div class="item active">
                    <img src="{{ asset('imagenes/1.png') }}" alt="fotografia" width="600" height="424"> 
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>

                <div class="item">
                    <img src="{{ asset('imagenes/2.jpg') }}" alt="pintura" width="600" height="424">
                    <div class="carousel-caption d-none d-md-block">
                    </div>
                </div>

                <div class="item">
                    <img src="{{ asset('imagenes/3.jpg') }}" alt="diseno" width="600" height="424"> 
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>

                <div class="item">
                    <img src="{{ asset('imagenes/4.jpg') }}" alt="Ilustracion"> 
                    <div class="carousel-caption d-none d-md-block"></div>
                </div>
            </div>

            <a class="left carousel-control" href="#theCarousel" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">anterior</span>
            </a>
            <a class="right carousel-control" href="#theCarousel" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">siguiente</span>
            </a>
        </div>
    </div>

    <div class="bontones">
        @yield('bontones')
    </div>

    <div class="informacion">
        @yield('informacion')
    </div>

    <div class="footer">
        <footer>
            <p>Realizado por: Pedro Gradit Cubero</p>
            <p>Año de realización: 2024</p>
            <p>Curso: 2º DAW</p>
        </footer>
    </div>
</body>
</html>
