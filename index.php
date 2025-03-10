<?php
session_start(); //Iniciamos la sesion (UNICA)
require_once('conex.php');
$conex = conex();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre   = mysqli_real_escape_string($conex, $_POST['nombre']);
    $contacto = mysqli_real_escape_string($conex, $_POST['contacto']);
    $mensajeF = mysqli_real_escape_string($conex, $_POST['mensaje']);

    $sql = "INSERT INTO formulario (nombre, contacto, mensaje) VALUES ('$nombre','$contacto','$mensajeF')";
    $result = mysqli_query($conex, $sql);

    if ($result) {
        $_SESSION['flash'] = "<p class='mensajeExito'>Datos guardados correctamente.</p>";
    } else {
        $_SESSION['flash'] = "<p class='mensajeError'>Error: " . mysqli_error($conex) . "</p>";
    }

    header("Location: index.php#anotate"); //El '#anotate' sirve para que no vuelva arriba del todo luego de ingresar datos en el formulario
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Houzy</title>
    <link href="https://fonts.cdnfonts.com/css/bentonsans-regular" rel="stylesheet">
    <link rel="stylesheet" href="styles/styles.css">

    <link rel="icon" type="image/png" sizes="64x64" href="img/isotipo1.png">

    <script>
        let navType = performance.getEntriesByType("navigation")[0]?.type;
        if (!navType && performance.navigation) {
            navType = performance.navigation.type === 1 ? "reload" : "navigate";
        }
        // Si el hash es "#anotate" y NO es una recarga manual, establecemos el flag.
        if (window.location.hash === "#anotate" && navType !== "reload") {
            sessionStorage.setItem("justSubmitted", "1");
        }
    </script>
</head>
<body>
    <header>
        <a href="#"><img src="img/logo.png" alt="logo" class="logo"></a>
        <nav id="home">
            <ul>
                <li><a href="#" class="hide" >home</a></li>
                <li><a href="#about-us">quienes somos</a></li>
                <li><a href="#anotate">anotate</a></li>
            </ul>
        </nav>
    </header>
    
    <section class="hero">
        <div class="overlay">
            <h1>Find your house, <br> feel cozy, <br> <span>use houzy</span></h1>
            <p><strong>Cambiamos las reglas del juego en el mundo inmobiliario.</strong><br>
                Ofrecemos libertad y autogestión a una nueva generación de compradores y vendedores. 
                Olvidate de las comisiones abusivas y los intermediarios innecesarios: acá sos vos quien tiene el control.</p>
        </div>
    </section>
    
    <section class="video">
        <iframe width="100%" height="100%" src="https://www.youtube.com/embed/1IQcf_bic10?si=3-7iSImx9cec9sPp" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </section>
    
    <section class="form" id="anotate">
        <form class="info-form" method="POST">
            <h2>Quiero ser parte</h2>
            <input class="placeholder-form" 
                type="text" 
                placeholder="Nombre y apellido"
                name="nombre"
                required>
            <input class="placeholder-form" 
                type="text" 
                placeholder="Contacto"
                name="contacto"
                required>
            <input class="placeholder-form" 
                type="text" 
                placeholder="Duda"
                name="mensaje"
                required>
            <button type="submit">Enviar</button>
            <?php
            //Se muestra el mensaje debido dependiendo de si es valido o da error
            if (isset($_SESSION['flash'])) {
                echo $_SESSION['flash'];
                unset($_SESSION['flash']);
            }
            ?>
        </form>
    </section>

    <section class="about" id="about-us">
      <h2>Sobre nosotros</h2>
      <div class="about-content">
        <p>
          En <span>Houzy</span>, estamos revolucionando el mercado inmobiliario al ofrecer una plataforma 
          que pone el control en manos de los usuarios. Nuestra misión es facilitar el proceso de compra y venta 
          de propiedades de manera más transparente, eficiente y accesible. Nos alejamos de las comisiones excesivas 
          y los intermediarios innecesarios, brindando a compradores y vendedores la libertad de gestionar sus propios 
          acuerdos.
          <br><br>
          Nuestro compromiso es brindar una experiencia intuitiva, segura y completamente autogestionada, que permita a 
          todos tener acceso directo a las mejores opciones inmobiliarias sin complicaciones ni sorpresas.
        </p>
        <img class="img-edi" src="img/aboutusfoto.jpg" alt="Edificio">
      </div>
    </section>
    <script src="script/script.js"></script>
    <script src="script/recargaPagina.js"></script>  
</body>
</html>
