<?php session_start();
include("../Union-Server.php"); //union de la base de datos
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Perfil</title>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php
    //si el usuario no se logeo lo manda a la pagina de login
    if (((empty($_SESSION["Email"])))) {
        header("location: ../Login/Login.php");
    } else { ?>
        <!-- EL DESPLEGABLE -->
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="../PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) { //si el usuario es administrador puede ver la tabla usuarios
                            ?>
                                <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="../Tablas PCs/Tabla-Computadoras.php?pagina=1">Ver Tabla de PCs</a></li>
                            <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <br></br>
        <form action="../Tablas PCs/update/actualizar.php" method="POST" enctype="multipart/form-data">
            <?php
            //se selecciona atraves del id para que muestre el usuario a actualizar
            $SQL = "SELECT * FROM `login-alumnos` WHERE IDLogin = '" . $_SESSION["IDLogin"] . "'";
            $Resultado = mysqli_query($conex, $SQL);
            while ($mostrar = mysqli_fetch_array($Resultado)) { //imprime los datos del usuario
            ?>
                <img src="<?php echo str_replace("./", "../", $mostrar['Imagen']) ?>" alt="imagen">
                <p>Nombre: <?php echo $mostrar['Nombre'] ?></p>
                <p>Email: <?php echo $mostrar['Email'] ?></p>
                <p>Contraseña: <?php echo $mostrar['Contraseña'] ?></p>
                <input type="submit" value="Editar" name="submitPerfil"><!-- Boton de actualizar que lleva al proceso_update -->
        <?php
            }
        }
        ?>
        </form>
</body>

</html>