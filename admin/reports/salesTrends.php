<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 
$date = date("Y-m-d H:i:s");
  $today=date("Y/m/d",strtotime($date));
 

$sql1 = $conn->query("SELECT SUM(amount) as cashtotal FROM transaction_list where date(date_created)='$today'");

$row = $sql1->fetch_assoc();
$cashtotal = $row['cashtotal'];

      ?>
      <!-- Full Width Column -->
      <div class="container-fluid">
        <div class="container">
          
            <div class="row">

        <section class="content-header">
      <div class="container-fluid">
        <div class="row">
                Sales Overview

          <div class="col-sm-6">
          </div>
          
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="row">
         
          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Today sales Trends</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card">
                  <canvas id="salestrends" ></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             </div>
             </div>
        <div class="row">
         
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Last 7 Days Sales(Line Chart)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="box">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             </div>

        <div class="col-md-6">
            <!-- BAR CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Last 7 Days Sales(Bar Chart)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="box">
                  <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

</div>
</div>
         <div class="row">
          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Last 30 Days Sales</h3>
                
              </div>
              <div class="card">
                  <canvas id="last30days" style=" max-width: auto;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             </div>
           

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
        <div class="row">
          <div class="col-md-12">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">The Year Overview </h3>

                
              </div>
              <div class="box">
                  <canvas id="year" style=" max-width: auto;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
             </div>
            </div>

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      
    <!-- /.content -->
    


</div><!-- /.container-fluid -->
    </section>
 

            
        </div>
      </div><!-- /.content-wrapper -->
      
    </div><!-- ./wrapper -->


<noscript id="print-header">
    <div>
    <div class="d-flex w-100">
        <div class="col-2 text-center">
            <img style="height:.8in;width:.8in!important;object-fit:cover;object-position:center center" src="<?= validate_image($_settings->info('logo')) ?>" alt="" class="w-100 img-thumbnail rounded-circle">
        </div>
        <div class="col-8 text-center">
            <div style="line-height:1em">
                <h4 class="text-center mb-0"><?= $_settings->info('name') ?></h4>
                <h3 class="text-center mb-0"><b>Daily Sales Report</b></h3>
                <div class="text-center">as of</div>
                <h4 class="text-center mb-0"><b><?= date("F d, Y", strtotime($date)) ?></b></h4>
            </div>
        </div>
    </div>
    <hr>
    </div>
</noscript>
<script>
    //
    $(document).ready(function(){
    <?php
                $date = date("Y-m-d");
                  $prod = array();
                $prodqty = array(); 
                    $total = 0;
                    $qry = $conn->query("SELECT tp.*,tl.id,tl.date_created, pl.prod_name as product, tp.price as price, sum(tp.qty) as qty FROM `transaction_products` tp inner join transaction_list tl on tp.transaction_id = tl.id inner join product pl on tp.product_id = pl.prod_id where date(tl.date_created) ='{$date}' group by  pl.prod_id order by qty desc limit 30");
                    while($row = $qry->fetch_assoc()){
                        $total += $row['price'] * $row['qty'];
                      array_push($prod, $row['product']);
      
                      array_push($prodqty, $row['qty']);
              }
            $prod = json_encode($prod);
            $prodqty = json_encode($prodqty);
    ?>
          
    var mydata3=$('#salestrends').get(0).getContext('2d')
    var massPopChart3 = new Chart(mydata3, {
      type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php echo $prod; ?>,
        datasets:[{
          label:'Retail Sales',
          data:<?php echo $prodqty; ?>,
          //backgroundColor:'green',
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000',
          fill: false
          }]
      },
      options:{
        responsive:true,
        title:{
          display:true,
          text:' Ghc <?php echo number_format($total,2) ; ?>',
          fontSize:25
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });

///
<?php
 $from = date("Y-m-d",strtotime(date('Y-m-d')." -1 week"));
  $total=0;
    $sql = "SELECT *, sum(amount) as total FROM  transaction_list WHERE date(date_created) >= '{$from}' group by date(date_created)";
    $cquery = $conn->query($sql);
    $dayarray = array();
    $salesarray = array();
    foreach($cquery as $crow )
    {
      $day= date("M-d-Y",strtotime($crow['date_created']));
      $total=$total+$crow['total'];
      array_push($dayarray, $day);
      
      array_push($salesarray, $crow['total']);
    }
    $dayarray = json_encode($dayarray);
    $salesarray = json_encode($salesarray);
    ?>
    ///
    var mydata=$('#lineChart').get(0).getContext('2d')
    var massPopChartl = new Chart(mydata, {
      type:'line', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php echo $dayarray; ?>,
        datasets:[{
          label:'Retail Sales',
          data:<?php echo $salesarray; ?>,
          //backgroundColor:'green',
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000',
          fill: false
          }]
      },
      options:{
        responsive:true,
        title:{
          display:true,
          text:' Ghc <?php echo number_format($total,2) ; ?>',
          fontSize:25
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });

    ///BAR CHART
    var mydata2=$('#barChart').get(0).getContext('2d')
    var massPopChart2 = new Chart(mydata2, {
      type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php echo $dayarray; ?>,
        datasets:[{
          label:'Retail Sales',
          data:<?php echo $salesarray; ?>,
          //backgroundColor:'green',
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000',
          fill: false
          }]
      },
      options:{
        responsive:true,
        title:{
          display:true,
          text:' Ghc <?php echo number_format($total,2) ; ?>',
          fontSize:25
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
    ///
    //Last 30 days
    //$exdate2=date('Y-m-d', strtotime($exdate. '-31 days'));
    <?php
    //$today=date('Y-m-d');
    //$from = date('Y-m-d',strtotime($today. strtotime('-30 days')));
     $from = date("Y-m-d",strtotime(date('Y-m-d')." -1 month"));

  $total=0;
    $sql = "SELECT *, sum(amount) as total FROM  transaction_list WHERE date(date_created) >= '{$from}' group by date(date_created)";
    $datequery = $conn->query($sql);
    $dayarray = array();
    $salesarray = array();
     while($daterow=mysqli_fetch_array($datequery))
    {
      $day= date("M-d-Y",strtotime($daterow['date_created']));
      $total=$total+$daterow['total'];
      array_push($dayarray, $day);
      
      array_push($salesarray, $daterow['total']);
    }
    $dayarray = json_encode($dayarray);
    $salesarray = json_encode($salesarray);
    ?>
    ///
    var mydata=$('#last30days').get(0).getContext('2d')
    var massPopChartl = new Chart(mydata, {
      type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php echo $dayarray; ?>,
        datasets:[{
          label:'Retail Sales',
          data:<?php echo $salesarray; ?>,
          //backgroundColor:'green',
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000',
          fill: false
          }]
      },
      options:{
        responsive:true,
        title:{
          display:true,
          text:' Ghc <?php echo number_format($total,2) ; ?>',
          fontSize:25
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
    //end last 30 days


    <?php
     
 $total=0;
     $year=date("Y");
  
  $query = $conn->query("select *,SUM(amount) as amount,DATE_FORMAT(date_created,'%b') as month from transaction_list where YEAR(date_created)='$year' group by MONTH(date_created)") or die(mysqli_error($con));
     
     $month = array();
    $data = array();
  

  while($r = mysqli_fetch_array($query)) {

      $total=$total+$r['amount'];
      array_push($month, $r['month']);
      array_push($data, $r['amount']);

}
$month = json_encode($month);
  $data = json_encode($data);
    ?>
 
    
    ///
    var mydata=$('#year').get(0).getContext('2d')
    var massPopChartl = new Chart(mydata, {
      type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
      data:{
        labels:<?php echo $month; ?>,
        datasets:[{
          label:'Retail Sales',
          data:<?php echo $data; ?>,
          //backgroundColor:'green',
          backgroundColor: 'rgba(54, 162, 235, 0.6)',
          borderWidth:1,
          borderColor:'#777',
          hoverBorderWidth:3,
          hoverBorderColor:'#000',
          fill: false
          }]
      },
      options:{
        responsive:true,
        title:{
          display:true,
          text:' Ghc <?php echo number_format($total,2) ; ?>',
          fontSize:25
        },
        legend:{
          display:true,
          position:'bottom',
          labels:{
            fontColor:'#000'
          }
        },
        layout:{
          padding:{
            left:50,
            right:0,
            bottom:0,
            top:0
          }
        },
        tooltips:{
          enabled:true
        }
      }
    });
    //end last 30 days
    //
	
		
        $('#print').click(function(){
            var h = $('head').clone()
            var ph = $($('noscript#print-header').html()).clone()
            var p = $('#printout').clone()
            h.find('title').text('Daily Sales Report - Print View')

            start_loader()
            var nw = window.open("", "_blank", "width="+($(window).width() * .8)+", height="+($(window).height() * .8)+", left="+($(window).width() * .1)+", top="+($(window).height() * .1))
                     nw.document.querySelector('head').innerHTML = h.html()
                     nw.document.querySelector('body').innerHTML = ph.html()
                     nw.document.querySelector('body').innerHTML += p[0].outerHTML
                     nw.document.close()
                     setTimeout(() => {
                         nw.print()
                         setTimeout(() => {
                             nw.close()
                             end_loader()
                         }, 300);
                     }, 300);
        })
	})
	
</script>