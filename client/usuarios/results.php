
<?php 
   require_once( 'api.php');
   include './header.php';
   // Si no existe una sesion abierta, se redirecciona a login.
   if (!isset( $_SESSION['sesion_usr'] )) {
      header( 'Location: login.php' );
  }  
?>

<div class="testbox">
    <?PHP
         $header = 'access-token:'. $_SESSION['sesion_token'];
         echo '<form>';
         if ($_GET && isset( $_GET['listar'])) { // Listar todos los usuarios
            echo '<div>
                     <h1 style="color: black">GET usuarios</h1><br><br>
                  </div>';

            $get_data = callAPI( 'GET','http://localhost:3000/usuarios', false, $header );
         }
         else if ($_GET && isset( $_GET['id'])) { // Buscar un usuario por id
            echo '<div>
                    <h1 style="color: black">GET usuario</h1><br><br>
                   </div>';
            $id = intval( $_GET['id'] );
            $get_data = callAPI( 'GET','http://localhost:3000/usuarios/'.$id, false, $header );
         }
         else if($_POST && isset( $_POST['metodo'])) {
            $metodo = $_POST['metodo'];
            if ($metodo == 'post') {   // Crear un nuevo usuario
               $data_array =  array(
                  "nombre" => $_POST['nombre'],
                  "apellido" => $_POST['apellido']
               );
               echo '<div>
                        <h1 style="color: black">POST usuario</h1><br><br>
                     </div>';
               $get_data = callAPI( 'POST','http://localhost:3000/usuarios', json_encode( $data_array ), $header);
            }
            else if ($metodo == 'put') { // Modificar datos de un usuario por id
               $id = $_POST['id'];
               $data_array =  array(
                  "nombre" => $_POST['nombre'],
                  "apellido" => $_POST['apellido']
               );
               echo '<div>
                        <h1 style="color: black">PUT usuario</h1><br><br>
                     </div>';
               $get_data = callAPI( 'PUT','http://localhost:3000/usuarios/'.$id , json_encode( $data_array ), $header);
            }
            else if ($metodo == 'del') { // Eliminar un usuario por id
               $id = $_POST['id'];
               echo '<div>
                        <h1 style="color: black">DELETE usuario</h1><br><br>
                     </div>';
               $get_data = callAPI( 'DEL','http://localhost:3000/usuarios/'.$id, false, $header );
            }
         }
         // Procesar el resultado.
         $data = json_decode( $get_data, true);
         $error = $data['error'];
         $codigo = $data['codigo'];
         $mensaje = $data['mensaje'];
         echo '<div class="item">';
         echo '<p style="font-size: 20px">Respuesta servidor:</p><br>';
         echo '<div class="name-item" style="font-size: 18px">';

         if ($error)  // Si fue error muestra solo el mensaje de error.
            echo '<span>Error codigo: ' . $codigo . '<br>' . $mensaje . '</span>';
         else {   // Si no fue error muesta la respuesta.
            $respuesta = $data['respuesta'];
            if ($mensaje === "listado") { // si es listado de usuario, los muestra en una tabla
               $cant = count( $respuesta );
               echo '<span>Usuarios (' . $cant . ')</span>';
               echo '<table style="width: 100%; border: 2px solid #2a5d84;">';
               echo    '<tr style="text-align: left;">';
               echo        '<th style="width: 10%;">Id</th>';
               echo        '<th style="width: 50%;">Nombre</th>';
               echo        '<th style="width: 40%;">Apellido</th>';
               echo    '</tr>';
            
               for ($i = 0; $i < $cant; $i++) {
                  echo "<tr>";
                  echo    '<td style="width: 10%; text-align: left; padding: 0.5em;">' . $respuesta[$i]['id'] . '</td>';
                  echo    '<td style="width: 50%; text-align: left; padding: 0.5em;">' . $respuesta[$i]['nombre'] . '</td>';
                  echo    '<td style="width: 40%; text-align: left; padding: 0.5em;">' . $respuesta[$i]['apellido'] . '</td>';
                  echo "</tr>";
               }
               echo '</table>';
            }
            else {  // sino, muestra mensaje respuesta.
               echo '<span>' . $mensaje . '<br>';
               echo 'id: '.$respuesta['id'] .', nombre: ' . $respuesta['nombre'] . ', apellido: ' . $respuesta['apellido'] . '</span>';
            }
         }   
         echo '</div></div>';
         echo '<div>
                  <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
               </div>';
         echo '</form>';
      ?>
          
</div>
</body>

<?php include './footer.html'; ?>

 