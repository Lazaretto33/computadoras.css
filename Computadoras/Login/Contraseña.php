<html>

<head>
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <form action="" method="post">
        <p>Ingrese su Email:<input type="text" name="email" value="<?php
                                                        //El if  Deja escrito en el contenido cuando se recarga la pagina 
                                                        if (isset($email)) echo "$email" ?>" /></p>

        <p><input type="submit" name="Recuperar_Contraseña" value="Recuperar Contraseña" /></p>
        <!--boton de registrarse al hacer clic lo envia al registro-->
    </form>
    <?php
    include("Login-server.php"); //Lo manda al proceso de logeo 
    ?>
</body>

</html>