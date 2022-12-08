<?php include '../core/init.php';?>
<div class="container-fluid">
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-users"></i> Manage Employee</h4>

                </div>
                <div class="card-body">
    <div class="row">
        <div class="col-sm-12">
        <div class="card">
  <div class="card-header">
    Available Employees
  </div>
  <div class="card-body">
   <table class="table table-bordered" id="all-payments-table">
    <?php
    $sql="SELECT * FROM  tb_employee ORDER BY id DESC";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th style="display:none;">id</th>
      <th>#</th>
      <th>Employee</th>
      <th>Phone</th>
      <th>Job Title</th>
      <th>Department </th>
      <th>Action</th>
    </thead>
    <tbody>
     <?php 
      $no=1;
      while($row=mysqli_fetch_array($result))
      { 
        $name=$row['full_name'];
        $phone=$row['phone_number'];
        $job=$row['job_title'];
        $department=$row['department'];

        ?>
         <tr>
           <td><?php echo $no;?></td>
           <td><?php echo $name;?></td>
           <td><?php echo $phone;?></td>
           <td><?php echo $job;?></td>
           <td><?php echo $department;?></td>
           <td>
           <button class="btn btn-outline-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
           <button class="btn btn-outline-danger btn-sm"><i class="fa fa-trash" aria-hidden="true"></i></button>
           </td>
         </tr>
        <?php
        $no++;
      }
      ?>
    </tbody>
      
    </table>

  </div>
</div>
        </div>

    </div>

</div>
</div>
</div>
</div>
</div>


