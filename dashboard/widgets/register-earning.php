<?php include '../core/init.php';?>
<div class="container-fluid">
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-money"></i> Manage Employee Earnings</h4>

                </div>
                <div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-plus"></i> Select Employee to Add/Edit Earnings for</h4>

                </div>
                <div class="card-body">
                <form method="POST" id="form-save-earnings">
                <div class="card-body">
                   <div class="form-group">
                   <label for="exampleInputEmail1">Select Employee</label>
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

                    <div class="form-group">
                   <label for="exampleInputEmail1">Select Earning Type</label>
                   <select class="form-control" id="earning_type" required="">
                   <option value="" required="">----Select----</option>
                    <?php
                     $sqll="SELECT * FROM earning_type";
                     $res=mysqli_query($con,$sqll) or die(mysql_error());
                     while($row=mysqli_fetch_array($res))
                       {  
                           echo "<option value='".$row['id']."'>".$row['earning_name']."</option>";
                        }
                        ?>
                      </select>
                     <small id="emailHelp" class="form-text text-muted"></small>
                     </div>
                      <div class="form-group">
                     <label>Amount (Ksh)</label>
                      <input type="number" class="form-control" id="amount_paid" placeholder="e.g 30000" required="">
                      </div>
                 
                    </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="float:right;" id="btn-save-earnings"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
                </div>
              </form>
                  
                </div>

            </div>

        </div>
        <div class="col-sm-6">
        <div class="card">
  <div class="card-header">
    
  </div>
  <div class="card-body">
   <div id="employee_aernings">
     <h6>Select Employee to see his/her earnings</h6>
   </div>
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
      $('#form-save-earnings').submit(function(e){
        e.preventDefault();
        sendSaveEarnings();
      });

      $(".select_control").change(function() {
        var selectedValue = this.value;

        var json = JSON.stringify([selectedValue]);
        $.post('functions/populate-employee-aernings-table.php',
          {
            data:json
          },function(data,status){
             //$('#customer_locations').val(data);
             document.getElementById("employee_aernings").innerHTML=data;
          }
          );

       
     }); 

      $('#button-edit-earning').submit(function(e){
        edit_earning();
      });
     });

 function edit_earning(btn){
  var tr = $(btn).parent().parent();
  var cid = $(tr).children('td:eq(0)').html();
  var amount = $(tr).children('td:eq(3)').html();
   
    var json = JSON.stringify([cid,amount]);

          $('#button-edit-earning').html('<i class="fa fa-pulse fa-refresh"></i>');
          $.post('functions/save-employee-earnings-edit.php',
          {
            data:json
          },function(data,status){
            $('#button-edit-earning').html('Save');
            Toastify({ 
                    text: "Success!\n Earning saved successifully\n Refresh the page to see the changes",
                    duration: 2000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #00b09b, #96c93d)",
                     }
                }).showToast();

          }
          );

 }

 function sendSaveEarnings() {
          var empid = $('#employee_selected').val();
          var earnType = $('#earning_type').val();
          var amount = $('#amount_paid').val();

          var json = JSON.stringify([empid,earnType,amount]);

          $('#form-send-single-message button').html('<i class="fa fa-pulse fa-refresh"></i> Loading...');
          $.post('functions/save-employee-earnings.php',
          {
            data:json
          },function(data,status){
             if (data.replace(/\s/g, "") === 'exist') {
              Toastify({ 
                    text: "Error!\n Earning has already been added for this employee.",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
             } else {
             if (data.replace(/\s/g, "") === 'success') {
                  Toastify({ 
                    text: "Success!\n Earning saved successifully as an Employee",
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


