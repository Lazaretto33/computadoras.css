<?php
@session_start();
session_destroy();//destruye la sesion lo que provoca que vuelva al login
header("Location: ../Login/Login.php");
?>