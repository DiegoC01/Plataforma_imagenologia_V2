<head>
<?php
  $title = "Inicio";
  include_once 'header.php';
  include_once 'aside.php';
  include_once 'conexion.php';
?>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

   <script src="bower_component/plugins/chartjs/Chart.min.js"></script>

</body>
  <div class="content-wrapper">

        <!-- Main content -->
        <section class="content-header">
          <h3 align="center">
            SISTEMA IMAGENOLOGÍA
          </h3>
        </section>


        <section class="content">

          <!-- INICIO DEFINICIÓN DE ROLES  -->
          <?php
              $rut_usuario = $_SESSION['rut_usuario'];
              /*
                El rol del médico tendrá como código 1;
                El rol del tecnólogo tendrá como código 2;
                "Sin rol" tendrá como código -1.
              */
              $rol_usuario = -1;

              $query_rol_medico="SELECT COUNT(rut_medico) as comp_medico FROM medico_imagenologia WHERE rut_medico='$rut_usuario';";
              $conexion_rol_medico = mysqli_query($conectar, $query_rol_medico);
              while($fila_medico = mysqli_fetch_array($conexion_rol_medico)){
                $comp_medico=$fila_medico['comp_medico'];
              }

              $query_rol_tecnologo="SELECT COUNT(rut_tecnologo) as comp_tecnologo FROM tecnologo_medico WHERE rut_tecnologo='$rut_usuario';";
              $conexion_rol_tecnologo = mysqli_query($conectar, $query_rol_tecnologo);
              while($fila_tecnologo = mysqli_fetch_array($conexion_rol_tecnologo)){
                $comp_tecnologo=$fila_tecnologo['comp_tecnologo'];
              }

              if ($comp_medico == 1) {
                $rol_usuario = 1;
              }

              elseif ($comp_tecnologo == 1) {
                $rol_usuario = 2;
              }
          ?>
          <!-- FIN DEFINICIÓN DE ROLES -->


          <!-- Info boxes -->

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">Gráfico</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center">
                        <strong>Título gráfico</strong>

                      </p>
                    <div class="chart">
                      <canvas id="myChart" width="400" height="240"></canvas>
                    </div>
                    </div><!-- /.col -->
                    <div class="col-md-4">


             <!-- Query BD: cantidad exámenes, pacientes, doctores y tecnólogos -->
             <?php
              //Cantidad exámenes
              $query_cantidad_examenes = "SELECT count(id_examen) AS cantidad_examenes FROM examen;";
              $conexion_cantidad_examenes = mysqli_query( $conectar, $query_cantidad_examenes ) or die ("Error al conectarse a la base de datos.");
              while($fila = mysqli_fetch_array($conexion_cantidad_examenes)){
                $cantidad_examenes = $fila['cantidad_examenes'];
              }

              //Cantidad pacientes
              $query_cantidad_pacientes = "SELECT count(rut_paciente) AS cantidad_pacientes FROM paciente;";
              $conexion_cantidad_pacientes = mysqli_query( $conectar, $query_cantidad_pacientes ) or die ("Error al conectarse a la base de datos.");
              while($fila = mysqli_fetch_array($conexion_cantidad_pacientes)){
                $cantidad_pacientes = $fila['cantidad_pacientes'];
              }

              //Cantidad medicos
              $query_cantidad_medicos = "SELECT count(rut_medico) AS cantidad_medicos FROM medico_imagenologia;";
              $conexion_cantidad_medicos = mysqli_query( $conectar, $query_cantidad_medicos ) or die ("Error al conectarse a la base de datos.");
              while($fila = mysqli_fetch_array($conexion_cantidad_medicos)){
                $cantidad_medicos = $fila['cantidad_medicos'];
              }

              //Cantidad tecnólogos
              $query_cantidad_tecnologos = "SELECT count(rut_tecnologo) AS cantidad_tecnologos FROM tecnologo_medico;";
              $conexion_cantidad_tecnologos = mysqli_query( $conectar, $query_cantidad_tecnologos ) or die ("Error al conectarse a la base de datos.");
              while($fila = mysqli_fetch_array($conexion_cantidad_tecnologos)){
                $cantidad_tecnologos = $fila['cantidad_tecnologos'];
              }
             ?>
             <!-- Info Boxes Style 2 -->
              <div class="info-box bg-purple">
                <span class="info-box-icon"><i class="fa fa-fw fa-heartbeat" style="margin-top: 15px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Exámenes</span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Exámenes totales: <?php echo $cantidad_examenes; ?>
                   </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="fa fa-users" style="margin-top: 15px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Pacientes</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Total de pacientes: <?php echo $cantidad_pacientes; ?>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="fa fa-user-md" style="margin-top: 15px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Médicos </span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                    Total de médicos: <?php echo $cantidad_medicos; ?>
                  </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="fa fa-fw fa-h-square" style="margin-top: 15px;"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Tecnólogos</span>
                  <span class="info-box-number"></span>
                  <div class="progress">
                    <div class="progress-bar" style="width: 100%"></div>
                  </div>
                  <span class="progress-description">
                   Total de tecnólogos: <?php echo $cantidad_tecnologos; ?>
                    </span>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
                    </div><!-- /.col -->
                  </div><!-- /.row -->
                </div><!-- ./box-body -->
                <div class="box-footer">

                </div><!-- /.box-footer -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- VISTA ROL TECNÓLOGO  -->
          <?php
              if ($rol_usuario == 2) {
                ?>
                <!-- Fila del tecnólogo -->
                <div class="row">
                  <!-- Left col -->
                  <!-- Tabla de opciones -->
                  <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">Máquinas autorizadas a ocupar</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <table class='table table-hover' id='tabla_tecnologo'>
                          <thead>
                            <tr>
                              <th scope='col'>MARCA</th>
                              <th scope='col'>MODELO</th>
                              <th scope='col'>MANUAL</th>
                              <th scope='col'>USAR</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $query_uso_maquina = "SELECT id_maquina, id_manual, marca, modelo, rut_tecnologo, nombre, apellido from vista_uso_maquina WHERE rut_tecnologo='$rut_usuario';";
                            $conexion_uso_maquina = mysqli_query( $conectar, $query_uso_maquina ) or die ("Error al conectarse a la base de datos.");
                            while($fila = mysqli_fetch_array($conexion_uso_maquina)){
                              $id_maquina=$fila['id_maquina'];
                              $id_manual=$fila['id_manual'];
                              $marca_maquina=$fila['marca'];
                              $modelo_maquina=$fila['modelo'];
                              $rut_tecnologo=$fila['rut_tecnologo'];
                              $nombre_tecnologo=$fila['nombre'];
                              $apellido_tecnologo=$fila['apellido'];
                          ?>

                            <tr>
                              <td scope='col'><?php echo $marca_maquina;?></td>
                              <td scope='col'><?php echo $modelo_maquina;?></td>
                              <td class="text-left col-m0op vert-align-center" style="">
                                <a href="#ver_manual<?php echo $id_maquina; echo $id_manual;?>" tittle="Leer"  data-toggle="modal" class="btn btn-block btn-social btn btn-block btn-info">
                                <i class="glyphicon glyphicon-info-sign"> </i>
                                Leer
                                </a>
                              </td>
                              <td class="text-left col-m0op vert-align-center" style="">
                                <a href="#usar_maquina<?php echo $id_maquina; echo $rut_tecnologo;?>" tittle="Usar"  data-toggle="modal" class="btn btn-block btn-social btn btn-block btn-primary">
                                <i class="glyphicon glyphicon-ok-sign"> </i>
                                Usar
                                </a>
                              </td>
                            </tr>

                              <div id="usar_maquina<?php echo $id_maquina; echo $rut_tecnologo;?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                      <form method="post" enctype="multipart/form-data">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Usar máquina</h4>
                                              </div>
                                              <div class="modal-body">
                                                <input type="file" name="examen", id="examen" >
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="submit" name="guardar_examen" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Guardar exámen</button>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Salir</button>
                                              </div>
                                          </div>
                                      </form>
                                      <?php
                                        if (isset($_POST['guardar_examen'])) {
                                          $dir_examen = "examenes/";
                                          $examen_a_guardar = $dir_examen . basename($_FILES["examen"]["ex_prueba"]);

                                          if (move_uploaded_file($_FILES["examen"]["ex_prueba"], $examen_a_guardar)) {
                                            echo "The file ". basename( $_FILES["examen"]["ex_prueba"]). " has been uploaded.";
                                          } else {
                                            echo "Sorry, there was an error uploading your file.";
                                          }

                                          $imagen = basename( $_FILES["examen"]["ex_prueba"],".png");
                                          $query_guardar_examen =  "INSERT INTO examen (fecha_realización, rut_tecnologo, id_maquina, rut_medico, rut_paciente, imagen) VALUES ('2022-05-05', 11, 11111111, 3, 111, $imagen)";
                                          $conexion_guardar_examen = mysqli_query( $conectar, $query_guardar_examen ) or die ("Error al conectarse a la base de datos.");
                                        }
                                      ?>
                                    </div>
                                  </div>


                                  <div id="ver_manual<?php echo $id_maquina; echo $id_manual;?>" class="modal fade" role="dialog">
                                      <div class="modal-dialog">
                                          <form method="post">
                                              <?php
                                                $query_manual = "SELECT titulo_manual, manual FROM manual WHERE id_manual='$id_manual';";
                                                $conexion_manual = mysqli_query($conectar, $query_manual);
                                                while($fila = mysqli_fetch_array($conexion_manual)){
                                                  $titulo_manual = $fila['titulo_manual'];
                                                  $texto_manual = $fila['manual'];
                                                }
                                              ?>
                                              <!-- Modal content-->
                                              <div class="modal-content">
                                                  <div class="modal-header">
                                                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                      <h4 class="modal-title"><?php echo $titulo_manual; ?></h4>
                                                  </div>
                                                  <div class="modal-body">
                                                    <p>
                                                      <?php echo $texto_manual; ?>
                                                    </p>
                                                  </div>
                                                  <div class="modal-footer">
                                                      <button type="submit" name="guardar_examen" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Guardar exámen</button>
                                                      <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Salir</button>
                                                  </div>
                                              </div>
                                          </form>
                                        </div>
                                      </div>
                                <?php
                                }
                              ?>
                           </tbody>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->


                  <div class="col-md-4">
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">En construcción para el tecnólogo...</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div>
                          <h4>¿Qué se va a hacer aquí?</h4>
                          <p>- Se pretende hacer una seeción de preguntas y respuestas dependiendo del rol del usuario, es este caso, el tecnólogo.</p>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->


                </div>
                <!-- /.row -->
                <?php
              }
          ?>

          <!-- VISTA ROL MÉDICO  -->
          <?php
              if ($rol_usuario == 1) {
                ?>
                <!-- Fila del médico -->
                <div class="row">
                  <!-- Left col -->
                  <!-- Tabla de opciones -->
                  <div class="col-md-8">
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">Exámenes</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div><!-- /.box-header -->
                      <div class="box-body">
                        <table class='table table-hover' id='tabla_medico'>
                          <thead>
                            <tr>
                              <th scope='col'>FECHA EXÁMEN</th>
                              <th scope='col'>NOMBRE PACIENTE</th>
                              <th scope='col'>APELLIDO PACIENTE</th>
                              <th scope='col'>OPCIÓN</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $query_examen = "SELECT A.id_examen as id_examen,	A.fecha_realización as fecha_realizacion,	A.rut_tecnologo as rut_tecnologo,	A.id_maquina as id_maquina,	A.rut_medico as rut_medico,	A.rut_paciente as rut_paciente, B.nombre as nombre_paciente, B.apellido as apellido_paciente,	A.imagen as imagen from examen A, paciente B WHERE A.rut_paciente = B.rut_paciente and A.rut_medico='$rut_usuario';";
                            $conexion_examen = mysqli_query( $conectar, $query_examen ) or die ("Error al conectarse a la base de datos.");
                            while($fila = mysqli_fetch_array($conexion_examen)){
                              $id_examen=$fila['id_examen'];
                              $fecha_examen=$fila['fecha_realizacion'];
                              $rut_tecnologo=$fila['rut_tecnologo'];
                              $id_maquina=$fila['id_maquina'];
                              $rut_medico=$fila['rut_medico'];
                              $rut_paciente=$fila['rut_paciente'];
                              $nombre_paciente=$fila['nombre_paciente'];
                              $apellido_paciente=$fila['apellido_paciente'];
                              $imagen=$fila['imagen'];
                          ?>

                            <tr>
                              <td scope='col'><?php echo $fecha_examen;?></td>
                              <td scope='col'><?php echo $nombre_paciente;?></td>
                              <td scope='col'><?php echo $apellido_paciente;?></td>
                              <td class="text-left col-m0op vert-align-center" style="">
                                <a href="#ver_examen<?php echo $id_examen; echo $rut_paciente;?>" tittle="Ver"  data-toggle="modal" class="btn btn-block btn-social btn btn-block btn-primary">
                                <i class="glyphicon glyphicon-eye-open"> </i>
                                Ver
                                </a>
                              </td>
                            </tr>

                              <!---Eliminar reporte Modal!!-->
                              <div id="ver_examen<?php echo $id_examen; echo $rut_paciente;?>" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                      <form method="post">
                                          <!-- Modal content-->
                                          <div class="modal-content">
                                              <div class="modal-header">
                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                  <h4 class="modal-title">Ver exámen</h4>
                                              </div>
                                              <div class="modal-body">
                                                <p>
                                                  Aquí se implementará la opción de ver exámen.
                                                </p>
                                              </div>
                                              <div class="modal-footer">
                                                  <button type="submit" name="guardar_examen" class="btn btn-success"><span class="glyphicon glyphicon-save"></span> Recuperar</button>
                                                  <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove-circle"></span> Salir</button>
                                              </div>
                                          </div>
                                      </form>
                                  <?php
                                }
                              ?>
                            </div>
                           </tbody>
                        </table>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->


                  <div class="col-md-4">
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">En construcción para el médico...</h3>
                        <div class="box-tools pull-right">
                          <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div>
                          <h4>¿Qué se va a hacer aquí?</h4>
                          <p>- Se pretende hacer una seeción de preguntas y respuestas dependiendo del rol del usuario, es este caso, el médico.</p>
                        </div>
                      </div>
                      <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                  </div>
                  <!-- /.col -->


                </div>
                <!-- /.row -->
                <?php
              }
          ?>


        </section>
  </div>


<?php include_once 'footer.php'; ?>


<script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
<!-- Bootstrap 3.3.5 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- ChartJS 1.0.1 -->
<script src="plugins/chartjs/Chart.min.js"></script>
<!-- FastClick -->
<script src="plugins/fastclick/fastclick.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/app.min.js"></script>


<script>
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],
        datasets: [{
              label: "Atendidas",
              data: [4, 5, 9, 4, 13, 3, 6, 3, 9, 6, 12, 0],
              backgroundColor: [
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)',
                'rgba(54, 162, 235)'
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(54, 162, 235, 1)'
            ],
            borderWidth: 1
            },
            {
              label: "Asignadas",
              data: [24, 15, 27, 20, 19, 21, 22, 23, 15, 13, 11, 0],
              backgroundColor: [
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)',
                'rgba(153, 102, 255)'
            ],
            borderColor: [
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(153, 102, 255, 1)'
            ],
            borderWidth: 1
            }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script>
var ctx = document.getElementById('myChart2').getContext('2d');
var myChart2 = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132)',
                'rgba(54, 162, 235)',
                'rgba(255, 206, 86)',
                'rgba(75, 192, 192)',
                'rgba(153, 102, 255)',
                'rgba(255, 159, 64)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>

<script >
  $(document).ready(function() {
     $('#tabla_tecnologo').DataTable();
     $('#tabla_medico').DataTable();
} );
</script>
