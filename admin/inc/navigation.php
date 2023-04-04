<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url ?>admin" class="brand-link bg-gradient-navy text-sm">
        <img src="<?php echo validate_image($_settings->info('logo'))?>" alt="Store Logo" class="brand-image img-circle elevation-3" style="opacity: .8;width: 1.5rem;height: 1.5rem;max-height: unset">
        <span class="brand-text font-weight-light"><?php echo $_settings->info('short_name') ?></span>
        </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
    
          <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            
                    <?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?>
          </a>
          
        </div>
      </div>

      <!-- SidebarSearch Form -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item dropdown">
                      <a href="./" class="nav-link nav-home">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li>
            <?php if($_settings->userdata('type') == 1 ): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/salesTrends" class="nav-link nav-reports_salesTrends">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Sales Trends
                        </p>
                      </a>
                    </li>
              <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/daily_sales_report" class="nav-link nav-reports_daily_sales_report">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Today Sales
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/daily_service_report" class="nav-link nav-reports_daily_service_report">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Today Services
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/prodwise" class="nav-link nav-reports_prodwise">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Sales Report (Product-Wise)
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/daywise" class="nav-link nav-reports_daywise">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Daily Sales Report (Daily-Wise)
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/user" class="nav-link nav-reports_user">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          User Sales Report
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/user_daily" class="nav-link nav-reports_user_daily">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          User Daily Sales Report
                        </p>
                      </a>
                    </li>
                     <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/single_prod_sales_report" class="nav-link nav-reports_single_prod_sales_report">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Single Product Sales Report
                        </p>
                      </a>
                    </li> 
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=reports/single_prod_purchase_report" class="nav-link nav-reports_single_prod_purchase_report">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Single Product Purchase Report
                        </p>
                      </a>
                    </li> 
                  </ul>

                </li>
              <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
               Maintenance
                <i class="fas fa-angle-left right"></i>
                
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="backup/backup.php" class="nav-link nav-products" >
                  <i class="far fa-check nav-icon"></i>
                  <p>Backup</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=products" class="nav-link nav-products" >
                  <i class="far fa-check nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
              
              
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=services" class="nav-link nav-services">
                  <i class="far fa-check nav-icon"></i>
                  <p>Service List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=categories" class="nav-link nav-cartegories">
                  <i class="far fa-check nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=suppliers" class="nav-link nav-suppliers">
                  <i class="far fa-check nav-icon"></i>
                  <p>Suppliers</p>
                </a>
              </li>
              
              
               <?php if($_settings->userdata('type') == 1): ?>

              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=user/list" class="nav-link nav-user/list">
                  <i class="far fa-check nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
              <?php if($_settings->userdata('id') == 1): ?>
              <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=system_info" class="nav-link nav-system_info">
                        <i class="nav-icon fas "></i>
                        <p>
                          System Info
                        </p>
                      </a>
                    </li>
                    <?php endif; ?>
                    <?php endif; ?>
            </ul>
          </li>
          <?php if($_settings->userdata('type') == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Inventory
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=inventory/inventory" class="nav-link nav-inventory_inventory">
                  <i class="fas fa-check nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              
            </ul>
          </li>
            </li>
            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Audit Logs
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=logs" class="nav-link nav-logs">
                  <i class="fas fa-check nav-icon"></i>
                  <p>View</p>
                </a>
              </li>
              
            </ul>
          </li>
            </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Transactions
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=transactions" class="nav-link nav-transactions">
                  <i class="fas fa-check nav-icon"></i>
                  <p>Transactions List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=cart/manage_cart" class="nav-link nav-transactions_manage_cart">
                  <i class="fas fa-check nav-icon"></i>
                  <p>New</p>
                </a>
              </li>
            </ul>
          </li>
           <?php if($_settings->userdata('type') == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Stock-in
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item dropdown">
                      <a href="<?php echo base_url ?>admin/?page=inventory/stockin_list" class="nav-link nav-inventory_stockin_list">
                        <i class="nav-icon far fa-check"></i>
                        <p>
                          Stockin-List
                        </p>
                      </a>
                    </li>
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=inventory" class="nav-link nav-inventory">
                  <i class="far fa-check nav-icon"></i>
                  <p>New</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-folder"></i>
              <p>
                Expenses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo base_url ?>admin/?page=expenses" class="nav-link nav-expenses">
                  <i class="fas fa-check nav-icon"></i>
                  <p>Expenses List</p>
                </a>
              </li>
              
            </ul>
          </li>
            </li>
        
         
          <li class="nav-header">NOTICEFICATIONS</li>
          <li class="nav-item">
            <a href="./?page=products/reorderlist" class="nav-link">
              <i class="nav-icon far fa-check text-warning"></i>
              <p>
                Reorder
                <span class="badge badge-danger right">
                  <?php 
                    $total = $conn->query("SELECT * FROM product where prod_qty<=reorder")->num_rows;
                    echo $total;
                  ?>
                  <?php ?>
                </span>
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="<?php echo base_url ?>admin/?page=products/to_expired_product_list" class="nav-link">
              <i class="nav-icon far fa-check text-warning"></i>
              <p>
                
                Pre-Expire
                <span class="badge badge-danger right">
                <?php 
                $date = date("Y-m-d");
                      $today=date("Y-m-d",strtotime($date));
                    $total = $conn->query("SELECT * FROM product where date(exdate2) <=$today ")->num_rows;
                    echo $total;
                  ?>
                  <?php ?>
                </span>
              </p>
            </a>
          </li>
          </li>
          <li class="nav-item">
            <a href="<?php echo base_url ?>admin/?page=products/expired_product_list" class="nav-link">
              <i class="nav-icon far fa-check text-danger"></i>
              <p>
                Post-Expire
                <span class="badge badge-danger right">

                <?php 
                  $date = date("Y-m-d");
                      $today=date("Y-m-d",strtotime($date));
                    $total = $conn->query("SELECT * FROM product where date(exdate) <=$today")->num_rows;
                    echo $total;
                  ?>
                  <?php ?>
                </span>
              </p>
            </a>
          </li>
      
          </li>
         
        
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
  <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.replace(/\//g,'_');
      console.log(page)

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
      $('.nav-link.active').addClass('active')
    })
  </script>