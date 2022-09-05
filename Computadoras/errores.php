<?php // -------- Variables de login ------
if (isset($_POST['submitIn'])) { 
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['contraseña']);
}
if (isset($_POST['submitIn'])) {
    if (empty($email)) { //empty==si esta vacio
        $_SESSION['emailINCO'] = "Ingrese su email";
    }
    if (empty($contraseña)) {
        $_SESSION['ContraseñaINC']= "Ingrese contraseña"; // $_SESSION['ContraseñaINC']
    }
    
}
    
    // ----------Variables de registro --------
    if (isset($_POST['submitUp'])) { //toma los datos del formulario registro y lo almaceno en variables
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $contraseña = trim($_POST['contraseña']);
        $contraseña2 = trim($_POST['contraseña2']);
    }
    //toma los datos del formulario registro para subirlo a la base de datos y tirar los mensajes de error
    if (isset($_POST['submitUp'])) {
        if (empty($name)) { //empty = si esta vacio
            $_SESSION['usuario_error']= "Ingrese nombre de usuario"; // $_SESSION['ContraseñaINC']
        }
        if (empty($email)) {
            $_SESSION['EmailError']= "Ingrese su email";
        }
        if (empty($contraseña)) {
            $_SESSION['ContraseñaError2']= " Ingrese la contreña";
        }
        if ($contraseña != $contraseña2) { //compara las contraseñas 
            $_SESSION['VerificacionError2']= "Las constrañas no son iguales";
        }}
 
    // Error ---- Pagina 