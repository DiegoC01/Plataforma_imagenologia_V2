<?php
  $title = "GESTIÓN DE USUARIOS";
  include_once 'header.php';
  include_once 'aside.php';
    if (!($_SESSION['id_role'] ==1)) {
    echo " <script>window.open('index.php', '_self' )</script> ";
    }
?>

</head>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
      <?php echo $title; ?>
      </h1>
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <!-- boton NUEVO USUARIO -->
            <a href="#newUsuario" data-toggle="modal" title="Agregar Nuevo Usuario">
                <button type='button' class='btn btn-info btn-xm'> Nuevo Usuario  <span class="glyphicon glyphicon-plus" aria-hidden="true" title="Nuevo Usuario"></span></button>
            </a>
            
            <h3 style="text-align:center">GESTIÓN DE USUARIOS DEL SISTEMA</h3>
            </div>
                          <!--Nuevo usuario LISTEILOR!!! -->
                    <div id="newUsuario" class="modal fade " role="dialog">
                      <form class="form-horizontal" role="form"  method="post">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Agregar Nuevo Usuario</h4>
                            <div class="modal-body">
                              <div class="col-md-12">
                              <div class="form-group col-md-8">
                                <div class="form-group">
                                  <label >Nombre Completo</label>
                                  <input type="name" class="form-control" id="nombre" name="nombre"  required=""  placeholder="Ingrese nombre del nuevo usuario" required>
                                </div>
                                <div class="form-group">
                                  <label for="rut">RUT sin puntos, guión, ni dígito verificador</label>
                                  <input type="rut" class="form-control" id="rut" name="rut"  required=""  placeholder="Ingrese RUT del nuevo usuario" required>
                                </div>
                                <div class="form-group">
                                  <label>Rol de Usuario</label>
                                  <select id="rol" name="rol" class="form-control">
                                    <option value="">Seleccione rol del nuevo usuario</option>
                                    <?php
                                    if($_SESSION['id_role']==1){
                                      $rol="SELECT id_role,nombre_role FROM roles";
                                    }else{
                                      $rol="SELECT id_role,nombre_role FROM roles WHERE id_role>1  ";
                                    }
                                    $result=mysqli_query($conectar,$rol);
                                    while ($fila=mysqli_fetch_array ($result)) {?>
                                      <option value="<?php echo$fila['id_role']; ?> "><?php echo $fila['nombre_role'];?> </option>";
                                      <?php }?>
                                    </select>
                                  </div>
                                <div class="form-group">
                                  <label for="correo">Correo Electrónico (nombre de usuario)</label>
                                  <input type="email" class="form-control" id="correo" name="correo"  required=""  placeholder="Ingrese correo del usuario" required>
                                </div>
                                <div class="form-group">
                                  <label for="rut">Contraseña</label>
                                  <input type="text" class="form-control" id="contrasena" name="contrasena"  required=""  placeholder="Ingrese contraseña" required>
                                </div>                          
                                
                                  <div class="form-group">
                                  <label>Especialidad del usuario</label>
                                  <select id="especialidad" name="especialidad" class="form-control">
                                    <option value="">Seleccione especialidad del usuario</option>
                                    <?php
                                    $especialidad = $_SESSION['especialidad'];
                                    if($_SESSION['id_role']==1)
                                    {
                                      $profesion="SELECT id_especialidad, nombre_especialidad FROM especialidades";  
                                    }
                                    else
                                    {
                                      $profesion="SELECT id_especialidad, nombre_especialidad FROM especialidades WHERE nombre_especialidad = '$especialidad'";
                                    }
                                    
                                    $result=mysqli_query($conectar,$profesion);
                                    while ($fila=mysqli_fetch_array ($result)) {?>
                                      <option value="<?php echo$fila['id_especialidad']; ?> "><?php echo $fila['nombre_especialidad'];?> </option>";
                                      <?php }?>
                                    </select>
                                  </div>   
                                  
                                  <div class="form-group">
                                  <label>Sede del usuario</label>
                                  <select id="sede" name="sede" class="form-control">
                                    <option value="">Seleccione la sede a la que pertenece el usuario</option>
                                    <?php
                                    if($_SESSION['id_role']==1){
                                      $sede="SELECT id_sede,nombre_sede FROM sedes";
                                    }else{
                                      $sede="SELECT id_sede,nombre_sede FROM sedes";
                                    }
                                    $result_sede=mysqli_query($conectar,$sede);
                                    while ($fila_sede=mysqli_fetch_array ($result_sede)) {?>
                                      <option value="<?php echo$fila_sede['id_sede']; ?> "><?php echo $fila_sede['nombre_sede'];?> </option>";
                                      <?php }?>
                                    </select>
                                  </div>
                                  
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" name="nuevo_usuario" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Agregar </button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Cancelar </button>
                              </div>
                            </div>
                            </div>
                            </div>
                          </div>
                      </form>
                    </div>



            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
            <?php   

                $direccion=$_SESSION['unidad'];
                if ($_SESSION['id_role'] ==1){ $query="SELECT DISTINCT rut_usuario,email,especialidad, nombre,nombre_role,unidad FROM login ";}else {
                  $query="SELECT DISTINCT rut_usuario,email, nombre,nombre_role,unidad FROM login where unidad='$direccion' AND id_role>=2";
                }
                $resultados = mysqli_query($conectar, $query);
            ?>
              <table class='table table-hover' id='example'> 
                <thead>
                  <tr>  
                    <th scope='col'>NOMBRE</th>   
                    <th scope='col'>CORREO</th>  
                    <th scope='col'>ESPECIALIDAD</th> 
                    <th scope='col'>ROL</th> 
                    <th scope='col'>ACCIONES</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  while($fila = mysqli_fetch_array($resultados)){
                    $idu=$fila['rut_usuario'];
                    $nombre=$fila['nombre'];
                    $correo=$fila['email'];
                ?>
                
                  <tr> 
                    <td scope='col'><?php echo $fila['nombre'];?></td>
                    <td scope='col'><?php echo $fila['email'];?></td>
                    <td scope='col'><?php echo $fila['especialidad'];?></td>
                    <td scope='col'><?php echo $fila['nombre_role'];?></td>
                    <td class="text-left col-m0op vert-align-center" style="">
                     <a href="#updateUsuario<?php echo $idu;?>" tittle="Modificar"  data-toggle="modal" class="btn btn-block btn-social btn-warning btn-sm"> 
                      <i class="fa fa-edit"> </i>
                      Modificar
                      </a>
                                          </td>
                  </tr>  
                  
              <!--Update Usuario-->
                    <div id="updateUsuario<?php echo $idu;?>" class="modal fade" role="dialog">
                      <form class="form-horizontal" role="form"  method="post">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <?php 
                                //$estado = "SELECT usuario.estado_usuario FROM usuario WHERE usuario.correo='".$correo."' AND usuario.rut_usuario=".$idu."  ";
                                //$resultadoestado = mysqli_query($conectar, $estado); 
                                //$filaestado=mysqli_fetch_array($resultadoestado);
                                ?>

                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4>Editar Usuario</h4>
                            
                            <div class="modal-body">
                              <div class="col-md-12">
                                <div class="form-group col-md-8">
                                  <input type="hidden" name="rut" class="form-control" value="<?php echo $idu;?>" readonly="readonly">
                                  <div class="form-group">
                                  <label>Nombre usuario</label>
                                  <input type="name" name="nombre" class="form-control" value="<?php echo $nombre;?>"  >
                                  </div>
                                  <div class="form-group">
                                  <label>Correo electrónico</label>
                                  <input type="email" name="correo" class="form-control" value="<?php echo $correo;?>"  >
                                  </div>
                                  <div class="form-group">
                                  <label>Rol del usuario</label>
                                    <select id="rol" name="rol" class="form-control">
                                      <option value="">Seleccione Rol de Usuario</option>
                                      <?php
                                    $rol="SELECT id_role, nombre_role FROM roles ";
                                    $result=mysqli_query($conectar,$rol);
                                    while ($fila=mysqli_fetch_array ($result)) {?>
                                        <option value="<?php echo$fila['id_role']; ?>" ><?php echo $fila['nombre_role'];?> </option>";
                                      <?php ;}?>
                                    </select>
                                  </div>
                                  <div class="form-group">
                                  <label>Estado del Usuario</label>
                                    <select id="estado" name="estado" class="form-control">
                                     <?php 
                                      if($filaestado['estado_usuario']==1)
                                      {
                                      ?>
                                        <option value="0">Inactivo</option>
                                        <option value="1">Activo</option>
                                      <?php 
                                      }
                                      else
                                      {
                                      ?>
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                        <?php 
                                      }
                                      ?> 
                                    </select>
                                  </div>
                                  <div class="form-group">
                                  <label>Ingresar nueva contraseña </label>
                                  <input type="password" name="pass" class="form-control" required >
                                  </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" name="update_registro" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Actualizar</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Salir</button>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                    <?php

              //NUEVO USUARIO
              if(isset($_POST['nuevo_usuario']))
                {
                  $rol = $_POST["rol"];
                  $correo = $_POST["correo"];
                  $rut = $_POST["rut"];
                  $nombre=$_POST["nombre"];
                  $contrasena=$_POST["contrasena"];
                  $especialidad=$_POST["especialidad"];
                  $sede=$_POST["sede"];

                  $query= "INSERT INTO usuarios(rut_usuario, nombre_usuario, email, foto_perfil, contraseña, estado, id_unidad, id_role, id_especialidad, id_sede) VALUES ('$rut','$nombre','$correo','img/foto_perfil/descarga.png',MD5('$contrasena'),1,1,'$rol','$especialidad','$sede')";
                  $resultados = mysqli_query($conectar, $query);
                  //echo $query;
                  if($resultados==1){
                      echo "<script type= 'text/javascript'>alert('Nuevo Usuario Agregado');</script>";  
                     echo '<script>window.location.href="usuarios.php"</script>';
                  }else{
                    echo "<script type= 'text/javascript'>alert('No se ha podido agregar usuario');</script>";
                    echo "Falló la obtención:".mysqli_error($conectar) ;

                  }
                  
                }
                
                if(isset($_POST['update_registro']))
                {
                  $rut = $_POST["rut"];
                  $nombre = $_POST["nombre"];
                  $correo = $_POST["correo"];
                  $rol = $_POST["rol"];
                  $estado = $_POST["estado"];
                  $pass = $_POST["pass"];
                  
                  $query_u= "UPDATE usuarios SET nombre_usuario = '$nombre', email ='$correo', id_role = '$rol', estado='$estado', contraseña = MD5('$pass') WHERE rut_usuario = '$rut'";
                  $resultados_u = mysqli_query($conectar, $query_u); 
                  if ($resultados_u == TRUE) 
                {
                  ?>
                      <script> swal({
                          title: "Bien hecho!",
                          text: "Datos modificados exitosamente",
                          type: "success"
                      }).then(function() {
                          window.location = "usuarios.php";
                      });</script>'
                 
                  <?php
                 }
                 else
                 {
                    ?>
                      <script> swal({
                              title: "Lo sentimos!",
                              text: "Datos no cambiados, intente nuevamente",
                              type: "error"
                          }).then(function() {
                              window.location = "usuarios.php";
                          });</script>'
                    <?php
                  }
                }
                
              ?>

                    
                    
                    
                    
                    <?php  } ?>
                </tbody>              
              </table>
          </div>
        </div>
      </div>

    </section>
  </div>


<script >
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>
<?php include_once 'footer.php'; ?>