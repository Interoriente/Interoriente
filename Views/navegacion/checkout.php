<?php
include "../../Controllers/php/users/compras.php";
$checkout = new Checkout();
$checkoutData = $checkout->getCheckoutInfo();
$checkoutImgData = $checkout->getImgCheckoutInfo();
$subtotal = 0;
$total = 0;
$iva = 0;
$cont = 0;
$contMob = 0;
foreach ($checkoutData as $i) {
  $subtotal += $i['subtotal'];
  $iva += $i['iva'];
  $total += $i['total'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Favicon -->
  <link rel="icon" href="../assets/img/favicon.png" type="image/png" />
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <!-- Css local  -->
  <link rel="stylesheet" href="../assets/css/general.css" />
  <link rel="stylesheet" href="../assets/css/checkout.css" />
  <title>Checkout | Interoriente</title>
</head>

<body>
  <!-- Barra de navegación -->
  <div class="navegacion">
    <a href="index.php"> <img id="logo" src="../assets/img/LogoCuaternario.svg" alt="Logo barra de navegación"></a>
  </div>

  <!-- Fin barra de navegación -->

  <!-- Acordeón para dispositivos móviles  -->
  <div class="accordion accordion-flush acordeon" id="accordionFlushExample">
    <div class="accordion-item">
      <h2 class="accordion-header" id="flush-headingOne">

        <button class="accordion-button collapsed titulo-colapse" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
          <div class="carrito-descripcion">
            <div class="carrito-texto">
              <img id="carrito" src="../assets/img/iconos/carrito_2.svg" alt="carrito"> Mostrar resumen del pedido
            </div>
            <div class="precios">
              $<?=  number_format($total, 0, '', '.') ?>
            </div>
          </div>

    </div>
    </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body acordeon-c">

        <!-- Publicación -->

        <?php foreach ($checkoutData as $res) : ?>
          <div class="contenedor-items">
            <div class="img-descripcion">
              <div class="contenedor-imagen">
                <img src="<?= $checkoutImgData[$contMob] ?>" alt="imagen alusiva a la compra">
              </div>
              <p id="titulo-publicacion"><?= $res["Titulo"] ?></p>
            </div>
            <div class="precio">
              <p>$<?= number_format($res["costo"], 0, '', '.');?></p>
            </div>
          </div>
        <?php $contMob++;
        endforeach ?>
        <!-- FIN Publicación -->
        <!-- Datos de compra  -->

        <hr>

        <div class="main-container">
          <div class="contenedor-datos g">
            <div class="titulo">
              <!-- <p>Descuentos</p> -->
              <p>Subtotal</p>
              <p>IVA</p>
            </div>
            <div class="valor">
              <!-- <p>$23.000</p> -->
              <p>$<?= number_format($subtotal, 0, '', '.'); ?></p>
              <p>$<?= number_format($iva, 0, '', '.');?></p>
            </div>
          </div>
          <hr>
          <div class="total g">
            <p>total</p>
            <p>$<?= number_format($total, 0, '', '.') ?></p>
          </div>
        </div>

        <!-- Fin de datos de compra -->
      </div>
    </div>
  </div>
  <hr id="separador">
  <!-- Fin Acordeón para dispositivos móviles   -->


  <div class="contenedor-desk">

    <div class="contenedor-principal">

      <!-- Modal -->

      <!-- Tarjeta de contacto -->
      <h1 class="h1-datos-contacto">Datos de contacto</h1>
      <div class="tarjeta-contacto">

        <!-- Contenedor información de contacto -->

        <div id="contacto-email" class="contacto">

          <div id="email-contacto" class="correo-contacto ">
            <h6>Correo Electrónico</h6>
            <p id="email-contacto-p">Cargando...</p>
          </div>
          <div id="cambiar-email" class="btn-cambiar">
            <p id="cambiar" onclick="cambiarCorreoContacto()">cambiar</p>
          </div>
        </div>

        <!-- FIN Contenedor información de contacto -->
        <hr>
        <div id="contenedor-direccion-principal" class="direccion">
          <!-- Contenedor Contacto -->
          <div class="direcciones contacto">
            <div class="direccion correo-contacto cont-dir">
              <h6>Dirección de envío</h6>
              <div id="contenedor-direccion-final">
                <div class="direccion-final">
                  <p id="direccion"></p>
                  <p id="cambiar" class="editar-direccion" onclick="cambiarDireccionEnvio()">cambiar</p>
                </div>
              </div>
              <div class="titulo-eleccion-direccion">
                <p>Tus direcciones:</p>
              </div>
              <div id="contenedor-lista-dir" class="lista-direcciones">
                <!-- Lista de Direcciones Cargadas desde JS -->

              </div>
            </div>
          </div>

        </div>
        <!-- FIN contenedor direccion -->
      </div>
      <!-- FIN Contenedor Contacto -->
      <!-- Fin tarjeta de contacto -->
      <!-- Método de pago Tarjeta -->
      <div class="payment-title">
        <h1>Información de pago</h1>
      </div>
      <div class="container preload">
        <div class="creditcard">
          <div class="front">
            <div id="ccsingle"></div>
            <svg version="1.1" id="cardfront" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
              <g id="Front">
                <g id="CardBackground">
                  <g id="Page-1_1_">
                    <g id="amex_1_">
                      <path id="Rectangle-1_1_" class="lightcolor grey" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                            C0,17.9,17.9,0,40,0z" />
                    </g>
                  </g>
                  <path class="darkcolor greydark" d="M750,431V193.2c-217.6-57.5-556.4-13.5-750,24.9V431c0,22.1,17.9,40,40,40h670C732.1,471,750,453.1,750,431z" />
                </g>
                <text transform="matrix(1 0 0 1 60.106 295.0121)" id="svgnumber" class="st2 st3 st4">0123 4567 8910 1112</text>
                <text transform="matrix(1 0 0 1 54.1064 428.1723)" id="svgname" class="st2 st5 st6">PEPE PÉREZ</text>
                <text transform="matrix(1 0 0 1 54.1074 389.8793)" class="st7 st5 st8">Nombre</text>
                <text transform="matrix(1 0 0 1 479.7754 388.8793)" class="st7 st5 st8">Expiración</text>
                <text transform="matrix(1 0 0 1 65.1054 241.5)" class="st7 st5 st8">Número tarjeta</text>
                <g>
                  <text transform="matrix(1 0 0 1 574.4219 433.8095)" id="svgexpire" class="st2 st5 st9">01/23</text>
                  <text transform="matrix(1 0 0 1 479.3848 417.0097)" class="st2 st10 st11">VALIDA</text>
                  <text transform="matrix(1 0 0 1 479.3848 435.6762)" class="st2 st10 st11">HASTA</text>
                  <polygon class="st2" points="554.5,421 540.4,414.2 540.4,427.9 		" />
                </g>
                <g id="cchip">
                  <g>
                    <path class="st2" d="M168.1,143.6H82.9c-10.2,0-18.5-8.3-18.5-18.5V74.9c0-10.2,8.3-18.5,18.5-18.5h85.3
                        c10.2,0,18.5,8.3,18.5,18.5v50.2C186.6,135.3,178.3,143.6,168.1,143.6z" />
                  </g>
                  <g>
                    <g>
                      <rect x="82" y="70" class="st12" width="1.5" height="60" />
                    </g>
                    <g>
                      <rect x="167.4" y="70" class="st12" width="1.5" height="60" />
                    </g>
                    <g>
                      <path class="st12" d="M125.5,130.8c-10.2,0-18.5-8.3-18.5-18.5c0-4.6,1.7-8.9,4.7-12.3c-3-3.4-4.7-7.7-4.7-12.3
                            c0-10.2,8.3-18.5,18.5-18.5s18.5,8.3,18.5,18.5c0,4.6-1.7,8.9-4.7,12.3c3,3.4,4.7,7.7,4.7,12.3
                            C143.9,122.5,135.7,130.8,125.5,130.8z M125.5,70.8c-9.3,0-16.9,7.6-16.9,16.9c0,4.4,1.7,8.6,4.8,11.8l0.5,0.5l-0.5,0.5
                            c-3.1,3.2-4.8,7.4-4.8,11.8c0,9.3,7.6,16.9,16.9,16.9s16.9-7.6,16.9-16.9c0-4.4-1.7-8.6-4.8-11.8l-0.5-0.5l0.5-0.5
                            c3.1-3.2,4.8-7.4,4.8-11.8C142.4,78.4,134.8,70.8,125.5,70.8z" />
                    </g>
                    <g>
                      <rect x="82.8" y="82.1" class="st12" width="25.8" height="1.5" />
                    </g>
                    <g>
                      <rect x="82.8" y="117.9" class="st12" width="26.1" height="1.5" />
                    </g>
                    <g>
                      <rect x="142.4" y="82.1" class="st12" width="25.8" height="1.5" />
                    </g>
                    <g>
                      <rect x="142" y="117.9" class="st12" width="26.2" height="1.5" />
                    </g>
                  </g>
                </g>
              </g>
              <g id="Back">
              </g>
            </svg>
          </div>
          <div class="back">
            <svg version="1.1" id="cardback" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 750 471" style="enable-background:new 0 0 750 471;" xml:space="preserve">
              <g id="Front">
                <line class="st0" x1="35.3" y1="10.4" x2="36.7" y2="11" />
              </g>
              <g id="Back">
                <g id="Page-1_2_">
                  <g id="amex_2_">
                    <path id="Rectangle-1_2_" class="darkcolor greydark" d="M40,0h670c22.1,0,40,17.9,40,40v391c0,22.1-17.9,40-40,40H40c-22.1,0-40-17.9-40-40V40
                        C0,17.9,17.9,0,40,0z" />
                  </g>
                </g>
                <rect y="61.6" class="st2" width="750" height="78" />
                <g>
                  <path class="st3" d="M701.1,249.1H48.9c-3.3,0-6-2.7-6-6v-52.5c0-3.3,2.7-6,6-6h652.1c3.3,0,6,2.7,6,6v52.5
                    C707.1,246.4,704.4,249.1,701.1,249.1z" />
                  <rect x="42.9" y="198.6" class="st4" width="664.1" height="10.5" />
                  <rect x="42.9" y="224.5" class="st4" width="664.1" height="10.5" />
                  <path class="st5" d="M701.1,184.6H618h-8h-10v64.5h10h8h83.1c3.3,0,6-2.7,6-6v-52.5C707.1,187.3,704.4,184.6,701.1,184.6z" />
                </g>
                <text transform="matrix(1 0 0 1 621.999 227.2734)" id="svgsecurity" class="st6 st7">985</text>
                <g class="st8">
                  <text transform="matrix(1 0 0 1 518.083 280.0879)" class="st9 st6 st10">Cód. seguridad</text>
                </g>
                <rect x="58.1" y="378.6" class="st11" width="375.5" height="13.5" />
                <rect x="58.1" y="405.6" class="st11" width="421.7" height="13.5" />
                <text transform="matrix(1 0 0 1 59.5073 228.6099)" id="svgnameback" class="st12 st13">PEPE PÉREZ</text>
              </g>
            </svg>
          </div>
        </div>
      </div>
      <div class="form-container">
        <div class="field-container">
          <label for="name">Nombre</label>
          <input id="name" maxlength="20" type="text">
        </div>
        <div class="field-container">
          <label for="cardnumber">Número de tarjeta</label><span id="generatecard">Aleatorio</span>
          <input id="cardnumber" type="text" pattern="[0-9]*" inputmode="numeric">
          <svg id="ccicon" class="ccicon" width="750" height="471" viewBox="0 0 750 471" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">

          </svg>
        </div>

        <div class="field-container this">
          <label for="expirationdate"> Fecha Expiración (mm/yy)</label>
          <input id="expirationdate" type="text" pattern="[0-9]*" inputmode="numeric">
        </div>
        <div class="field-container">
          <label for="securitycode">Código de seguridad</label>
          <input id="securitycode" type="text" pattern="[0-9]*" inputmode="numeric">
        </div>
      </div>
      <!-- Botón "Finalizar compra" -->

      <div class="btn-fin-compra btn-movil ">
        <button id="btn-fin-compra">Finalizar Compra</button>
      </div>

      <!--FIN botón de compra -->
    </div>

    <!-- Layout para version de escritorio -->


    <div class="resumen-desk">
      <!-- Contenedor Publicación  -->
      <div class="contenedor-publi">
        <!-- Publicación  -->
        <?php foreach ($checkoutData as $fila) : ?>
          <div class="publicacion-desktop">
            <img id="img-publicacion-d" src="<?= $checkoutImgData[$cont] ?>" alt="Imagen publicación">
            <div class="texto-publicacion-d">
              <p><?= $fila['Titulo'] ?></p>
              <p class="precio">$<?= number_format($fila['costo'], 0, '', '.') ?></p>
              <p class="cantidad-publi">Cantidad: <span class="cantidad"><?= $fila['cantidad'] ?> </span></p>
            </div>
          </div>
        <?php $cont++; endforeach ?>
        <!-- Fin Publicación  -->
      </div>
      <!-- FIN Contenedor Publicación  -->

      <!-- Resumen de compra -->
      <h1 id="titulo-resumen">Resumen de compra</h1>
      <hr>

      <div class="main-container resumen-desktop">
        <div class="contenedor-datos g">
          <div class="titulo">
            <p>Subtotal</p>
            <!-- <p>Descuentos</p> -->
            <p>+ 19% IVA</p>
          </div>
          <div class="valor">
            <p>$<?= number_format($subtotal, 0, '', '.'); ?></p>
            <!-- <p>$23.000</p> -->
            <p>$<?= number_format($iva, 0, '', '.'); ?></p>
          </div>
        </div>
        <hr>
        <div class="total g">
          <p>total</p>

          <p>$<?= number_format($total, 0, '', '.'); ?></p>
        </div>
      </div>
      <!-- Botón "Finalizar compra" -->
      <div class="btn-fin-compra ">
        <button id="btn-fin-compra-d">Finalizar Compra</button>
      </div>


      <!--FIN botón de compra -->
    </div>
    <!-- Layout para version de escritorio -->

  </div>

  <!-- JavaScript  -->
  <script src="../js/tarjeta.js"></script>
  <script src="../js/checkout.js"></script>
  <script src='https://cdnjs.cloudflare.com/ajax/libs/imask/3.4.0/imask.min.js'></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>

</html>