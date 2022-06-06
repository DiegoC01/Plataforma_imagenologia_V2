<?php include_once 'conexion.php';
include_once 'conexion_matricula.php';
header("Content-Type: text/html;charset=utf-8");
ini_set("session.cookie_lifetime","7200");
ini_set("session.gc_maxlifetime","7200");
session_start();
if (empty($_SESSION['active'])) {
  header('location:login.php');
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Imagenología | <?php echo $title; ?></title>
   <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- fullCalendar -->
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.min.css">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/fullcalendar.print.min.css" media="print">
  <link rel="stylesheet" href="bower_components/fullcalendar/dist/locale/es.js">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
  <link rel="stylesheet" href="bower_components/alertify/alertify.css">
  <link rel="stylesheet" href="bower_components/alertify/default.min.css">
  <link rel="stylesheet" href="css/estrellas.css">
  <link rel="stylesheet" href="css/contraste.css">
  <link rel="stylesheet" href="bower_components/chart.js">
  <link rel="stylesheet" href="css/barra_lateral.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="bower_component/plugins/chartjs/Chart.min.js"></script>
  <!-- wysihtml5 parser rules -->
<script src="wysithml5/parser_rules/advanced.js"></script>
<!-- Library -->
<script src="wysithml5/dist/wysihtml5-0.3.0.min.js"></script>



</head>
<style type="text/css">

.purple-border textarea {
    border: 1px solid #ba68c8;
    font-size:25px;
}
.purple-border .form-control:focus {
    border: 2px solid #ba68c8;
    box-shadow: 0 0 0 0.2rem rgba(186, 104, 200, .25);
}

.green-border-focus .form-control:focus {
    border: 1px solid #8bc34a;
    box-shadow: 0 0 0 0.2rem rgba(139, 195, 74, .25);
}
</style>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

<header class="main-header">
  <!-- Logo -->
  <a href="index.php" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini">
      <b>
        <i class="fa fa-fw fa-hospital-o" style="margin-top: 20px;"></i>
      </b>
      </span>
      <!-- logo for regular state and mobile devices -->
      <p style="margin-top: 15px;">
        <span class="logo-lg" style='font: bold 90% monospace;'>
          <b><i class="fa fa-fw fa-hospital-o"></i>Imagenología
          </b>
        </span>
      </p>
  </a>


  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top">
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </a>



    <div class="navbar-custom-menu">

    </div>
  </nav>
</header>
<div class="social-bar">
    <a onclick="resizeText(1)" data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Aumentar tamaño Letra" class="icon llamada fa fa-plus-circle" style="font-size: 24px; color: white;"></a>
    <a onclick="resizeText(-1)" data-toggle="modal"  data-toggle="tooltip" data-placement="top" title="Disminuir tamaño Letra" class="icon editar fa  fa-minus-circle" style="font-size: 24px; color: white;"></a>
    <a data-toggle="modal" data-toggle="tooltip" data-placement="top" title="Contraste"  class="btnacc contrast icon repostular fa fa-adjust" style="font-size: 24px; color: white;"></a>
</div>
<script>
$(document).ready(function(){
  $('input').iCheck({
    checkboxClass: 'icheckbox_flat-green',
    radioClass: 'iradio_flat-green'
  });
});
</script>
<link href="skins/flat/green.css" rel="stylesheet">
<script src="icheck.js"></script>

<script>

        $(document).ready(function(){

            $(".contrast").click(function(){

                $("body").toggleClass("contraste");

            });

        });

        </script>
<script>

            function resizeText(multiplier) {

          if (document.body.style.fontSize == "") {

            document.body.style.fontSize = "1.0em";

          }

          document.body.style.fontSize = parseFloat(document.body.style.fontSize) + (multiplier * 0.1) + "em";

        }

        </script>

<script>

            function resizeInput(multiplier) {

          if (document.input.style.fontSize == "") {

            document.input.style.fontSize = "1.0em";

          }

          document.input.style.fontSize = parseFloat(document.input.style.fontSize) + (multiplier * 0.1) + "em";

        }

        </script>
