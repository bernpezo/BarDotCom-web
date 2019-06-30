@extends('layouts.template')
<!-- CSS home -->
@section('css')
<link rel="stylesheet" href="{{ asset('css/template.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert2.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection
<!-- fin CSS -->
<!-- Título -->
@section('titulo')
BarDotCom
@endsection
@section('contenido')
    <!-- Inicio navbar -->
    <nav id="navbar-ex" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">BarDotCom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#carouselExampleFade">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#caracteristicas">Características</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#faq">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#contacto">Contacto</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Ingresar</a>
                    </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->nombre }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('miPanel') }}">Mi panel</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <!-- Fin navbar -->
    <div data-spy="scroll" data-target="#navbar-ex" data-offset="0">
        <!-- Inicio carrousel -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('images/home/car01.jpg') }}" class="d-block w-100" alt="BarDotCom">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-1">BarDotCom</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/home/car02.jpg') }}" class="d-block w-100" alt="BarDotCom">
                    <div class="carousel-caption d-none d-md-block">
                        <h1 class="display-4">Pedidos sin filas ni demoras</h1>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('images/home/car03.jpg') }}" class="d-block w-100" alt="BarDotCom">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
        <!-- Fin carrousel -->
        <!-- Inicio características -->
        <div class="container">
            <div class="text-home">
                <h3 id="caracteristicas" class="text-center">Características</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('images/home/home01.jpg') }}" class="card-img-top" alt="BarDotCom">
                            <div class="card-body">
                                <p class="card-text">Con <strong>BarDotCom</strong> puedes hacer tus pedidos de forma rápida, registrar tu ingreso en tus locales preferidos para recibir promociones exclusivas.</p>
                                <p class="card-text">¡Olvídate de las filas y preocúpate de pasarlo bien!</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-center">Sobre el sistema</h4>
                        <p><strong>BarDotCom</strong> es un sistema que permite agilizar y mejorar los procesos de atención a clientes dentro de locales comerciales.</p>
                        <p>Tanto los propietarios de locales comerciales, como los clientes de éstos se pueden ver beneficiados por un conjunto de aplicación web, móvil y tarjetas NFC.</p>
                        <h5>Para clientes</h5>
                        <p>Si quieres unirte a nosotros, solo debes crear una cuenta en nuestro sitio web y descargar la aplicación móvil. Disponible para sistemas Android.</p>
                        <p>Adicionálmente, puedes pedir una tarjeta NFC en cualquiera de los locales adheridos y vincularla a tu cuenta. Con tu tarjeta podrás registrar tu ingreso a cada local y comenzar a realizar pedidos de productos desde tu smartphone.</p>
                        <h5>Para locales</h5>
                        <p>Si tienes un local comercial, puede solicitar tu ingreso al sistema via web. <strong>BarDotCom</strong> posee numerosas herramientas de gestión que te ayudarán a tener un control preciso sobre los movimientos de tu local.</p>
                        <p>Podrás automatizar el proceso de toma de pedidos y solicitudes de cuenta, ofrecer promociones exclusivas a quiene ingresen a tu local, mejorar la calidad de tus servicios y, de esta forma, fidelizar a tus clientes.</p>
                        <p>Finálmente, tendrás acceso a reportes con datos de uso actualizados para ayudarte a tomar decisiones.</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin características -->
        <!-- Inicio FAQ -->
        <div class="faq-home">
            <div class="container">
                <div class="faq-text-home">
                    <h3 id="faq" class="text-center">F.A.Q.</h3>
                    <div class="row">
                        <div class="col-md-6 faq-text-home">
                            <p class="text-center">Para clientes</p>
                            <p> - ¿Qué beneficios tiene BarDotCom?</p>
                            <p>Puedes pedir productos disponibles en el local desde tu mesa, usando la aplicación móvil. También puedes pedir la cuenta cuando termines de divertirte.</p>
                            <p> - ¿Cuánto cuesta ser parte de BarDotCom?</p>
                            <p>Es gratis!</p>
                            <p> - ¿Qué hago si pierdo mi tarjeta?</p>
                            <p>Puedes solicitar otra tarjeta gratis en cualquier local adherido. Tienes derecho a 3 tarjetas gratis al año.</p>
                            <p> - ¿Puedo pedir productos sin entrar al local?</p>
                            <p>No. Para realizar pedidos debes registrar tu ingreso a un local.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-center">Para locales</p>
                            <p> - ¿Qué beneficios tiene BarDotCom?</p>
                            <p>Puedes mejorar la calidad de la atención a clientes al disminuir los tiempos de espera. Tendrás registro de todos los movimientos realizados por el sistema y reportes con información actualizada, entre otros.</p>
                            <p> - ¿Cuánto cuesta ser parte de BarDotCom?</p>
                            <p>Para locales comerciales existe un pago mensual. Esto te da acceso a todas las características del sistema, además de tarjetas NFC para tus clientes.</p>
                            <p> - ¿También puedo usar la aplicación móvil?</p>
                            <p>Si. El personal de tu local debe usar la aplicación para registrar el ingreso de los clientes. Para ésto, es necesario el uso de smartphones con tecnología NFC.</p>
                            <p> - ¿Cómo gestiono los pagos de mis clientes?</p>
                            <p>Tus clientes solo piden la cuenta y, desde ese punto, tu personal la entrega y cobra.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin FAQ -->
        <!-- Inicio Contacto -->
        <div class="container">
            <div class="text-home">
                <h3 id="contacto" class="text-center">Contacto</h3>
                <form>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="asunto">Asunto</label>
                                <input type="text" name="asunto" id="asunto" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="mensaje">Mensaje</label>
                                <textarea name="mensaje" id="mensaje" cols="30" rows="8" class="form-control" required></textarea>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="bContacto" class="btn btn-success">Enviar</button>  
                </form>
            </div>
        </div>
        <!-- Fin contacto -->
    </div>
    <!-- Inicio footer -->
    <footer class="fondo">
            <div class="footer-template footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="{{ route('home') }}"><h2 class="text-center">BarDotCom</h2></a>
                        </div>
                        <div class="col-md-4">
                            <h5 class="text-center">Repositorio</h5>
                            <a href="https://github.com/bernpezo/BarDotCom-web"><h4 class="text-center">BarDotCom en GitHub</h4></a>
                        </div>
                        <div class="col-md-4">
                            <p class="text-center">BarDotCom es propiedad de:</p>
                            <p>Rodrigo González</p>
                            <p>Bernardo Pezo</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Fin footer -->
@endsection
@section('js')
<script src="{{ asset('js/sweetalert2.min.js') }}"></script>
<script src="{{ asset('js/home.js') }}"></script>
@endsection