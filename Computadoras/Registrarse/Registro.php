<html>
<head>
    <title>Registrarse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../Estilos.css/loginRegistro.css">    
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
    <?php    session_start();
    //Variables de error
    $_SESSION['usuario_error'] = "";
    $_SESSION['EmailError']= '';
    $_SESSION['ContraseñaError2']= "";
    $_SESSION['VerificacionError2']= "";
    //toma los datos del formulario y lo almaceno en variables 
       if (isset($_POST['submitUp'])) {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $contraseña = trim($_POST['contraseña']);
        $contraseña2 = trim($_POST['contraseña2']);
    }     ?>
    
    <div class="divform">  <form class="formulario" action="" method="post" enctype="multipart/form-data">
        <!-- Formulario de registro -->
        <h2 class="titulo_form">Crea tu cuenta</h2>
        


        <div class="contenedor">
            
        <div class="contenedor_fdp"> 
            <img class="fdp" id="imagenPrevisualizacion">  
             <!-- se une el script que hace que se muestre la imagen subida-->
        </div>


            <div class="input_contenedor"> 
        <label for="">  <i class="bi bi-person"></i>
        <input type="text" name="name"  placeholder="Nombre de usuario" value="<?php
                                                        if (isset($name)) echo "$name" ?>" />
        <!--El if  Deja escrito en el contenido cuando se recarga la pagina --> 
        </label> </div> <div class="message_error"> 
            <?php include("../errores.php"); echo $_SESSION['usuario_error']; $_SESSION['ContraseñaError']  = ""    ?> 
                        </div>
    <div class="input_contenedor"> 
        <label for=""> <i class="bi bi-envelope"></i> 
        <input  placeholder="Ingrese su email" type="text" name="email" value="<?php
                                                        if (isset($email)) echo "$email" ?>" />
        </label> </div>
        <div class="message_error" >  <?php include("../errores.php"); echo $_SESSION['EmailError']; $_SESSION['EmailError']  = ""    ?>  
            </div>

            <div class="input_contenedor">   <label> <i class="bi bi-lock"></i>                                              
        <input placeholder="Ingrese su contraña" type="password" name="contraseña" value="<?php 
                                                        if (isset($contraseña)) echo "$contraseña" ?>"/>
        </div> </label> <div class="message_error">
        <?php include("../errores.php"); echo $_SESSION['ContraseñaError2']; $_SESSION['ContraseñaError2']  = ""    ?>
            </div>

        <!--El if  DSeja escrito en el contenido cuando se recarga la pagina -->
        <div class="input_contenedor"> <label> <i class="bi bi-lock"></i>
        <input placeholder="Confirme su contraseña" type="password" name="contraseña2" value="" />
<!--  --> </label>  
</div> <div class="message_error" > 
<?php include("../errores.php"); echo $_SESSION['VerificacionError2']; $_SESSION['VerificacionError2']  = ""    ?>
</div>
        <!-- espacio donde se sube la imagen-->
        <div class="input_contenedor"> 
        <input placeholder="" type="file" name="Imagen" id="seleccionArchivos" accept="image/*">
        </div>
       <!-- previsualizar lo que el usuario selecciona -->

        <script src="../script.js"></script>
        
        <div > 
        <input class="button" type="submit" name="submitUp" value="Registrarse" />
        </div>
        <div>
        <p class="pregunta">¿Tienes cuenta? <a  class="form_link" href="../Login/Login.php" >Inicia sesión</a></p>
        </div>
        </div>
        </div>
 
    </form>
    </div>  <!-- Contenedor-->

</div> <!-- Form -->
    <?php
    include("Register-server.php"); //Unir el codigo de server registro
    ?>
</body>


        <!-- .myLabel {
    border: 2px solid #AAA;
    border-radius: 4px;
    padding: 2px 5px;
    margin: 2px;
    background: #DDD;
    display: inline-block;
}
.myLabel:hover {
    background: #CCC;
}
.myLabel:active {
    background: #CCF;
}
.myLabel :invalid + span {
    color: #A44;
}
.myLabel :valid + span {
    color: #4A4;
}
<label class="myLabel">
    <input type="file" required/>
    <span>My Label</span>
</label> 

        -->
