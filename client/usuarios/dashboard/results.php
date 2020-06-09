
<?php 

  include './header.html'; 

?>
<div class="testbox">
    <?PHP
        echo '<form>';
        if ($_GET && isset( $_GET['listar'])) {
            echo '<div>
                     <h1 style="color: black">GET usuarios</h1><br><br>
                  </div>';

            $get_data = callAPI( 'GET','http://localhost:3000/usuarios', false );
        }
        else if ($_GET && isset( $_GET['id'])) {
            echo '<div>
                    <h1 style="color: black">GET usuario</h1><br><br>
                   </div>';
            $id = intval( $_GET['id'] );
            $get_data = callAPI( 'GET','http://localhost:3000/usuarios/'.$id, false );
        }
        else if($_POST && isset( $_POST['metodo'])) {
            $metodo = $_POST['metodo'];
            if ($metodo == 'post') {
               $data_array =  array(
                  "nombre" => $_POST['nombre'],
                  "apellido" => $_POST['apellido']
               );
               echo '<div>
                        <h1 style="color: black">POST usuario</h1><br><br>
                     </div>';
               $get_data = callAPI( 'POST','http://localhost:3000/usuarios', json_encode( $data_array ));
            }
            else if ($metodo == 'put') {
               $id = $_POST['id'];
               $data_array =  array(
                  "nombre" => $_POST['nombre'],
                  "apellido" => $_POST['apellido']
               );
               echo '<div>
                        <h1 style="color: black">PUT usuario</h1><br><br>
                     </div>';
               $get_data = callAPI( 'PUT','http://localhost:3000/usuarios/'.$id , json_encode( $data_array ));
            }
            else if ($metodo == 'del') {
               $id = $_POST['id'];
               echo '<div>
                        <h1 style="color: black">DELETE usuario</h1><br><br>
                     </div>';
               $get_data = callAPI( 'DEL','http://localhost:3000/usuarios/'.$id, false );
            }
        }

         $data = json_decode( $get_data, true);
         $error = $data['error'];
         $codigo = $data['codigo'];
         $mensaje = $data['mensaje'];
         echo '<div class="item">';
         echo '<p style="font-size: 20px">Respuesta servidor:</p><br>';
         echo '<div class="name-item" style="font-size: 18px">';

         if ($error) 
            echo '<span>Error codigo: ' . $codigo . '<br>' . $mensaje . '</span>';
         else { 
            $respuesta = $data['respuesta'];
            if ($mensaje === "listado") {
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
            else {
               echo '<span>' . $mensaje . '<br>';
               echo 'id: '.$respuesta['id'] .', nombre: ' . $respuesta['nombre'] . ', apellido: ' . $respuesta['apellido'] . '</span>';
            }
         }
            
         echo '</div></div>';
         echo '<div>
                  <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
               </div>';
       
         echo '</form>';

        function callAPI($method, $url, $data){
          $curl = curl_init();
          switch ($method){
             case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
             case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);		
                break;
             case "DEL":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                if ($data)
                   curl_setopt($curl, CURLOPT_POSTFIELDS, $data);	
                break;
             default:
                if ($data)
                   $url = sprintf("%s?%s", $url, http_build_query($data));
          }
          // OPTIONS:
          curl_setopt($curl, CURLOPT_URL, $url);
          curl_setopt($curl, CURLOPT_HTTPHEADER, array(
             'APIKEY: 111111111111111111111',
             'Content-Type: application/json',
          ));
          curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          // EXECUTE:
          $result = curl_exec($curl);
          if(!$result){die("Connection Failure");}
          curl_close($curl);
          return $result;
       }
      ?>
          
</div>
</body>

<?php include './footer.html'; ?>

 