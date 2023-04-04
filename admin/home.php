<h1>Welcome, <?php echo $_settings->userdata('firstname')." ".$_settings->userdata('lastname'); 
$user=$_settings->userdata('id');
$date = date("Y-m-d H:i:s");
  $today=date("Y/m/d",strtotime($date));
 

$sql1 = $conn->query("SELECT SUM(amount) as cashtotal FROM transaction_list where date(date_created)='$today'");

$row = $sql1->fetch_assoc();
$cashtotal = $row['cashtotal'];
?>!</h1>
<hr>
<div class="row">
          
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Today's Sales</h4>

                <p>GHc <?php echo number_format($cashtotal,2) ?> </p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="<?php echo base_url ?>admin/?page=cart/manage_cart" class="small-box-footer">Make Sales <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>My Transactions<sup style="font-size: 16px"></sup></h4>

                <p>Transaction List</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="<?php echo base_url ?>admin/?page=transactions/user_based" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>My Sales Report</h4>

                <p>Transactions Report</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="<?php echo base_url ?>admin/?page=reports/my_user_report" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h4>Product List</h4>

                <p>Click Below</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="<?php echo base_url ?>admin/?page=products" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
       
           
            


  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row">
          <section class="col-md-6 connectedSortable">
            <!-- TO DO List -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="ion ion-clipboard mr-1"></i>
                  To Do List
                </h3>

               
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                

          
    
    <hr style="border-top:1px dotted #ccc;"/>
    <div class="col-md-2"></div>
    <div class="col-md-8">
      <center>
        <form  id="todo-form" class="form-inline" >
          <input type="text" class="form-control" name="task" required/>
          <button  form="todo-form" class="btn btn-primary form-control" name="add" style="margin-left: 10px;">Add Task</button>
        </form>
      </center>
    </div>
    <br /><br /><br />
    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Task</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
          require 'todolist/conn.php';
          $query = $conn->query("SELECT * FROM `task` where user_id='$user' ORDER BY `task_id` ASC");
          $count = 1;
          while($fetch = $query->fetch_array()){
        ?>
        <tr>
          <td><?php echo $count++?></td>
          <td>
            <?php
            if($fetch['status']!= "Done"){
                  echo 
                  $fetch['task'];
                }
                else{
                  echo 
                  '<del>'.$fetch['task'].'</del>';
                  
                }
                ?>

          </td>
          <td><?php echo $fetch['status']?></td>
          <td colspan="2">
            
              <?php
                if($fetch['status'] != "Done"){
                  echo 
                  '<a href="javascript:void(0)" task_id="'.$fetch['task_id'].'" class="btn btn-success update-task"><span class="fas fa-check"></span></a> ';
                }
                else{
                   echo
                   '<a href="javascript:void(0)" task_id="'.$fetch['task_id'].'" class="btn btn-danger delete-task"><span class="fas fa-trash"></span></a>';
                }
              ?>
               
            
          </td>
        </tr>
        <?php
          }
        ?>
      </tbody>
    </table>
  
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </section>
           <section class="col-md-5 connectedSortable">
        
        
     <!-- Calendar -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">

                <h3 class="card-title">
                  <i class="far fa-calendar-alt"></i>
                  Calendar
                </h3>
                <!-- tools card -->
                <div class="card-tools">
                  <!-- button with a dropdown -->
                  <div class="btn-group">
                    
                    
                  </div>
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
                <!-- /. tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body pt-0">
                <!--The calendar -->
                <div id="calendar" style="width: 100%"></div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </section>
          
          
</div>
</div><!-- /.container-fluid -->
    </section>
    

  <script>
    
  $(document).ready(function(){
    $('#calendar').datetimepicker({
    format: 'L',
    inline: true
  })
    $('.connectedSortable').sortable({
    placeholder: 'sort-highlight',
    connectWith: '.connectedSortable',
    handle: '.card-header, .nav-tabs',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
  $('.connectedSortable .card-header').css('cursor', 'move')

  // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder: 'sort-highlight',
    handle: '.handle',
    forcePlaceholderSize: true,
    zIndex: 999999
  })
    
$('.update-task').click(function(e){
     
       var id= $(this).attr('task_id')
        console.log(id)
      start_loader();
      $.ajax({
        url:_base_url_+"classes/Master.php?f=update_todo",
        data: {id:id},
                cache: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
        error:err=>{
          console.log(err)
          alert_toast("An error occured",'error');
          end_loader();
        },
        success:function(resp){
          if(typeof resp =='object' && resp.status == 'success'){
            location.reload()
          }else if(resp.status == 'failed' && !!resp.msg){
                        
                   end_loader()
                    }else{
            alert_toast("An error occured",'error');
            end_loader();
                        console.log(resp)
          }
        }
      })
    })

    $('.delete-task').click(function(e){
     
       var id= $(this).attr('task_id')
        
      start_loader();
      $.ajax({
        url:_base_url_+"classes/Master.php?f=delete_todo",
        data: {id:id},
                cache: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
        error:err=>{
          console.log(err)
          alert_toast("An error occured",'error');
          end_loader();
        },
        success:function(resp){
          if(typeof resp =='object' && resp.status == 'success'){
            location.reload()
          }else if(resp.status == 'failed' && !!resp.msg){
                        
                   end_loader()
                    }else{
            alert_toast("An error occured",'error');
            end_loader();
                        console.log(resp)
          }
        }
      })
    })

  


    $('#todo-form').submit(function(e){
      e.preventDefault();
            var _this = $(this)
      
      start_loader();
      $.ajax({
        url:_base_url_+"classes/Master.php?f=save_todo",
        data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
        error:err=>{
          console.log(err)
          alert_toast("An error occured",'error');
          end_loader();
        },
        success:function(resp){
          if(typeof resp =='object' && resp.status == 'success'){
            location.reload()
          }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
            alert_toast("An error occured",'error');
            end_loader();
                        console.log(resp)
          }
        }
      })
    })

  })

  
  </script>