<?php
session_start(); //se inicia la sesion que sirve para guardar variables globales
include("../Union-Server.php"); //conexion de la base de datos
//Seleccionar la tabla de laboratorios y hacer conexion
$Laboratorios = "SELECT * FROM `laboratorios`";
$resLaboratorio = $conex->query($Laboratorios);
//si el usuario no se logeo lo devuelve
if (((empty($_SESSION["Email"])))) {
    header("location: ../Login/Login.php");
} else {
?>
    <html>

    <head>
        <title>Formulario para agregar una PC</title>
        <link rel="stylesheet" href="../Style.css">
    </head>

    <body>
        <!-- Muestra la imagen nombre y rango -->
        <img src="<?php echo str_replace("./", "../", $_SESSION['Imagen']) ?>" alt="imagen"> <?php echo $_SESSION['Nombre'];
                                                                                                if ($_SESSION['UserAdmin'] == 0) {
                                                                                                    echo "<h5>Usuario</h5>";
                                                                                                } else {
                                                                                                    echo "<h5>Administrador</h5>";
                                                                                                }  ?>
        <?php
        //toma los datos del formulario de PC y lo almaceno en variables
        if (isset($_POST['submit'])) {
            $Procesador = trim($_POST['Procesador']);
            $RAM = trim($_POST['RAM']);
            $MotherBoard = trim($_POST['MotherBoard']);
            $Zocalos = ($_POST['Zocalos']);
            $HDD = ($_POST['HDD']);
            $Marca = ($_POST['Marca']);
            $Laboratorio = ($_POST['Laboratorio']);
            $DIMMs = ($_POST['DIMMs']);
            $Zocalos_Libres = ($_POST['Zocalos_Libres']);
            if (!empty($_POST['PS2'])) {
                $PS2 = 1;
            } else {
                $PS2 = 0;
            };
        }
        ?>
        <!-- DESPLEGABLE -->
        <header>
            <nav>
                <ul id="menu">
                    <li><a href="../PaginaDeInicio.php">Inicio</a>
                        <ul>
                            <?php if ($_SESSION["UserAdmin"]) { //Si es administrador puede ver los usuarios
                            ?>
                                <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                            <?php } ?>
                            <li><a href="../Tablas PCs/Tabla-Computadoras.php?pagina=1">Ver Tabla de PCs</a></li>
                            <li><a href="../Perfil/Perfil.php">Ver Perfil</a></li>
                            <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                        </ul>
                    </li>
                </ul>
            </nav>
        </header>

        <br></br>
        <h1>Agregar PC</h1>
        <!-- Formulario PC -->
        <form action="" method="POST">
            <p>Procesador:<input type="text" name="Procesador" value="<?php
                                                                        if (isset($Procesador)) echo "$Procesador" ?>" /></p>
            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
            <p>Memoria RAM:<input type="number" name="RAM" value="<?php
                                                                    if (isset($RAM)) echo "$RAM" ?>" /></p>
            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
            <p>MotherBoard:<input type="text" name="MotherBoard" value="<?php
                                                                        if (isset($MotherBoard)) echo "$MotherBoard" ?>" /></p>
            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
            <p>Nro, #Zocalos de Ram<input type="number" name="Zocalos" value="<?php
                                                                                if (isset($Zocalos)) echo "$Zocalos" ?>" /></p>
            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
            <p>Disco:<input type="text" name="HDD" value="<?php
                                                            if (isset($HDD)) echo "$HDD" ?>" /></p>
            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
            <p>Marca:<input type="text" name="Marca" value="<?php
                                                            if (isset($Marca)) echo "$Marca" ?>" /></p>
            <!-- Muestro todos los laboratorios de a base de datos -->
            <p>Seleccionar:<select name="Laboratorio">
                    <option value="">Laboratorios</option>
                    <?php
                    while ($RegistroLaboratorios = $resLaboratorio->fetch_array(MYSQLI_BOTH)) {
                        echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . '">' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                    }
                    ?>
                </select></p>
            <p>DIMMs:<input type="text" name="DIMMs" value="<?php
                                                            if (isset($DIMMs)) echo "$DIMMs" ?>" /></p>
            <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
            <p>Zocalos_Libres:<input type="text" name="Zocalos_Libres" value="<?php
                                                                                if (isset($Zocalos_Libres)) echo "$Zocalos_Libres" ?>" /></p>
            <!--checkbox -->
            <p>PS/2:<input type="checkbox" name="PS2" value="1" /></p>
            <p><input type="submit" name="submit" value="Enviar" /></p>
        </form>
    <?php
    include("../Agregar PCs/Server-Form.php"); //Luego de rellenar todo lo manda al proceso de server-form
}
    ?>
    </body>

    </html>