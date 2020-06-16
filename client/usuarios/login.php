
<?php
require_once( 'api.php');
include './header.php';
?>

<div class="testbox">

<?php

$mensaje_error = "";

// Si ya esta abierta la session redirecciona  a inicio.php
if (isset( $_SESSION['sesion_usr'])) {
    header( 'Location: inicio.php');
}

// Si se ingresa usuario y contraseña, conecta al servidor para validar y obtener token. 
if (isset($_POST['login'])) {
    if (!empty( $_POST['usuario']) && !empty( $_POST['pass'])) {
        // validar usuario y contraseña
        $data_array =  array(
            "usuario" => $_POST['usuario'],
            "password" => $_POST['pass']
        );
        $get_data = callAPI( 'POST','http://localhost:3000/login', json_encode( $data_array ));
        // if es valida guardar usuario y token
        $data = json_decode( $get_data, true);
        $error = $data['error'];
        $codigo = $data['codigo'];
        $mensaje = $data['mensaje'];
        if ($error) { // si hubo error muestra el mensaje de error
            $mensaje_error = $mensaje;
        }
        else { // si fue exitosa setea las variables locales sesion_usr y sesion_token y redirecciona a inicio.php
            $_SESSION['sesion_usr'] = $_POST['usuario'];
            $_SESSION['sesion_token'] = $mensaje;
            header( 'Location: inicio.php' );
        }
    }
    else {
        $mensaje_error = "Campos usuario y contraseña son requeridos";
    }
}
?>

<!-- Forumulario de login: ingreso de usuario y contraseña -->
<form action="./login.php" method="POST">
    <div>
        <h1 style="color: black">Login</h1> <br><br>
    </div>
    <?php
        echo '<p style="color: red">'. $mensaje_error . ' </p>';
    ?>
    <div class="item">
        <p>Usuario:</p>
        <div class="name-item">
            <input type="text" name="usuario" placeholder="ingrese nombre de usuario"/>
        </div>
      </div>
    <div class="item">
        <p>Contraseña:</p>
        <div class="name-item">
          <input type="password" name="pass" placeholder="ingrese su constraseña"/>
        </div>
    </div>
    <input type="hidden" name="login" value="login"/>';
    <div>
        <button id="btnIngresar">Ingresar</button>
     </div>
</form>

</div>

</body>

<?php
include './footer.html'; 
?>