<script>
    function otraPagina() { //da un mensaje cuando se inserta correctamente
        var confirmar = confirm('Se insterto correctamente');
        if (confirmar) {

            window.location.href = '../Tablas PCs/Tabla-Computadoras.php?pagina=1'

        } else {
            alert('hubo un error')
        }
    }
</script>
<?php
include("../Union-Server.php"); //Union de la base de datos
//verifica que se haya logeado
if ((empty($_SESSION["email"]))) {
    header("location: ../Login/Login.php");
} else {
    //toma los datos del formulario  para subirlo a la base de datos y tirar los mensajes de error
    if (isset($_POST['submit'])) {

        if (empty($Procesador)) {
            echo "<p class='error'>* Agregue un procesador</p>"; //mensaje de error si el nombre esta vacio
        }
        if (empty($RAM)) {
            echo "<p class='error'>* Agregue la cantidad de RAM</p>"; //mensaje de error si la edad esta vacio
        }
        if (empty($MotherBoard)) {
            echo "<p class='error'>* Agregue un MotherBoardl</p>"; //mensaje de error si el mail esta vacio
        }
        if (empty($Zocalos)) {
            echo "<p class='error'>* Agregue la cantidad de zocalos</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($HDD)) {
            echo "<p class='error'>* Agregue el HDD</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($Marca)) {
            echo "<p class='error'>* Agregue la Marca de PC</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($Laboratorio)) {
            echo "<p class='error'>* Agregue un laboratorio</p>"; //mensaje de error si el telefono esta vacio
        }
        if (empty($DIMMs)) {
            echo "<p class='error'>* Agregue el tipo de dimm</p>"; //mensaje de error si el telefono esta vacio
        } //verifica que los campos no esten vacios
        if (strlen($_POST['Procesador']) > 1 && strlen($_POST['RAM']) > 0 && strlen($_POST['MotherBoard']) > 1 &&  strlen($_POST['Zocalos']) > -1 && strlen($_POST['HDD']) > 1 && strlen($_POST['Marca']) > 0 && strlen($_POST['DIMMs']) > 1 && strlen($_POST['Zocalos_Libres']) > 0 && strlen($_POST['Laboratorio']) > 0) {
            $Pedidos = "INSERT INTO `pcs`(`Procesador`, `RAM`, `MotherBoard`, `Zocalos`, `HDD`, `Marca`, `Laboratorio`, `DIMMs`, `Zocalos_Libres`, `PS/2`, `Administrador`) VALUES ('$Procesador','$RAM','$MotherBoard','$Zocalos','$HDD','$Marca','$Laboratorio','$DIMMs','$Zocalos_Libres','$PS2','" . $_SESSION['Nombre'] . "')";
            $Resultado = mysqli_query($conex, $Pedidos);
            if ($Resultado) {
                echo "<script>otraPagina();</script>"; //mensaje de que se inscribio correctamente
            };
        }
    }
}
?>