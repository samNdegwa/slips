<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="./" class="brand-link">
      <img src="assets/dist/img/logo1.png"
           alt="Ekas"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="./" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                 Home
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-file-text" aria-hidden="true"></i>
              <p>
                Payment Slips
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="generate-slip" class="nav-link">
                  <i class="fa fa-eye-slash nav-icon"></i>
                  <p>Generate</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="view_generated_slips" class="nav-link">
                  <i class="fa fa-eye nav-icon"></i>
                  <p>View Generated Slips</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="adjust-slip" class="nav-link">
                  <i class="fa fa-th nav-icon"></i>
                  <p>Adjust</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="remove-slip" class="nav-link">
                  <i class="fa fa-ban  nav-icon"></i>
                  <p>Remove</p>
                </a>
              </li>
             
             
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-users" aria-hidden="true"></i>
              <p>
                Employees
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="view-all-employee" class="nav-link">
                  <i class="fa fa-eye-slash nav-icon"></i>
                  <p>View All</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="add-employee" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="remove-employee" class="nav-link">
                  <i class="fa fa-ban  nav-icon"></i>
                  <p>Remove</p>
                </a>
              </li>
             
             
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-money" aria-hidden="true"></i>
              <p>
                Earnings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="add-earnings" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add Earning</p>
                </a>
              </li>
               <li class="nav-item">
                <a id="view-earnings" class="nav-link">
                  <i class="fa fa-eye-slash nav-icon"></i>
                  <p>View/Edit</p>
                </a>
              </li>
            </ul>


           <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-ban"></i>
              <p>
                Deductions
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a id="add-deductions" class="nav-link">
                  <i class="fa fa-plus nav-icon"></i>
                  <p>Add Deduction</p>
                </a>
              </li>
              <li class="nav-item">
                <a id="view-deductions" class="nav-link">
                  <i class="nav-icon fa fa-eye"></i>
                  <p>View</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a id="adjust-deductions" class="nav-link">
                  <i class="fa fa-th nav-icon"></i>
                  <p>Adjust</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" id="settingss" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" id="logout" class="nav-link">
              <i class="nav-icon fas fa-power-off"></i>
              <p>
                Logout
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>