<?php
include './header.html';
?>
 <div class="testbox">
        <?php
        if ($_GET && isset( $_GET['buscar'])) {
            echo '<form action="./results.php" method="GET">';
            echo '<div >
                    <h1 style="color: black">Buscar usuario</h1> <br><br>
                  </div>';
            echo '<div class="item">
                    <p>Id:</p>
                    <div class="name-item">
                        <input type="text" name="id" placeholder="ingrese id"/>
                    </div>
                  </div>';
            echo '<div>
                    <button id="btnBuscar">Buscar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else if($_GET && isset( $_GET['nuevo'])){
            echo '<form action="./results.php" method="POST">';
            echo '<div>
                    <h1 style="color: black">Crear usuario</h1><br><br>
                  </div>';
            echo '<div class="item">
                    <p>Nombre:</p>
                    <div class="name-item">
                        <input type="text" name="nombre" placeholder="ingrese nombre"/>
                    </div>
                  </div>';
            echo '<div class="item">
                    <p>Apellido:</p>
                    <div class="name-item">
                        <input type="text" name="apellido" placeholder="ingrese apellido" />
                    </div>
                  </div>';
            echo '<input type="hidden" name="metodo" value="post"/>';
            echo '<div>
                    <button id="btnGuardar">Guardar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else if($_GET && isset( $_GET['modificar'])){
            echo '<form action="./results.php" method="POST">';
            echo '<div>
                    <h1 style="color: black">Modificar datos de usuario</h1><br><br>
                  </div>';
            echo '<div class="item">
                    <p>Id:</p>
                    <div class="name-item">
                        <input type="text" name="id" placeholder="ingrese id"/>
                    </div>
                  </div>';
            echo '<div class="item">
                    <p>Nombre:</p>
                    <div class="name-item">
                        <input type="text" name="nombre" placeholder="ingrese nombre"/>
                    </div>
                  </div>';
            echo '<div class="item">
                    <p>Apellido:</p>
                    <div class="name-item">
                        <input type="text" name="apellido" placeholder="ingrese apellido" />
                    </div>
                  </div>';
            echo '<input type="hidden" name="metodo" value="put"/>';
            echo '<div>
                    <button id="btnGuardar">Actualizar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else if($_GET && isset( $_GET['eliminar'])){
            echo '<form action="./results.php" method="POST">';
            echo '<div >
                    <h1 style="color: black">Borrar usuario</h1> <br><br>
                  </div>';
            echo '<div class="item">
                    <p>Id:</p>
                    <div class="name-item">
                        <input type="text" name="id" placeholder="ingrese id"/>
                    </div>
                  </div>';
            echo '<input type="hidden" name="metodo" value="del"/>';
            echo '<div>
                    <button id="btnEliminar">Eliminar</button>
                    <button id="btnSalir" type="button" onclick="location.href=\'./inicio.php?menu\'">Salir</button>
                 </div>';
            echo '</form>';
        }
        else {
            echo '<form>';
            echo '<div>
                        <h4>Usuarios</h4>
                  </div>';
           echo' <ul>
                    <li><a href="/usuarios/dashboard/results.php?listar">Listar</a></li>
                    <li><a href="/usuarios/dashboard/inicio.php?nuevo">Crear</a></li>
                    <li><a href="/usuarios/dashboard/inicio.php?buscar">Buscar</a></li>
                    <li><a href="/usuarios/dashboard/inicio.php?modificar">Modificar</a></li>
                    <li><a href="/usuarios/dashboard/inicio.php?eliminar">Eliminar</a></li>
                </ul>';
            echo '</form>';
        }
        ?>
    </div>
</body>

<?php
include './footer.html'; 
?>