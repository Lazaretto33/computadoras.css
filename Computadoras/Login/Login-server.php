<?php
//incluye la union al servidor de mysql
include("../Union-Server.php");
//recuperar contraseña
if (isset($_POST['Recuperar_Contraseña'])) {
    $Email = trim($_POST['email']);
    $SQL = "SELECT * FROM `login-alumnos` WHERE Email = '" . $Email . "'";
    $Resultado = mysqli_query($conex, $SQL);
    $mostrar = mysqli_fetch_array($Resultado);
    if ($Email == $mostrar['Email']){
        
    }
}
//toma los datos del formulario de inicio de sesion y lo almaceno en variables
if (isset($_POST['submitIn'])) {
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
    $_SESSION['email'] = "$email";
}
//toma los datos del formulario para subirlo a la base de datos y tirar los mensajes de error
if (isset($_POST['submitIn'])) {
    if (empty($email)) { //empty==si esta vacio
       
    }
    if (empty($contraseña)) {
        
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //error si el mail es incorrecto si esta mal escrito
        
    } else {
        //verifica que los campos del formulario no esten vacios
        if (strlen($_POST['email']) > 1 && strlen($_POST['contraseña']) > 1) {
            //Se comparan los datos de sesion con los de la base de datos
            $Pedido = "select * from `login-alumnos` where email = '" . $_POST["email"] . "' and contraseña = '" . $_POST["contraseña"] . "'"; //Inserta todos los datos a la base de datos
            //Se hace la conexion
            $Resultado = mysqli_query($conex, $Pedido);
            //if para obtener variables globales
            if (($row = mysqli_fetch_array($Resultado))) {
                //usuariologuado
                $_SESSION["IDLogin"] = $row["IDLogin"];
                $_SESSION["Nombre"] = $row["Nombre"];
                $_SESSION["UserAdmin"] = $row["Administrador"];
                $_SESSION["Email"] = $row["Email"];
                $_SESSION["Imagen"] = $row["Imagen"];
                //if $_SESSION["UserAdmin"] != 1  no es administrador
                if ($Resultado) { //verifica que los datos se envien a la base de datos
                    echo "<h>Ingresaste correctamente</h>";
                    header("location: ../PaginaDeInicio.php"); //lo envia a la pagina de inicio
                } else {
                    echo "<h2>Ocurrio un error</h2>";
                }
            } else {
                echo "<p class='error'>*Datos Incorrectos</p>"; //susede raramente este mensaje
                //no hay usuario
            }
        }
    }
}
