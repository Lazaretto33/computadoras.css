<?php
session_start();
include("../Union-Server.php"); //Union con el servidor
//Si el usuario no se logeo lo expulsa
if (((empty($_SESSION["Email"])))) {
    header("location: ../Login/Login.php");
} else {
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Base de datos Alumnos</title>
        <link rel="stylesheet" href="../style.css">
    </head>

    <body>
        <!-- muestra Imagen Nombre y rango-->
        <img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre'];
                                                                                                if ($_SESSION['UserAdmin'] == 0) {
                                                                                                    echo "<h5>Usuario</h5>";
                                                                                                } else {
                                                                                                    echo "<h5>Administrador</h5>";
                                                                                                }  ?>
        <!-- DESPLEGABLE -->
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="../PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) { //Si el usuario es administrador
                            ?>
                                <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="../Perfil/Perfil.php">Perfil</a></li>
                            <li><a href="../Tablas PCs/Tabla-Computadoras.php?pagina=1">Ver computadoras</a></li>
                            <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>
        <form>
        <?php
        // Se obtiene en ID de la pc para seleccionarla
        $id = $_GET["ID"];
        $Computadoras = "SELECT * FROM `pcs` WHERE ID = '$id'";
        // Selecciono la base de datos de historial para mostrar los datos de la pc
        $ComputadorasHistorial = "SELECT * FROM `historial pcs` WHERE PC = '$id'";
        $ResultadoComputadoras = mysqli_query($conex, $Computadoras);
        $Historial = mysqli_query($conex, $ComputadorasHistorial); //conexion para ver la tabla de historial
        //Para mostrar el ID de la pc
        $mostrarPC = mysqli_fetch_array($ResultadoComputadoras);
        echo "<p>Computadora N°" . $mostrarPC['ID'] . "</p>";
        $vacio = 1;  //vacio para verificar si tiene historial
        //Muestra el historial                       
        while ($mostrar = mysqli_fetch_array($Historial)) {
            echo "<p>" . $mostrar['Fecha'] . "</p>"; //Se muestra la fecha
            echo "<p>" . $mostrar['Historial'] . "</p>"; //Se muestra el historial
            $vacio = 0;
        }
        //Si no tiene historial muestra:
        if ($vacio) {
            echo "<h1>No hay historial en esta PC</h1>";
        }
    }

        ?>
        </form>
    </body>

    </html>