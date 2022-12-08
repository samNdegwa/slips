<?php 
include 'core/init.php'; 
include 'functions/file-count.php'; 
$user=$_SESSION['myEmail'];
if(empty($user)=== true){
  ?>
  <script>
  document.location.href='../';
  </script>
  <?php
} else {
?>
<!DOCTYPE html>
<html>
  <?php include 'widgets/top-scripts.php';?>
<body class="hold-transition sidebar-mini sidebar-collapse layout-footer-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <?php include 'widgets/default-top-navigation.php'; ?>
  </nav>
  <!-- /.navbar -->
  <?php include 'widgets/side-bar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="all-main-contents">
    <!-- Content Header (Page header) -->
  <?php
   include 'widgets/main-body.php';
  ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include 'widgets/footer.php'; ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
</body>
</html>
<?php
} 
include 'widgets/bottom-script.php';
?>

<script>
  $(function(){
    $('#view-all-employee').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/view-employee-slip.php');
      //alert("Coming...")
    });

     $('#add-employee').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/register-employee.php');
    });

      $('#remove-employee').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      //$('#all-main-contents').load('widgets/unpaid-application.php');
      alert("Coming...")
    });

       $('#view-earnings').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/register-earning.php');
      //alert("Coming...")
    });

      $('#add-earnings').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/register-earning.php');
    });

    $('#add-deductions').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/register-deduction.php');
    });

     $('#generate-slip').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/view-employee-slip.php');
    });
      $('#earning_types').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/earning-types.php');
    });
      $('#deductions_types').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/deduction-types.php');
    });

      $('#all-employee').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/view-employee.php');
    });

      $('#view_generated_slips').click(function (){
      $('#all-main-contents').html('<i class="fa fa-spinner fa-spin"></i> Opening ...');
      $('#all-main-contents').load('widgets/view-generated-slips.php');
    });
   
   
    
});

</script>


