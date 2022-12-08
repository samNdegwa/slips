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
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-plus"></i> Register Employee</h4>

                </div>
                <div class="card-body">
                <form method="POST" id="form-save-single-employee">
                <div class="card-body">
                  <div class="form-group">
                    <input type="text" class="form-control" id="emp-name" placeholder="Employee Name" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-id" placeholder="Employee ID Number" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-phone" placeholder="Employee Phone Number" required="">
                  </div>
                   <div class="form-group">
                    <input type="email" class="form-control" id="emp-email" placeholder="Employee Email" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-kra" placeholder="Employee KRA Pin" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-job" placeholder="Employee Job Title" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-department" placeholder="Employee Department" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-pfno" placeholder="Employee PF No." required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-grade" placeholder="Employee Paygrade" required="">
                  </div>
                   <div class="form-group">
                    <input type="text" class="form-control" id="emp-bank" placeholder="Employee Bank name" required="">
                  </div>
                 
                    </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="float:right;" id="btn-save-employeee"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
                </div>
              </form>
                  
                </div>

            </div>

        </div>
        <div class="col-sm-6">
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
<script>
 $(document).ready(function(){
      $('#form-save-single-employee').submit(function(e){
        e.preventDefault();
        sendSaveEmployee();
      });
     });
 function sendSaveEmployee() {
          var name = $('#emp-name').val();
          var empid = $('#emp-id').val();
          var email = $('#emp-email').val();

          var phone = $('#emp-phone').val();
          var kra = $('#emp-kra').val();
          var job = $('#emp-job').val();

          var department = $('#emp-department').val();
          var pfno = $('#emp-pfno').val();
          var grade = $('#emp-grade').val();
          var bank = $('#emp-bank').val();


          var json = JSON.stringify([name,empid,email,phone,kra,job,department,pfno,grade,bank]);

          $('#form-send-single-message button').html('<i class="fa fa-pulse fa-refresh"></i> Loading...');
          $.post('functions/save-employee.php',
          {
            data:json
          },function(data,status){
             if (data.replace(/\s/g, "") === 'exist') {
              Toastify({ 
                    text: "Error!\n Namtional ID number "+empid+" already registered with a different employee",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
             } else {
             if (data.replace(/\s/g, "") === 'success') {
               $('#all-main-contents').load('widgets/register-employee.php');
                  Toastify({ 
                    text: "Success!\n "+name+" save successifully as an Employee",
                    duration: 2000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #00b09b, #96c93d)",
                     }
                }).showToast();

                   } else {
                     Toastify({ 
                    text: "Error!\n Unable to save data. Check your internet connection",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
                   }
                 }
                
          }
          );

        }
  
</script>


