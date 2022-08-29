<html>

<head>
    <title>Registrarse</title>
    <link rel="stylesheet" href="../Style.css">
</head>

<body>
    <?php
    //toma los datos del formulario y lo almaceno en variables
    if (isset($_POST['submitUp'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $contraseña = trim($_POST['contraseña']);
        $contraseña2 = trim($_POST['contraseña2']);
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- Formulario de registro -->

        <p>Nombre:<input type="text" name="name" value="<?php
                                                        if (isset($name)) echo "$name" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Email:<input type="text" name="email" value="<?php
                                                        if (isset($email)) echo "$email" ?>" /></p>
        <p>Contraseña:<input type="password" name="contraseña" value="<?php
                                                                        if (isset($contraseña)) echo "$contraseña" ?>" /></p>
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina -->
        <p>Confirmar Contraseña:<input type="password" name="contraseña2" value="" /></p>
        <!-- espacio donde se sube la imagen-->
        <input type="file" name="Imagen" id="seleccionArchivos" accept="image/*">
        <br><br>
        <!-- previsualizar lo que el usuario selecciona -->
        <img id="imagenPrevisualizacion">
        <script src="../script.js"></script><!-- se une el script que hace que se muestre la imagen subida-->
        <p><input type="submit" name="submitUp" value="Registrarse" /></p>
    </form>
    <?php
    include("Register-server.php"); //Unir el codigo de server registro
    ?>
</body>