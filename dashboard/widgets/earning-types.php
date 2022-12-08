<?php include '../core/init.php';?>
<div class="container-fluid">
<div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-money"></i> Manage Earning Types</h4>

                </div>
                <div class="card-body">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="nav-icon fa fa-th"></i> Availavble Earning Types</h4>

                </div>
                <div class="card-body">
                <table class="table table-bordered">
    <?php
    $sql="SELECT * FROM  earning_type";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th style="display:none;">id</th>
      <th>#</th>
      <th>Earning Type</th>
      <th>Action</th>
    </thead>
    <tbody>
     <?php 
      $no=1;
      while($row=mysqli_fetch_array($result))
      { 
        $type=$row['earning_name'];
        
        ?>
         <tr>
           <td><?php echo $no;?></td>
           <td><?php echo $type;?></td>
           <td><button class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></td>
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
        <div class="col-sm-6">
        <div class="card">
  <div class="card-header">
     <h6>Add A new Earning Type</h6>
  </div>
  <div class="card-body">
    <form id="earning-data-form">
        <div class="form-group">
        <label>Enter Earning Type</label>
        <input type="text" class="form-control" id="earning_type" placeholder="e.g House Allowance" required="">
        </div>

         <div class="card-footer">
                  <button type="submit" class="btn btn-primary" style="float:right;" id="btn-save-earning-type"><i class="fa fa-paper-plane" aria-hidden="true"></i> Save</button>
                </div>
    </form>
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
      $('#earning-data-form').submit(function(e){
        e.preventDefault();
        saveEarnings();
      });

     });

 function saveEarnings() {
    
          var earnType = $('#earning_type').val();
         
          var json = JSON.stringify([earnType]);

          $('#earning-data-form button').html('<i class="fa fa-pulse fa-refresh"></i> Loading...');
          $.post('functions/save-earnings-type.php',
          {
            data:json
          },function(data,status){
             if (data.replace(/\s/g, "") === 'exist') {
              Toastify({ 
                    text: "Error!\n "+earnType+" has already been added.",
                    duration: 6000,
                    className: "primary",
                   style: {
                       background: "linear-gradient(to right, #E64134, #96c93d)",
                     }
                }).showToast();
             } else {
             if (data.replace(/\s/g, "") === 'success') {
               $('#all-main-contents').load('widgets/earning-types.php');
                  Toastify({ 
                    text: "Success!\n "+earnType+" saved successifully",
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
