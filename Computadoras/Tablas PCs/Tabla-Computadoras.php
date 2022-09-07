<?php
session_start(); // Permite usar variables globales
include("../Union-Server.php"); //Union con la base de datos
?>
    <!DOCTYPE html>
    <html>

    <head>
        <title>Base de datos Alumnos</title>
        <link rel="stylesheet" href="styleusuarios.css">
    </head>

    <body>
<!-- Muestra imagen, nombre y rango -->
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
                    <?php if ($_SESSION["UserAdmin"]) { //Si el usuario es administrador se muestra ver usuarios
                    ?>
                        <li><a href="../Tablas PCs/Usuarios_logeados.php">Ver Usuarios</a></li>
                    <?php } ?>
                    <li><a href="../Perfil/Perfil.php">Perfil</a></li>
                    <li><a href="../Login/Logout.php">Cerrar Sesion</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</header>
<br></br>
<?php
/////Variables de consultas/////
$where = "";
$pagina = $_GET['pagina'];
$productosPorPagina = 3;
# Necesitamos el conteo para saber cuántas páginas vamos a mostrar
$sentencia = $base_de_datos->query("SELECT count(id) AS conteo FROM pcs");
$conteo = $sentencia->fetchObject()->conteo;
# Para obtener las páginas dividimos el conteo entre los productos por página, y redondeamos hacia arriba
$paginas = ceil($conteo / $productosPorPagina);
$offset = ($pagina - 1) * $productosPorPagina;
if (isset($_POST['xLaboratorio'])) {
    $xLaboratorio = $_POST['xLaboratorio'];
}
if (isset($_POST['xProcesador'])) {
    $xProcesador = $_POST['xProcesador'];
}
if (isset($_POST['xRAM'])) {
    $xRAM = $_POST['xRAM'];
}
///////Filtros Funcion////
if (isset($_POST['buscar'])) {
    if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador']) && empty($_POST['xLaboratorio']) && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0'";
    } else if (empty($_POST['xLaboratorio']) && empty($_POST['xRAM']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where Procesador like '" . $xProcesador . "%'";
    } else if (empty($_POST['xLaboratorio']) && empty($_POST['xProcesador']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where RAM>" . $xRAM . "";
    } else if (empty($_POST['xRAM']) && empty($_POST['xProcesador']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where Laboratorio='" . $xLaboratorio . "'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador']) && empty($_POST['xLaboratorio'])) {
        $where = "where Zocalos_Libres>'0' and  RAM>" . $xRAM . "";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador']) && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0' and  Laboratorio='" . $xLaboratorio . "'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xLaboratorio']) && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0' and Procesador like '" . $xProcesador . "%'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xLaboratorio'])) {
        $where = "where Zocalos_Libres>'0' and Procesador like '" . $xProcesador . "%' and RAM>" . $xRAM . "";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xRAM'])) {
        $where = "where Zocalos_Libres>'0' and Procesador like '" . $xProcesador . "%' and Laboratorio='" . $xLaboratorio . "'";
    } else if (empty($_POST['Zocalos_Libres?'])) {
        $where = "where Procesador like '" . $xProcesador . "%' and RAM>" . $xRAM . " and Laboratorio='" . $xLaboratorio . "'";
    } else if (!empty($_POST['Zocalos_Libres?'])  && empty($_POST['xProcesador'])) {
        $where = "where Zocalos_Libres>'0' and RAM>" . $xRAM . " and Laboratorio='" . $xLaboratorio . "'";
    } else if (empty($_POST['xLaboratorio']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where RAM>'" . $xRAM . "' and Procesador like '" . $xProcesador . "%'";
    } else if (empty($_POST['xProcesador']) && empty($_POST['Zocalos_Libres?'])) {
        $where = "where RAM>'" . $xRAM . "' and Laboratorio='" . $xLaboratorio . "'";
    } else if (empty($_POST['xRAM']) && !empty($_POST['Zocalos_Libres?']) && empty($_POST['xLaboratorio'])) {
        $where = "where Laboratorio='" . $xLaboratorio . "' and Procesador like '" . $xProcesador . "%'";
    } else {
        $where = "where Laboratorio='" . $xLaboratorio . "' and Procesador like '" . $xProcesador . "%' and RAM>'" . $xRAM . "' and Zocalos_Libres>'0'";
    }
}
////Consulta a la base de datos/////
$Laboratorios = "SELECT * FROM `laboratorios`";
$PCs = "SELECT * FROM `pcs` $where  limit 3 offset $offset";
$resPCs = $conex->query($PCs);
$resLaboratorio = $conex->query($Laboratorios);

//si el usuario no se logeo es explusado
if (((empty($_SESSION["Email"])))) {
    header("location: ../Login/Login.php");
} else {
?>

        <br><br>
        <!--Seccion de filtros -->
        <section>
            <form method="POST" class="Filtros">
                <!-- Muestro los laboratorios-->
                
                <select name="xLaboratorio">
                    <option value="">Laboratorios ↓</option>
                    <?php
                    while ($RegistroLaboratorios = $resLaboratorio->fetch_array(MYSQLI_BOTH)) {
                        echo '<option value="' . $RegistroLaboratorios['Laboratorio'] . '">' . $RegistroLaboratorios['Laboratorio'] . '</option>';
                    }
                    ?>
                </select>
                <!--Procesador, ram y zocalos libres-->
                <input class="input"type="text" placeholder="Procesador..." value="" name="xProcesador">
                <input class="input"type="number" name="xRAM" placeholder="PC con RAM mayor a..." />
                <div class="txt">Ver pc con zocalos Libres</div>
                <div class="boton">
                <input type="checkbox" id="btn-switch" name="Zocalos_Libres?" value="1" /> 
                <label for="btn-switch" class="lbl-switch"></label>
                <!-- Boton de busqueda -->
                <button class="botonbuscar" name="buscar" type="submit">Buscar</button>
            </form>

            <br></br>
            <?php
            //Mensaje de error si no se encontro los datos que se insertaron en el filtro
            if (mysqli_num_rows($resPCs) == 0) {
                $mensaje = "<h1>No se encontraron registros con esas busquedas</h1>";
            } else {
            ?>
                
                    <div class="contenidotabPC">
                        <!-- fila de la tabla-->
                        <table class="table">
                            <thead>
                                <tr>

                        <th>ID</th> <!-- columna id-->
                        <th>Procesador</th>
                        <th>RAM</th>
                        <th>MotherBoard</th>
                        <th>Zocalos</th>
                        <th>HDD</th>
                        <th>Marca</th>
                        <th>Laboratorio</th>
                        <th>DIMMs</th>
                        <th>Zocalos Libres</th>
                        <th>PS/2</th>
                        <th>Administrador</th>
                        <?php if ($_SESSION["UserAdmin"]) { //Si el usuario es admin puede editar
                        ?>
                            <th>Editar/Historial</th><!-- columna editar-->
                    </tr>
                        </thead>
                <?php
                        } //imprime por pantalla las pcs 
                        while ($mostrar = $resPCs->fetch_array(MYSQLI_BOTH)) {
                ?>
                    <tbody>
                        <tr>
                        <!-- ID oculto para ocupar en eliminar y editar(con el id se sabe cual se selecciono para hacer los cambios) -->
                        <input type="hidden" value="<?php echo $mostrar['ID'] ?>" name="ID">
                        <td data-label="ID"><?php echo $mostrar['ID'] ?></td><!-- muestra el id de la base de datos en la tabla-->
                        <td data-label="Procesador"><?php echo $mostrar['Procesador'] ?></td>
                        <td data-label="RAM"><?php echo $mostrar['RAM'] ?></td>
                        <td data-label="MotherBoard"><?php echo $mostrar['MotherBoard'] ?></td>
                        <td data-label="Zocalos"><?php echo $mostrar['Zocalos'] ?></td>
                        <td data-label="HDD"><?php echo $mostrar['HDD'] ?></td>
                        <td data-label="Marca"><?php echo $mostrar['Marca'] ?></td>
                        <td data-label="Laboratorio"></a><?php echo $mostrar['Laboratorio'] ?></td>
                        <td data-label="DIMMs"><?php echo $mostrar['DIMMs'] ?></td>
                        <td data-label="Zocalos_Libres"><?php echo $mostrar['Zocalos_Libres'] ?></td>
                        <td data-label="PS/2"><?php echo $mostrar['PS/2'] ?></td>
                        <td data-label="Administrador"><?php echo $mostrar['Administrador'] ?></td>
                        <?php if ($_SESSION["UserAdmin"]) { // si es administrador puede editar y ver el historial
                        ?>
                            <td><a href="../Tablas PCs/update/actualizar.php?ID=<?php echo $mostrar["ID"]; ?>">Editar/</a>      
                               <a href="../Tablas PCs/Historial_PCs.php?ID=<?php echo $mostrar["ID"]; ?>">Historial</a></td>
                            </tr>
                        </tbody>
                        </div>
        <?php
                            }
                        }
                    }
        ?>
               
                <?php //Mensaje de error
                if (!empty($mensaje)) {
                    echo $mensaje;
                }
                ?>
                
                <?php if ($_SESSION["UserAdmin"]) { //Si es admin puede agregar
                ?>
                <div class="derecha">
                    <button class="botonAnexar" onclick="window.location.href = '../Agregar PCs/Formulario.php'">Anexar</button><!-- boton que lleva a anexar un nuevo usuario-->
                </div>    
            <?php
                }
            }
            ?>
            <!-- Paginacion -->
            <div class="centrar">
            <ul class="pagination">
                <?php if ($pagina > 1) { ?>
                    <li>
                        <a href="./Tabla-Computadoras.php?pagina=<?php echo $pagina - 1 ?>">«
                        </a>
                    </li>
                <?php } ?>
                <?php for ($x = 1; $x <= $paginas; $x++) { ?>
                    <li class="<?php if ($x == $pagina) echo "active" ?>">
                        <a href="./Tabla-Computadoras.php?pagina=<?php echo $x ?>">
                            <?php echo $x ?></a>
                    </li>
                <?php } ?>
                <?php if ($pagina < $paginas) { ?>
                    <li>
                        <a href="./Tabla-Computadoras.php?pagina=<?php echo $pagina + 1 ?>">»
                        </a>
                    </li>
                <?php } ?>
            </ul>
                </div>
        </section>
    </body>

    </html>