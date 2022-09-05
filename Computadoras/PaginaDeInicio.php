<?php session_start(); // para usar las variables globales 
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <title>Inicio</title>
  <html lang="es">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./Estilos.css/loginRegistro.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head> 
<body>
    <!-- Imagen Nombre y rango nav -->
    
    <p><img src="<?php echo $_SESSION['Imagen'] ?>" alt="imagen"> <?php echo $_SESSION['Nombre'];
                                                                    if ($_SESSION['UserAdmin'] == 0) {
                                                                        echo "<h5>Usuario</h5>";
                                                                    } else {
                                                                        echo "<h5>Administrador</h5>";
                                                                    }  ?></p>
    <?php
    //si el usuario no se logeo lo devuelve
    if (((empty($_SESSION["Email"])))) {
        header("location: Login/Login.php");
    } else { ?>
        <!-- nav completa -->
    <header> 
    <img src="<?php echo $_SESSION['Imagen'] ?>" alt="imagen"> <?php echo $_SESSION['Nombre'];
                                                                    if ($_SESSION['UserAdmin'] == 0) {
                                                                        echo "<h5>Usuario</h5>";
                                                                    } else {
                                                                        echo "<h5>Administrador</h5>";
                                                                    }  ?>
        <nav> 
            <ul class="nav_link"> 
                <li> <a href="PaginaDeInicio.php">Inicio</a> </li>
                <li> <?php if ($_SESSION["UserAdmin"]) { // si es administrador puede ver los usuarios
                            ?>
                                <a href="Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a>
                            <?php } ?> </li>

                <li> <a href="Tablas PCs/Tabla-Computadoras.php?pagina=1">Ver tabla PC</a> </li>
                <li> <a href="Login/Logout.php">Cerrar Sesion</a> </li>
            </ul>
        </nav>
        <a class="perfil" href="Perfil/Perfil.php">Perfil</a> </a>
    </header>

                    <li><a href="PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) { // si es administrador puede ver los usuarios
                            ?>
                                <li><a href="Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="Tablas PCs/Tabla-Computadoras.php?pagina=1">Ver Tabla de PCs</a></li>
                            <li><a href="Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <br></br>
        <div class="ConteinerInicio">
            <?php
            echo "<h1>Bienvenido " . $_SESSION["Nombre"] . "</h1>"; ?>
            <!-- Boton que lleva a la tabla de computadoras -->
            <a href="Tablas PCs/Tabla-Computadoras.php?pagina=1"><input class="BotonInicio" type="button" value="Ver tabla de las PCs"></a> <?php
                                                                                                                                }
                                                                                                                                    ?>
        </div>
</body>

</html>