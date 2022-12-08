 <?php include '../core/init.php';?>
 <div class="container-fluid">
<div class="row">
 <div class="col-sm-12">
 <div class="card">
  <div class="card-header">
    All Generated Slips
    <input type="text" name="search_name" placeholder="Enter Name to Search" onkeyup="searchNameFunction()" id="search_name" style="min-width:250px;">

     <input type="text" name="search_month" placeholder="Enter Month to Search" onkeyup="searchMonthFunction()" id="search_month" style="min-width:250px;">
  </div>
  <div class="card-body">
   <table class="table table-bordered" id="all-slips">
    <?php
    $sql="SELECT * FROM  tb_employee INNER JOIN tb_payement_slips ON tb_payement_slips.emp_id = tb_employee.id ORDER BY tb_payement_slips.id DESC";
    $result=mysqli_query($con,$sql) or die(mysql_error());
    ?>
    <thead>
      <th>#</th>
      <th>Employee</th>
      <th>ID Number</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Month</th>
      <th>View</th>
    </thead>
    <tbody>
     <?php 
      $no=1;
      while($row=mysqli_fetch_array($result))
      { 

        $name=$row['full_name'];
        $phone=$row['phone_number'];
        $email=$row['email'];
        $national_id=$row['national_id'];
        $mont=$row['pay_month'];
        $slip=$row['file_name'];

        //Generate month.
        $yr = substr($mont, 0,4);
        $mn = substr($mont,4,2);

        if ($mn==='01'){ $mn='January'; }if ($mn==='02'){ $mn='Februry'; }if ($mn==='03'){ $mn='March'; }if ($mn==='04'){ $mn='April'; }
        if ($mn==='05'){ $mn='May'; }if ($mn==='06'){ $mn='June'; }if ($mn==='07'){ $mn='July'; }if ($mn==='08'){ $mn='August'; }
        if ($mn==='09'){ $mn='September'; }if ($mn==='10'){ $mn='October'; }if ($mn==='11'){ $mn='November'; }if ($mn==='12'){ $mn='December'; }

        ?>
         <tr>
           <td><?php echo $no;?></td>
           <td><?php echo $name;?></td>
            <td><?php echo $national_id;?></td>
           <td><?php echo $phone;?></td>
           <td><?php echo $email;?></td>
           <td><?php echo $mn.', '.$yr;?></td>
           <td> <a target="blank" href="./functions/doc/<?php echo $slip;?>"> <button class="btn btn-outline-info btn-sm"><i class="fa fa-eye"></i></button></a></td>
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


<script>
 function searchNameFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("search_name");
        filter = input.value.toUpperCase();
        table = document.getElementById("all-slips");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[1];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";

            } else {
              tr[i].style.display = "none";

            }
          }
        }
      }

       function searchMonthFunction() {
        // Declare variables
        var input, filter, table, tr, td, i;
        input = document.getElementById("search_month");
        filter = input.value.toUpperCase();
        table = document.getElementById("all-slips");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
          td = tr[i].getElementsByTagName("td")[5];
          if (td) {
            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
              tr[i].style.display = "";

            } else {
              tr[i].style.display = "none";

            }
          }
        }
      }
    
</script>
