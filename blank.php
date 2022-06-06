<?php
  $title = "Inicio";
  include_once 'header.php';
  include_once 'aside.php';
    if (!($_SESSION['rol'] <= 5)) {
    echo " <script>window.open('index.php', '_self' )</script> ";
    }

    include_once 'funciones.php';
?>
  <div class="content-wrapper">
    <section class="content-header">
          <h1>
            <?php echo $title; ?>
            <small>it all starts here</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li><a href="#">Examples</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <!-- Default box -->
          <div class="box">

          </div>

        </section>
  </div>

<?php include_once 'footer.php'; ?>
