<?php
//se inicia la sesion que sirve para guardar variables globales y utilizarlas para cerrar sesion y declarar una variable global
session_start();
?>
<html>

<head>
    <title>Iniciar Sesion</title>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    
    <form action="" method="post">
        <p>Email:<input type="text" name="email" value="<?php
                                                        //El if  Deja escrito en el contenido cuando se recarga la pagina 
                                                        if (isset($email)) echo "$email" ?>" /></p>

        <p>Contraseña<input type="password" name="contraseña" value="" /></p>
        <!--boton de Iniciar sesion-->
        <p><input type="submit" name="submitIn" value="Iniciar sesion" /></p>
        <!--boton de registrarse al hacer clic lo envia al registro-->
        <a href="../Registrarse/Registro.php"><input type="button" value="Registrarse"></a>
        <a href="../Login/Contraseña.php"><input type="button" value="Olvido su contraseña"></a>

    </form>
    <?php
    include("Login-server.php"); //Lo manda al proceso de logeo 
    ?>
</body>

</html>