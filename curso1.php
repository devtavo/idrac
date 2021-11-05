<?php

/**
 * Embbeded Form minimal integration example
 * 
 * To run the example, go to 
 * hhttps://github.com/lyra/rest-php-example
 */

/**
 * I initialize the PHP SDK
 */
require_once 'prueba_apiv2/www/vendor/autoload.php';
require_once 'prueba_apiv2/www/keys.php';
require_once 'prueba_apiv2/www/helpers.php';

/** 
 * Initialize the SDK 
 * see keys.php
 */
$client = new Lyra\Client();

/**
 * I create a formToken
 */
$store = array(
    "amount" => 9999,
    "currency" => "PEN",
    "orderId" => uniqid("MyOrderId"),
    "customer" => array(
        "email" => "sample@example.com"
    )
);
$response = $client->post("V4/Charge/CreatePayment", $store);

/* I check if there are some errors */
if ($response['status'] != 'SUCCESS') {
    /* an error occurs, I throw an exception */
    display_error($response);
    $error = $response['answer'];
    throw new Exception("error " . $error['errorCode'] . ": " . $error['errorMessage']);
}

/* everything is fine, I extract the formToken */
$formToken = $response["answer"]["formToken"];

?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Inicio</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo.ico" type="image/png" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Roboto:100,300,300i,400,500,600,700,900%7CRaleway:500">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="<?php echo $client->getClientEndpoint(); ?>/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js" kr-public-key="<?php echo $client->getPublicKey(); ?>" kr-post-url-success="paid.php">
    </script>

    <!-- theme and plugins. should be loaded after the javascript library -->
    <!-- not mandatory but helps to have a nice payment form out of the box -->
    <link rel="stylesheet" href="<?php echo $client->getClientEndpoint(); ?>/static/js/krypton-client/V4.0/ext/classic-reset.css">
    <script src="<?php echo $client->getClientEndpoint(); ?>/static/js/krypton-client/V4.0/ext/classic.js">
    </script>
    <!--[if lt IE 10]>
    <div style="background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index:1;"><a href="http://windows.microsoft.com/en-US/internet-explorer/"><img src="images/ie8-panel/warning_bar_0000_us.jpg" border="0" height="42" width="820" alt="You are using an outdated browser. For a faster, safer browsing experience, upgrade for free today."></a></div>
    <script src="js/html5shiv.min.js"></script>
    <![endif]-->
    <!-- Facebook Pixel Code -->
    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '368632364575709');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=368632364575709&ev=PageView&noscript=1" /></noscript>
    <!-- End Facebook Pixel Code -->
</head>

<body>
    <!-- <div class="preloader">
        <div class="wrapper-triangle">
            <center>
                <div class="book">
                    <div class="inner">
                        <div class="left"></div>
                        <div class="middle"></div>
                        <div class="right"></div>
                    </div>
                    <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>
                </div>
                <a class="dribbble" href="https://dribbble.com/shots/7199149-Book-Loader" target="_blank"><img src="https://dribbble.com/assets/logo-small-2x-9fe74d2ad7b25fba0f50168523c15fda4c35534f9ea0b1011179275383035439.png" /></a>

            </center>

        </div>

    </div> -->
    <div class="preloader">
        <div class="wrapper-triangle">
            <div class="pen">
                <div class="line-triangle">
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                </div>
                <div class="line-triangle">
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                </div>
                <div class="line-triangle">
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                    <div class="triangle"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="page">
        <!-- Top Banner -->
        <!-- <a class="section section-banner text-center d-none d-xl-block" href="https://www.templatemonster.com/intense-multipurpose-html-template.html" style="background-image: url(images/banner/background-04-1920x60.jpg); background-image: -webkit-image-set( url(images/banner/background-04-1920x60.jpg) 1x, url(images/banner/background-04-3840x120.jpg) 2x )"><img src="images/banner/foreground-04-1600x60.png" srcset="images/banner/foreground-04-1600x60.png 1x, images/banner/foreground-04-3200x120.png 2x" alt="" width="1600" height="310"></a> -->
        <!-- Page Header -->
        <header class="section page-header">
            <!-- RD Navbar-->
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-modern" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="56px" data-xl-stick-up-offset="56px" data-xxl-stick-up-offset="56px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-inner-outer">
                        <div class="rd-navbar-inner">
                            <!-- RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!-- RD Navbar Toggle-->
                                <button class="rd-navbar-toggle" data-rd-navbar-toggle=".rd-navbar-nav-wrap"><span></span></button>
                                <!-- RD Navbar Brand-->
                                <div class="rd-navbar-brand">
                                    <a class="brand" href="index.php"><img class="brand-logo-dark" src="images/logo_198_66.png" alt="" width="198" height="66" /></a>
                                </div>
                            </div>
                            <div class="rd-navbar-right rd-navbar-nav-wrap">
                                <div class="rd-navbar-aside">
                                    <ul class="rd-navbar-contacts-2">
                                        <li>
                                            <div class="unit unit-spacing-xs">
                                                <div class="unit-left"><span class="icon mdi mdi-phone"></span></div>
                                                <div class="unit-body"><a class="phone" href="tel:#">+51 916 611 364</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="unit unit-spacing-xs">
                                                <div class="unit-left"><span class="icon mdi mdi-map-marker"></span>
                                                </div>
                                                <div class="unit-body"><a class="address" href="#">Ca. Los Tulipanes
                                                        #186 - Lince </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <ul class="list-share-2">
                                        <li>
                                            <a class="icon mdi mdi-facebook" href="https://www.facebook.com/idracapacitaciones"></a>
                                        </li>
                                        <li>
                                            <a class="icon mdi mdi-twitter" href="https://twitter.com/idracapacita"></a>
                                        </li>
                                        <li>
                                            <a class="icon mdi mdi-instagram" href="https://www.instagram.com/idra.capacitaciones/"></a>
                                        </li>
                                        <li>
                                            <a class="icon mdi mdi-google-plus" href="#"></a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="rd-navbar-main">
                                    <!-- RD Navbar Nav-->
                                    <ul class="rd-navbar-nav">
                                        <li class="rd-nav-item active"><a class="rd-nav-link" href="index.php">Inicio</a>
                                        </li>
                                        <li class="rd-nav-item"><a class="rd-nav-link" href="nosotros.php">Nosotros</a>
                                        </li>
                                        <li class="rd-nav-item dropdown"> <button class="dropbtn rd-nav-link">Programación</button>
                                            <div class="dropdown-content">
                                                <a href="programas.php">Programas</a>
                                                <a href="#">Cursos</a>
                                                <a href="#">Promociónes</a>
                                            </div>
                                        </li>
                                        <li class="rd-nav-item "><a class="rd-nav-link" href="certi.php" target="_blank">Verificacion</a>
                                        </li>

                                        <!-- <li class="rd-nav-item dropdown"> <button class="dropbtn rd-nav-link">Dropdown</button>
                                            <div class="dropdown-content">
                                                <a href="#">Link 1</a>
                                                <a href="#">Link 2</a>
                                                <a href="#">Link 3</a>
                                            </div>
                                        </li> -->
                                        <li class="rd-nav-item "><a class="rd-nav-link" href="contacts.php">Contacto</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="rd-navbar-project-hamburger rd-navbar-project-hamburger-open rd-navbar-fixed-element-1" data-multitoggle=".rd-navbar-inner" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate="data-multitoggle-isolate">
                                <div class="project-hamburger"><span class="project-hamburger-arrow"></span><span class="project-hamburger-arrow"></span><span class="project-hamburger-arrow"></span>
                                </div>
                            </div>
                            <div class="rd-navbar-project">
                                <div class="rd-navbar-project-header">
                                    <h5 class="rd-navbar-project-title">Contenido 4 </h5>
                                    <div class="rd-navbar-project-hamburger rd-navbar-project-hamburger-close" data-multitoggle=".rd-navbar-inner" data-multitoggle-blur=".rd-navbar-wrap" data-multitoggle-isolate="data-multitoggle-isolate">
                                        <div class="project-close"><span></span><span></span></div>
                                    </div>
                                </div>
                                <div class="rd-navbar-project-content rd-navbar-content">
                                    <div>
                                        <div class="row gutters-20" data-lightgallery="group">
                                            <div class="col-6">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </nav>
            </div>
        </header>

        <div class="container-fluid p-t-90" style="background:#132a49">
            <div class="row">
                <div class="col-lg-12" style="border: solid 1px;background-image: url(images/ban2s.jpg);margin: 0px;padding-right: 0px;padding-left: 0px;">

                    <div class="container">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-8">
                                    <p class="titulo-land">LEY DE PROCEDIMIENTO ADMINISTRATIVO GENERAL, LEY 27444</p>
                                    <p class="contenido-land">Es el momento de que las empresas afronten la situación de emergencia que estamos viviendo para que las organizaciones no paren y sepan cómo integrar este cambio. Por eso desde IDRA Capacitaciones hemos lanzado una red
                                        de Diplomados en Adminitracion en tiempo de crisis para ayudar a empresarios, directivos y manager a darle un giro a esta situación.</p>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <button class="what" onclick="window.open('https://api.whatsapp.com/send?phone=51916611364&fbclid=IwAR1k0KKGTwzz2ejChmYv_2N9znk_PVIcb0FtY51O1DIWj9tnMtwcSrK7fT8', '_blank');"><i class="fa fa-whatsapp"></i> Chat WhatsApp</button>
                                        </div>
                                        <div class="col">
                                            <button class="what" style="margin-left: 0px; color: black; background: white;"><i class="fa fa-mobile"></i> Mas Información</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="margenvideo">
                                        <br>
                                        <div class="card" style="width: 22rem;">
                                            <img class="card-img-top" src="images/nosotros.jpg" alt="Card image cap">
                                            <div class="card-title text-uppercase text-center" style="color: rgba(5, 4, 94, 0.836);margin: 15px; padding: 0px;"><b>LEY DE PROCEDIMIENTO ADMINISTRATIVO GENERAL, LEY 27444</b></div>
                                            <hr>
                                            <div style="margin-left:15px;">
                                                <div class="modalidad">
                                                    <span class="modalidad"> <i class="fas fa-video" style="color: red;"></i> Modalidad: Virtual - Grabado</span>
                                                </div>
                                                <div class="modalidad">
                                                    <span class="modalidad"> <i class="fas fa-graduation-cap" style="color: rgba(5, 4, 94, 0.836) ;"></i> Certificación: 120 horas</span>
                                                </div>
                                                <div class="modalidad">
                                                    <span class="modalidad"> <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 28.25 24.432">
                                                            <g id="cards-certificado" transform="translate(-313.232 -100.44)">
                                                                <path id="Trazado_532" data-name="Trazado 532" d="M340.4,100.566H314.314a.958.958,0,0,0-.957.957v20a.959.959,0,0,0,.957.957h17.658v1.857a.411.411,0,0,0,.583.372l1-.466,1,.466a.418.418,0,0,0,.549-.219.41.41,0,0,0,.034-.153V122.48h5.256a.959.959,0,0,0,.963-.953v-20A.957.957,0,0,0,340.4,100.566Zm-6.081,23.129-.592-.276a.41.41,0,0,0-.346,0l-.593.276v-5.05a.918.918,0,0,0,1.531,0Zm.125-6.283a1.629,1.629,0,0,0-.593.519,1.579,1.579,0,0,1-.3.3,1.551,1.551,0,0,1-.3-.3,1.637,1.637,0,0,0-.593-.519,1.793,1.793,0,0,0-.807-.059h.006c-.411.036-.43.014-.395-.4a1.415,1.415,0,0,0-.576-1.4c-.333-.277-.333-.32,0-.6a1.416,1.416,0,0,0,.576-1.4c-.036-.411-.016-.432.395-.4a1.414,1.414,0,0,0,1.4-.578c.275-.333.318-.333.593,0a1.414,1.414,0,0,0,1.4.578c.411-.036.431-.014.395.4a1.416,1.416,0,0,0,.576,1.4c.333.277.333.32,0,.6a1.415,1.415,0,0,0-.576,1.4c.036.41.016.432-.394.4A1.711,1.711,0,0,0,334.444,117.412Zm6.093,4.11a.137.137,0,0,1-.137.137h-5.256v-3.5h.039a1,1,0,0,0,1.283-1.285.621.621,0,0,1,.284-.7,1.062,1.062,0,0,0,0-1.858.624.624,0,0,1-.284-.7c.08-.918-.348-1.367-1.283-1.285a.62.62,0,0,1-.7-.284,1.06,1.06,0,0,0-1.857,0,.62.62,0,0,1-.7.284c-.918-.08-1.365.35-1.283,1.285a.624.624,0,0,1-.284.7,1.063,1.063,0,0,0,0,1.858.623.623,0,0,1,.284.7c-.086.983.383,1.363,1.323,1.282v1.82l.006.83v.854H314.314a.137.137,0,0,1-.137-.137v-20a.137.137,0,0,1,.137-.137H340.4a.137.137,0,0,1,.137.137Z" stroke="#000" stroke-miterlimit="10" stroke-width="0.25"></path>
                                                                <path id="Trazado_414" data-name="Trazado 414" d="M317.337,106.656H335.1a.515.515,0,0,0,0-1.03H317.337a.515.515,0,0,0,0,1.03Z" stroke="#000" stroke-miterlimit="10" stroke-width="0.25"></path>
                                                                <path id="Trazado_415" data-name="Trazado 415" d="M335.19,108.613c0-.284-.158-.515-.353-.515H319.881c-.457,0-.457,1.03,0,1.03h14.956C335.032,109.126,335.19,108.9,335.19,108.613Z" stroke="#000" stroke-miterlimit="10" stroke-width="0.25"></path>
                                                                <path id="Trazado_416" data-name="Trazado 416" d="M330.908,111.086a.515.515,0,0,0-.515-.515H318a.515.515,0,0,0,0,1.03h12.391a.516.516,0,0,0,.516-.514Z" stroke="#000" stroke-miterlimit="10" stroke-width="0.25"></path>
                                                                <path id="Trazado_417" data-name="Trazado 417" d="M324.392,116.842h-.847c-.54,0-.838-.144-.948-.717-.1-.523-.855-.456-.993,0-.061.2-.371.781-.641.734-.143-.025-.206-.246-.258-.36a4.4,4.4,0,0,1-.242-.695c-.271-1-.325-2.041-.5-3.058-.1-.59-1-.423-1.012.137a15.754,15.754,0,0,1-.973,5.216c-.236.621.76.889.994.274a14.641,14.641,0,0,0,.59-1.975,5.221,5.221,0,0,0,.3.717,1.227,1.227,0,0,0,1.571.682,1.773,1.773,0,0,0,.63-.46,2.277,2.277,0,0,0,1.889.536l3.06-.007a.516.516,0,0,0,0-1.03l-2.624.006Z" stroke="#000" stroke-miterlimit="10" stroke-width="0.25"></path>
                                                                <path id="Trazado_418" data-name="Trazado 418" d="M333.554,116.522a1.368,1.368,0,1,0-1.368-1.367A1.367,1.367,0,0,0,333.554,116.522Zm0-2.035a.667.667,0,1,1-.668.668.668.668,0,0,1,.668-.668Z" stroke="#000" stroke-miterlimit="10" stroke-width="0.25"></path>
                                                            </g>
                                                        </svg> Certifica: IDRA Capacitaciones</span>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row" style="margin: 0px;">
                                                <div class="col">
                                                    <div style="font-family: 'Lato', sans-serif; font-size: 19px; "><i class="far fa-calendar-alt"></i> Inicia</div>
                                                    <div class="text-danger text-center" style="padding-bottom: 00px; font-family: 'Lato', sans-serif; font-size: 25px;color: red;"> <b> Ahora!</b></div>
                                                </div>
                                                <div class="col">
                                                    <div style="font-family: 'Lato', sans-serif; ; font-size: 19px; "><i class="fas fa-tag"></i> Precio</div>
                                                    <div class="text-center" style="padding-bottom: 0px; font-family: 'Lato', sans-serif; font-size: 25px;">S/99.00</div>
                                                </div>
                                            </div>
                                            <br>
                                            <!-- <button data-toggle="modal" data-target="#myModal"> ddd</button> -->
                                            <a href="curso2.php" target="" class="btn btn-block text-uppercase" id="dip" name="dip" style="background-color:#004396;">Comprar</a>

                                            <!-- <div class="kr-embedded" kr-popin kr-form-token="<?php echo $formToken; ?>">Custom label</div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-lg-6">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="container" style="z-index: -1;">
            <br>
            <div class="row">
                <div class="col-lg-8">
                    <div class="descripcion-bloque">
                        <p class="descripcion-titulo">¿Por qué participar en este Diplomado?</p>
                        <p class="descripcion-contenido">El curso tiene como objetivo brindar capacitación especializada en obras públicas, que se ejecutan en el marco de la Ley N° 30225 - Ley de Contrataciones del Estado y su modificatorias vigentes, que permita aplicarla durante la gestión
                            pública.
                        </p>
                    </div>
                    <div class="presentacion-bloque">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-links active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Temario</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-links" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Modalidad</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-links" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Docente</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link nav-links" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Certificación</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate odit magni eaque unde, natus excepturi obcaecati accusantium in totam saepe aut corporis voluptas culpa magnam quae et officiis, ex quos!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate odit magni eaque unde, natus excepturi obcaecati accusantium in totam saepe aut corporis voluptas culpa magnam quae et officiis, ex quos!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate odit magni eaque unde, natus excepturi obcaecati accusantium in totam saepe aut corporis voluptas culpa magnam quae et officiis, ex quos!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate odit magni eaque unde, natus excepturi obcaecati accusantium in totam saepe aut corporis voluptas culpa magnam quae et officiis, ex quos!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptate odit magni eaque unde, natus excepturi obcaecati accusantium in totam saepe aut corporis voluptas culpa magnam quae et officiis, ex quos!

                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                            </div>
                            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

               <br>
        <footer class="section footer-modern context-dark footer-modern-2">
            <div class="footer-modern-line">
                <div class="container">
                    <div class="row row-50">
                        <div class="col-md-6 col-lg-4">
                            <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">Programas </span></h5>
                            <ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
                                <li><a href="#">Programas </a></li>
                                <li><a href="#">Diplomados </a></li>
                                <li><a href="#">Cursos y especializaciones </a></li>
                            </ul>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3">
                            <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">IDRA Capacitaciones </span>
                            </h5>
                            <ul class="footer-modern-list d-inline-block d-sm-block wow fadeInUp">
                                <li><a href="about-us.html">Aula IDRA </a></li>
                                <li><a href="#">Nosotros </a></li>
                                <li><a href="#">Programas </a></li>
                                <li><a href="#">Promociones </a></li>
                                <li><a href="#">Contacto </a></li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-xl-5">
                            <h5 class="footer-modern-title oh-desktop"><span class="d-inline-block wow slideInLeft">Contacto </span>
                            </h5>
                            <p class="wow fadeInRight">Dejanos tu correo para comunicarnos contigo </p>
                            <!-- RD Mailform-->
                            <form class="rd-form rd-mailform rd-form-inline rd-form-inline-sm oh-desktop" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                                <div class="form-wrap wow slideInUp">
                                    <input class="form-input" id="subscribe-form-2-email" type="email" name="email" data-constraints="@Email @Required" />
                                    <label class="form-label" for="subscribe-form-2-email">Correo Electronico </label>
                                </div>
                                <div class="form-button form-button-2 wow slideInRight">
                                    <button class="button button-sm button-icon-3 button-primary button-winona" type="submit"><span class="d-none d-xl-inline-block">Enviar </span><span class="icon mdi mdi-telegram d-xl-none"></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-modern-line-2">
                <div class="container">
                    <div class="row row-30 align-items-center">
                        <div class="col-sm-6 col-md-7 col-lg-4 col-xl-4">
                            <div class="row row-30 align-items-center text-lg-center">
                                <div class="col-md-7 col-xl-6">
                                    <a class="brand" href="index.html"><img src="images/idrablanco.png" alt="" width="198" height="66" /></a>
                                </div>
                                <!-- <div class="col-md-5 col-xl-6">
                                    <div class="iso-1"><span></span><span class="iso-1-big">9.4k de visi</span></div>
                                </div> -->
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-12 col-lg-8 col-xl-8 oh-desktop">
                            <div class="group-xmd group-sm-justify">
                                <div class="footer-modern-contacts wow slideInUp">
                                    <div class="unit unit-spacing-sm align-items-center">
                                        <div class="unit-left"><span class="icon icon-24 mdi mdi-phone"></span></div>
                                        <div class="unit-body"><a class="phone" href="tel:#">+51 916 611 364</a></div>
                                    </div>
                                </div>
                                <div class="footer-modern-contacts wow slideInDown">
                                    <div class="unit unit-spacing-sm align-items-center">
                                        <div class="unit-left"><span class="icon mdi mdi-email"></span></div>
                                        <div class="unit-body"><a class="mail" href="mailto:#">informes @idra.pe</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="wow slideInRight">
                                    <ul class="list-inline footer-social-list footer-social-list-2 footer-social-list-3">
                                        <li>
                                            <a class="icon mdi mdi-facebook" href="https://www.facebook.com/idracapacitaciones"></a>
                                        </li>
                                        <li>
                                            <a class="icon mdi mdi-twitter" href="https://twitter.com/idracapacita"></a>
                                        </li>
                                        <li>
                                            <a class="icon mdi mdi-instagram" href="https://www.instagram.com/idra.capacitaciones/"></a>
                                        </li>
                                        <li>
                                            <a class="icon mdi mdi-google-plus" href="#"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-modern-line-3">
                <div class="container">
                    <div class="row row-10 justify-content-between">
                        <div class="col-md-6"><span>IDRA Capacitaciones y Consultoria</span>
                        </div>
                        <div class="col-md-auto">
                            <!-- Rights-->
                            <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span></span><span>.&nbsp;</span><span>All Rights
                                    Reserved.</span><span>
                                    Diseñado&nbsp;para&nbsp;<a href="#">IDRA</a></span></p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Global Mailform Output-->
        <div class="snackbars" id="form-output-global"></div>
        <!-- Javascript-->
        <script src="js/core.min.js"></script>
        <script src="js/script.js"></script>
        <script src="js/scriptv2.js"></script>
        <!-- coded by Himic-->
</body>

</html>