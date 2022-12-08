 <?php
 date_default_timezone_set('Africa/Nairobi');
 $now = new DateTime();
 $monthStamp=$now->format('mY');
 $expectedMonth=$now->format('m-Y');
 ?>
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
                <h3><?php echo $activeEmployee;?></h3>

              <p>Active Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-people"></i>
            </div>
            <a id="all-employee" class="small-box-footer">Open <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

         <div class="col-lg-3 col-6">
          <!-- small box -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h3><?php echo $earnings;?></h3>

                    <p>Earnings Type</p>
                </div>
                <div class="icon">
                    <i class="ion ion-cash"></i>
                </div>
                <a  id="earning_types"  class="small-box-footer">Open <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3><?php echo $deductions;?></h3>

              <p>Deduction Type</p>
            </div>
            <div class="icon">
              <i class="ion ion-android-remove-circle"></i>
            </div>
            <a id="deductions_types" class="small-box-footer" id="sent-sms">Open <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3><?php echo $inactiveEmployee;?></h3>

              <p>Inactive Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-trash-a"></i>
            </div>
            <a href="rejected_application" class="small-box-footer" id="open-failed-sms">Open <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid" >
      <div class="row">
        <div class="col-lg-6">
          <div class="card">
          <div class="card-header">
          <div class="d-flex justify-content-between">
            <h4 class="card-title">Graphical Analysis Coming...</h4>
            <a href="#">View Report</a>
            </div>
          </div>
            
              <div class="card-body">
                  <div id="pieChart" class="img-thumbnail" style="width: 100%; height:370px;"></div>
              </div>
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header border-0" style="background: #00b44e;color: whitesmoke;">
              <h3 class="card-title">More Analysis Here</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              Coming Soon...
            </div>
          </div>
          <!-- /.card -->
        </div>
        <div class="col-lg-6">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <h3 class="card-title">Payslips statistics</h3>
                <a href="javascript:void(0);">View Report</a>
              </div>
            </div>
            <div class="card-body" style="min-height:410px;">
             
             
              
            </div>
          </div>
          <!-- /.card -->

          <div class="card">
            <div class="card-header border-0" style="background: #7d1038;color: whitesmoke">
              <h3 class="card-title">Further Analysis</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">

            </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <!-- /.col (RIGHT) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  
