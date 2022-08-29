<?php
include("../Union-Server.php"); //incluye la union al servidor de mysql

if (isset($_POST['submitUp'])) { //toma los datos del formulario registro y lo almaceno en variables
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
    $contraseña2 = trim($_POST['contraseña2']);
}
//toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error
if (isset($_POST['submitUp'])) {
    if (empty($name)) { //empty = si esta vacio
        echo "<p class='error'>* Agregue su Nombre</p>"; //mensaje de error si el nombre esta vacio
    }
    if (empty($email)) {
        echo "<p class='error'>* Agregue su Email</p>";
    }
    if (empty($contraseña)) {
        echo "<p class='error'>* Ingrese una contraseña</p>";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { //error si el mail es incorrecto si esta mal escrito
        echo "<p class='error'>* Su correo es incorrecto</p>";
    } else {
        if ($contraseña != $contraseña2) { //compara las contraseñas 
            echo "<p class='error'>* Confirme su contraseña</p>";
        } else {
            if (strlen($_POST['name']) > 1 && strlen($_POST['email']) > 1 && strlen($_POST['contraseña']) > 1) { //verifica que los campos no esten vacios
                ///////IMAGEN DE PERFIL/////
                $Nombre_Imagen = $_FILES['Imagen']['name']; //se obtiene el nombre de la imagen subida
                //Si la imagen esta vacia se coloca una de default
                if (empty($Nombre_Imagen)) {
                    //Guarda en resultado todos los mail que existan en la base de datos para compararlos y tirar error si ponen uno igual
                    $result = mysqli_query($conex, "SELECT * FROM `login-alumnos` WHERE Email='$email'");
                    if (mysqli_num_rows($result) > 0)  // Si es mayor a cero imprimimos que ya existe el usuario
                    {
                        echo "<p class='error'>Ya existe el Usuario</p>";
                    } else {
                        //sirve para guardar las imagenes en intrane
                        $Imagen_Default = './intranet/uploads/Logo2345456.png';
                        //Inserta todos los datos a la base de datos
                        $Pedido = "INSERT INTO `login-alumnos`(`Nombre`, `Email`, `Imagen`, `Contraseña`, `Confirmacion`) VALUES ('$name','$email','$Imagen_Default','$contraseña','$contraseña2')";
                        $Resultado = mysqli_query($conex, $Pedido);
                        if ($Resultado) { //verifica que los datos se envien a la base de datos
                            echo "<h>Te inscribiste a alumnos</h>";
                            header("location: ../Login/Login.php"); //lo envia al login
                        } else {
                            echo "<h2>Ocurrio un error</h2>"; //susede raramente este mensaje
                        }
                    }
                } else {
                    //En caso de que el usuario elija una imagen
                    $Nombre_Imagen = time() . $_FILES['Imagen']['name'];
                    // $Tipo_Imagen=$_FILES['Imagen'] ['type']; //se puede obtener el tipo de imagen
                    //$Tamaño_Imagen=$_FILES['Imagen'] ['size'];//se puede obtener el tamaño original de la imagen
                    $Carpeta_Destino = '../intranet/uploads/'; //sirve para guardar las imagenes en intranet
                    //mueve la imagen subida a intranet
                    move_uploaded_file($_FILES['Imagen']['tmp_name'], $Carpeta_Destino . $Nombre_Imagen);
                    ///////CONEXION/////////////
                    $result = mysqli_query($conex, "SELECT * FROM `login-alumnos` WHERE Email='$email'");
                    if (mysqli_num_rows($result) > 0) {
                        echo "<p class='error'>Ya existe el Usuario</p>";
                    } else {
                        $Pedido = "INSERT INTO `login-alumnos`(`Nombre`, `Email`, `Imagen`, `Contraseña`, `Confirmacion`) VALUES ('$name','$email','./intranet/uploads/$Nombre_Imagen','$contraseña','$contraseña2')"; //Inserta todos los datos a la base de datos
                        $Resultado = mysqli_query($conex, $Pedido);
                        if ($Resultado) { //verifica que los datos se envien a la base de datos
                            echo "<h>Te inscribiste a alumnos</h>";
                            header("location: ../Login/Login.php"); //lo envia al login
                        } else {
                            echo "<h2>Ocurrio un error</h2>"; //susede raramente este mensaje
                        }
                    }
                }
            }
        }
    }
}
