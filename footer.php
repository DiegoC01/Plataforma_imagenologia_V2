<?php if (empty($_SESSION['active'])) {
  header('location:login.php');
} ?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0.0
    </div>
    <p align="center"><strong>Imagenología | Hospital Carlos Van Buren</strong></p>

    <!--Start of Tawk.to Script-->
<!-- <script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e541e9fa89cda5a1887b4aa/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script> -->
<!--End of Tawk.to Script-->
</footer>
</div>


<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- wysihtml5 parser rules -->
<script src="wysithml5/parser_rules/advanced.js"></script>
<!-- Library -->
<script src="wysithml5/dist/wysihtml5-0.3.0.min.js"></script>
<!-- fullCalendar -->
<script src="bower_components/moment/moment.js"></script>
<script src="bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
<script src="bower_components/fullcalendar/dist/locale/es.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.js" charset="utf-8"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js" charset="utf-8"></script>
<script src="bower_components/alertify/alertify.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2()
  });
</script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<script src="js/valida_rut.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('.select2').select2();
});
</script>
</body>
</html>
