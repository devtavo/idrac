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

        <div class="container">
            <br>
            <div class="row">
                <div class="col-lg-10">
                    <p><h5>Términos y Condiciones de uso</h5></p>
                    <p style="text-align:justify">
                        Es requisito necesario para la adquisición de los productos que se ofrecen en este sitio, que lea y acepte los siguientes Términos y Condiciones que a continuación se redactan. El uso de nuestros servicios, así como la compra de nuestros productos implicará que usted ha leído y aceptado los Términos y Condiciones de Uso en el presente documento. Todos los productos que son ofrecidos por nuestro sitio web pudieran ser creadas, cobradas, enviadas o presentadas por una página web tercera y en tal caso estarían sujetas a sus propios Términos y Condiciones. En algunos casos, para adquirir un producto, será necesario el registro por parte del usuario, con ingreso de datos personales fidedignos y definición de una contraseña.
                            <br>
                        El usuario puede elegir y cambiar la clave para su acceso de administración de la cuenta en cualquier momento, en caso de que se haya registrado y que sea necesario para la compra de alguno de nuestros productos. IDRA Capacitaciones no asume la responsabilidad en caso de que usted entregue dicha clave a terceros.
<br><br>
                        Todas las compras y transacciones que se lleven a cabo por medio de este sitio web, están sujetas a un proceso de confirmación y verificación, el cual podría incluir la verificación del stock y disponibilidad de producto, validación de la forma de pago, validación de la factura (en caso de existir) y el cumplimiento de las condiciones requeridas por el medio de pago seleccionado. En algunos casos puede que se requiera una verificación por medio de correo electrónico.
<br><br>
                        Los precios de los productos ofrecidos en esta Tienda Online son válidos solamente en las compras realizadas en este sitio web.
<br><br>
                        Licencia
                        IDRA Capacitaciones a través de su sitio web concede una licencia para que los usuarios utilicen los productos que son vendidos en este sitio web de acuerdo a los Términos y Condiciones que se describen en este documento.
<br><br>
                        Uso no autorizado
                        Usted no puede colocar uno de nuestros productos, modificado o sin modificar, en un CD, sitio web o ningún otro medio y ofrecerlos para la redistribución o la reventa de ningún tipo.
<br><br>
                        Propiedad
                        Usted no puede declarar propiedad intelectual o exclusiva a ninguno de nuestros productos, modificado o sin modificar. Todos los productos son propiedad de los proveedores del contenido. En caso de que no se especifique lo contrario, nuestros productos se proporcionan sin ningún tipo de garantía, expresa o implícita.
                        <br><br>
                        En ningún caso IDRA Capacitaciones será responsable de ningún daño incluyendo, pero no limitado a, daños directos, indirectos, especiales, fortuitos o consecuentes u otras pérdidas resultantes del uso o de la imposibilidad de utilizar nuestros productos.
                        <br><br>
                        Formas de pago
                        IDRA Capacitaciones se reserva el derecho de contratar a terceros que actúen como facilitadores para gestionar los pagos que se realicen a través de este sitio web. Asimismo, IDRA Capacitaciones procederá primero a verificar que el pago se haya realizado exitosamente para proceder con la inscripción.
                        <br><br>
                        Las siguientes formas de pago están permitidas en este sitio web:
                            <br><br>
                        Pago en línea
                        El usuario podrá efectuar el pago usando una tarjeta de crédito y/o débito a través de las pasarelas de pago habilitadas en este sitio web.
                        <br><br>
                        Depósito, Transferencia o Billetera Móvil
                        Para este procedimiento es necesario que usted envíe el voucher. En el caso de depósitos y transferencias interbancarias, el monto de la compra no incluye la comisión del banco. Por ello, usted debe revisar primero las comisiones del banco antes de realizar el depósito o transferencia.
                        <br><br>
                        El proceso de confirmación de la compra puede durar hasta 24 horas hábiles desde el momento que envía el comprobante por este sitio web.
                        <br><br>
                        Política de reembolso y garantía
                        En el caso de productos que sean mercancías irrevocables no-tangibles, no realizamos reembolsos después de que se envíe el producto, usted tiene la responsabilidad de entender antes de comprarlo. Le pedimos que lea cuidadosamente antes de comprarlo. Hacemos solamente excepciones con esta regla cuando la descripción no se ajusta al producto. Hay algunos productos que pudieran tener garantía y posibilidad de reembolso, pero este será especificado al comprar el producto.
                        <br><br>
                        Comprobación antifraude
                        La compra del cliente puede ser aplazada para la comprobación antifraude. También puede ser suspendida por más tiempo para una investigación más rigurosa, para evitar transacciones fraudulentas.
                        <br><br>
                        Privacidad
                        Este sitio web garantiza que la información personal que usted envía cuenta con la seguridad necesaria. Los datos ingresados por usuario o en el caso de requerir una validación de los pedidos no serán entregados a terceros, salvo que deba ser revelada en cumplimiento a una orden judicial o requerimientos legales. La suscripción a boletines de correos electrónicos publicitarios es voluntaria y podría ser seleccionada al momento de crear su cuenta. IDRA Capacitaciones reserva los derechos de cambiar o de modificar estos términos sin previo aviso.
                        <br> <br> </p>
                    <br>
                </div>
            </div>

        </div>

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