<?php include '../core/init.php';?>
<div class="container-fluid">
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-money"></i> Manage Employees Earnings</h4>

                </div>
      <div class="card-body" style="text-align:center;">
      <form method="POST" id="continue-earnings">
       <div class="form-group">
                   <label for="exampleInputEmail1">Select Employee To View/Adjust Earnings</label>
                   <select class="form-control select_control" id="employee_selected" required="">
                   <option value="" required="">----Select----</option>
                    <?php
                     $sq="SELECT * FROM tb_employee ORDER BY id DESC";
                     $res=mysqli_query($con,$sq) or die(mysql_error());
                     while($row=mysqli_fetch_array($res))
                       {  
                           echo "<option value='".$row['id']."'>".$row['full_name']."</option>";
                        }
                        ?>
                      </select>
                     <small id="emailHelp" class="form-text text-muted"></small>
                     </div>

                     <button class="btn btn-primary" >Continue</button>
    </form>

     </div>
</div>
</div>
</div>
</div>
<script>
$(document).ready(function(){
      $('#continue-earnings').submit(function(e){
        e.preventDefault();
        var empid = $('#employee_selected').val();

        var json = JSON.stringify([empid,earnType,amount]);

          $('#continue-earnings button').html('<i class="fa fa-pulse fa-refresh"></i> Loading...');
          $.post('functions/populate-employee-earnings.php',
          {
            data:json
          },function(data,status){

          }
      });

     
     });

 
</script>
