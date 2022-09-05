<?php session_start();  //Se inicia la sesion que sirve para guardar variables globales 
$_SESSION['emailINCO'] = ''; // y utilizarlas para cerrar sesion y declarar una variable global
$_SESSION['ContraseñaINC'] = ''; // Declarar arriba por lo errores

?>

<html>

<head>
  <title>Iniciar Sesion</title>
  <html lang="es">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Estilos.css/loginRegistro.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>

<body>
  <!-- Inicia el formulario de Login/Registro -->
  <div class="divForm">
    <form class="formulario" action="" method="post">
      <h2 class="titulo_form"> Iniciar sesión </h2>
      <div class="contenedor">
        <div class="input_contenedor">
          <label for="">
            <!-- Input Email-->
            <i class="bi bi-person"></i>
            <input placeholder="Ingrese su email" type="text" name="email" value="<?php  //El if  Deja escrito en el contenido cuando se recarga la pagina 
                                                                                  if (isset($email)) echo "$email" ?>" />
          </label>
        </div>
        <div class="message_error"> <?php include("../errores.php");
                                    echo $_SESSION['emailINCO'];
                                    $_SESSION['emailINCO'] = ''; ?> </div>
        <!-- Input Email ------ / ------ Input Contraseña -->
        <div class="input_contenedor">
          <label for="">
            <i class="bi bi-lock"></i>
            <!--contraseña-->
            <input placeholder="Ingrese su contraseña" type="password" name="contraseña" value="" />
          </label>
        </div>
        <div class="message_error"> <?php include("../errores.php");
                                    echo $_SESSION['ContraseñaINC'];
                                    $_SESSION['ContraseñaINC'] = ''; ?> </div>

        <!--boton de Iniciar sesion-->
        <input class="button" type="submit" name="submitIn" value="Iniciar sesión" />
        <div><?php
              include("Login-server.php"); //Lo manda al proceso de logeo  
              ?> </div>
        <!--boton de registrarse al hacer clic lo envia al registro-->
        <div>
          <p class="pregunta">¿No tienes cuenta? <a class="form_link " href="../Registrarse/Registro.php">Registrarse</a></p>
        </div>
      </div>
    </form>
  </div>
</body>

</html>