<?php
  $title = "Perfil";
  include_once 'header.php';
  include_once 'aside.php';
  include_once 'conexion.php';
?>

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
      <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-dashboard"></i> Inicio</a></li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="img/avatar.png" alt="User profile picture">

              <h3 class="profile-username text-center"><?php echo $_SESSION['nombre']." ".$_SESSION['apellido']; ?></h3>
              <h2 class="text-muted text-center">Imagenología</h2>
              <p class="text-muted text-center">Hospital Carlos Van Buren</p>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Información</h3>
              <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam quis...
              </p>
            </div>
            <!-- /.box-header -->

          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h2 class="box-title">Ajustes de Cuenta</h2>
            </div>
            <!-- MODIFICAR DATOS-->
            <a href="#datosPersonales" data-toggle="modal" title="Modificar Datos Personales">
                <button type='button' class='btn btn-info btn-xm'>Datos Personales <span class="glyphicon glyphicon-plus" aria-hidden="true" title="Modificar Datos Personales"></span></button>
            </a>
            <!-- MODIFICAR CONTRASEÑA-->
            <a href="#contraseña" data-toggle="modal" title="Modificar Contraseña">
                <button type='button' class='btn btn-warning btn-xm'>Contraseña <span class="glyphicon glyphicon-lock" aria-hidden="true" title="Modificar Contraseña"></span></button>
            </a>
            <!-- MODIFICAR FOTO PERFIL-->
            <a href="#foto_perfil" data-toggle="modal" title="Modificar Contraseña">
                <button type='button' class='btn btn-primary'>Foto Perfil <span class="glyphicon glyphicon-user" aria-hidden="true" title="Modificar Contraseña"></span></button>
            </a>

            <!--Subir repositorio -->
              <div id="foto_perfil" class="modal fade" role="dialog">
                  <form class="form-horizontal" role="form"  method="post" enctype="multipart/form-data" name="indicador">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4>Cambiar Foto Perfil</h4>

                                  <div class="modal-body">
                                      <div class="col-md-12">
                                          <div class="form-group">
                                              <?php
                                              $rut_usuario = $_SESSION['rut_usuario'];?>
                                              <input type="hidden" name="rut" class="form-control" id="rut" value="<?php echo $rut_usuario; ?>" readonly="readonly">
                                          </div>
                                          <div class="form-group">
                                              <label for="archivoAdjunto" >Archivo Adjunto</label>
                                              <input name="archivo[]" type="file" class="form-control"  required=""  placeholder="Eliga Archivo" >
                                          </div>
                                          <div class="modal-footer">
                                              <div class="row">
                                                  <button type="<?php echo $_SERVER["PHP_SELF"] ?>" name="agregar" class="btn btn-primary btn-block btn-flat">Agregar Foto Perfil</button>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>

              <!--Update datos personales -->
                    <div id="datosPersonales" class="modal fade" role="dialog">
                      <form class="form-horizontal" role="form" method="post">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4>MODIFICAR DATOS PERSONALES</h4>

                            <div class="modal-body">
                              <?php
                                  $query="SELECT u.rut_usuario FROM usuarios u  WHERE u.rut_usuario=".$_SESSION['rut_usuario']."  ";
                                  $info = mysqli_query($conectar, $query);
                                    while($fila = mysqli_fetch_array($info)){
                                      $rut=$fila['rut_usuario'];
                                    } ?>
                              <input type="hidden" name="rut" value="<?php echo $rut; ?>">
                              <div class="col-md-12">
                                <div class="form-group col-md-8">
                                  <label>Nombre Completo</label>
                                  <input type="name" name="nombre" id="nombre"class="form-control" value="<?php echo $_SESSION['nombre'];?>" >
                                  <label>Fecha Nacimiento</label>
                                  <input type="Date" name="fechanac" id="fechanac" class="form-control" value="<?php echo $_SESSION['fecha_nacimiento'];?>" >
                                  <label>Profesión</label>
                                  <input type="name" name="especialidad" class="form-control"  id="especialidad" value="<?php echo $_SESSION['especialidad'];?>" disabled="">
                                  <label>Correo</label>
                                  <input type="mail" name="correo" class="form-control" id="correo" value="<?php echo $_SESSION['email'];?>"disabled="">
                                  <label>Número Celular</label>
                                  <input type="tel" name="celular" class="form-control" id="celular" value="<?php echo $_SESSION['telefono'];?>">
                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" name="datos" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Modificar</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>Salir</button>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                              <?php
            if(isset($_POST['datos'])){
              $rutu=$_POST['rut'];
              $nombrec=$_POST['nombre'];
              $fechanac= $_POST['fechanac'];
              $telefono=$_POST['celular'];

              $query= "UPDATE usuarios SET nombre_usuario ='$nombrec', fecha_nacimiento = '$fechanac', telefono = '$telefono' WHERE rut_usuario = '$rutu';";
              echo $query;
              $resultados = mysqli_multi_query($conectar, $query);
              if($resultados==1){
                  echo "<script type= 'text/javascript'>alert('Datos personales modificados con exito, para ver los cambios por favor, abrir sesión nuevamente! :D');</script>";
                  echo '<script>window.location.href="salir.php"</script>';
              }else{
                echo "<script type= 'text/javascript'>alert('El procedimiento no se ha realizado por favor verifique sus datos ');</script>";
              }

            }
            ?>

                          <!--Update contraseña -->
                    <div id="contraseña" class="modal fade" role="dialog">
                      <form class="form-horizontal" role="form"  method="post">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4>MODIFICAR CONTRASEÑA</h4>

                            <div class="modal-body">
                              <?php
                                  $query="SELECT rut_usuario FROM usuarios WHERE rut_usuario=".$_SESSION['rut_usuario']."  ";
                                  $info = mysqli_query($conectar, $query);
                                    while($fila = mysqli_fetch_array($info)){
                                      $rut=$fila['rut_usuario'];
                                    } ?>
                              <input type="hidden" name="rut" value="<?php echo $rut; ?>">
                              <div class="col-md-12">
                                <div class="form-group col-md-8">
                                  <label>Contraseña</label>
                                  <input type="password" name="pass" id="pass"class="form-control" placeholder="Ingrese Nueva Contraseña" required >

                                </div>
                              </div>
                              <div class="modal-footer">
                                  <button type="submit" name="contraseña" class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Modificar</button>
                                  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span>Salir</button>
                              </div>
                            </div>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
            <?php
            //Para cambiar constraseña
            if(isset($_POST['contraseña'])){
              $rut_usuario=$_SESSION['rut_usuario'];
              $contra=$_POST['pass'];
              $query= "UPDATE usuarios SET contraseña = md5('$contra') WHERE rut_usuario = '$rut_usuario'; ";
              $resultados = mysqli_multi_query($conectar, $query);
              if($resultados==1){
                  echo "<script type= 'text/javascript'>alert('Contraseña Modificada se cerrara la sesion');</script>";
                  echo '<script>window.location.href="salir.php"</script>';
              }else{
                echo "<script type= 'text/javascript'>alert('Contraseña no modificada');</script>";
              }

            }
            ?>


            <div class="tab-content">
              <?php

                //Asignación las las variables sessión para mostrarlas dentro del cuerpo del perfil

                $rut=$_SESSION['rut_usuario'];
                $email=$_SESSION['email'];
                $nombre=$_SESSION['nombre'];
                /*$fecha_nacimiento=$_SESSION['fecha_nacimiento'];
                $especialidad=$_SESSION['especialidad'];
                $foto_perfil= $_SESSION['foto_perfil'];
                $telefono=$_SESSION['telefono'];
                $sede=$_SESSION['nombre_sede'];*/
              ?>
              <hr>
              <div class="box-body">
              <strong><i class="fa fa-calendar margin-r-5"></i> Fecha Nacimiento</strong>

              <p class="text-muted">
                Agregando...
              </p>

              <hr>

              <strong><i class="fa fa-envelope-o  margin-r-5"></i> Correo Personal</strong>

              <p class="text-muted"><?php echo $email;?></p>

              <hr>

              <strong><i class="fa fa-tablet margin-r-5"></i> Celular</strong>

              <p>
                +569999999
              </p>

              <hr>

            </div>


            </div>
            <!-- /.tab-content -->
          </div>



        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

  </div>

  <?php
      //subir repositorio hito
      if (isset($_POST['agregar'])) {
          # definimos la carpeta destino
          # falta crear consulta para rellenar los datos del usuario para crear una carpeta predeterminada para cada repositorio
          # $dirDestino="'".$Componente."'/'".$Subcomponente."'/'".$Hito."'/'".$Actividad."'/'".$rut."'/";
          $dirDestino = "img/foto_perfil/";

          # si hay algun archivo que subir
          if (isset($_FILES["archivo"]) && $_FILES["archivo"]["name"][0]) {
              # recorremos todos los arhivos que se han subido
              for ($i = 0; $i < count($_FILES["archivo"]["name"]); $i++) {

                  if (file_exists($dirDestino)) {
                      $origen = $_FILES["archivo"]["tmp_name"][$i];
                      $nombreoriginal = $_FILES["archivo"]["name"][$i];
                      $nuevonombre = str_replace(" ", "_", $nombreoriginal);
                      $destino = $dirDestino . $nuevonombre;

                      # movemos el archivo
                      if (move_uploaded_file($origen, $destino)) {
                          $subida_exitosa = TRUE;
                      } else {
                          $subida_exitosa = FALSE;
                      }
                  } else {

                      if (!mkdir($dirDestino, 0755, true)) {
                          die('Fallo al crear las carpetas...');
                      }
                      $origen = $_FILES["archivo"]["tmp_name"][$i];
                      $nombreoriginal = $_FILES["archivo"]["name"][$i];
                      # remplazamos cualquier espacio que alla por un guion bajo
                      $nuevonombre = str_replace(" ", "_", $nombreoriginal);
                      $destino = $dirDestino . $nuevonombre;

                      # movemos el archivo
                      if (move_uploaded_file($origen, $destino)) {
                          $subida_exitosa = TRUE;
                      } else {
                          $subida_exitosa = FALSE;
                      }
                  }
              }
          }
          $rutconsulta = $_SESSION['rut_usuario'];
          $consulta = "UPDATE usuarios SET foto_perfil = '$destino' WHERE rut_usuario = '$rutconsulta';";
          $f = mysqli_multi_query($conectar, $consulta);
          if ($f == 1 AND $subida_exitosa=TRUE) {
              echo "<script type= 'text/javascript'>alert('La Foto de Perfil se ha cambiado con exito!');</script>";
              echo '<script>window.location.href="salir.php"</script>';
          } else {
              echo "<script type= 'text/javascript'>alert('No se ha podido realizar la operación');</script>";
          }

      }
      ?>



<?php include_once 'footer.php'; ?>
