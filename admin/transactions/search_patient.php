<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header">
		<h3 class="card-title">Patient Search to View Bills</h3>
		
	</div>
	<div class="card-body">
        <div class="container">
        	<section class="content">
            <div class="row">
             
            <div class="col-md-6">
              <div class="card card-primary">
                <div class="card-header with-border">
                  <h3 class="card-title">Search Patient to View Bills</h3>
                </div>
                <div class="card-body">
                
                <form method="post" action="<?php echo base_url ?>admin/?page=transactions/view_bill" >
                  <input type="hidden" name="invoice" value="<?php echo $invoice ?>">
  
                  <div class="form-group">
                    <label for="date">Search Patient by Name, ID etc</label>
                    <div class="input-group col-md-12">
                      <select class="form-control select2" style="width: 100%;" name="cid" required>
                         <option value="0" selected="selected" disabled>Click to Search for Patient</option>
                      <?php
                       include('../dist/includes/dbcon.php');
                        $query2=$conn->query("select * from patient");
                          while($row2=mysqli_fetch_array($query2)){
                      ?>
            <option value="<?php echo $row2['patient_id'];?>"><?php echo $row2['first_name']." ".$row2['othernames'].", ".$row2['patient_id'];?></option>
          <?php }?>
                    </select>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->
      
                  
                  <div class="form-group">
                    <div class="input-group col-md-12">
                      <button class="btn btn-lg btn-primary pull-right" id="daterange-btn" name="">
                        Search
                      </button>
           
                    </div>
                  </div><!-- /.form group -->
        </form> 
        
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col (right) -->
            
            

          </section><!-- /.content -->
			
		</div>
	</div>
</div>
<script>

      $(function () {
        //Initialize Select2 Elements
        $(".select2").select2();
    });
	$(document).ready(function(){
		$('#patient-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_patient",
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

		$('.delete_data').click(function(){
			_conf("Are you sure to delete this Service permanently?","delete_service",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Add New Service","services/manage_service.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-bars'></i> Service Details","services/view_service.php?id="+$(this).attr('data-id'))
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Update Service Details","services/manage_service.php?id="+$(this).attr('data-id'))
		})
		$('.table').dataTable({
			columnDefs: [
					{ orderable: false, targets: [4,5] }
			],
			order:[0,'asc']
		});
		$('.dataTable td,.dataTable th').addClass('py-1 px-2 align-middle')
	})
	function delete_service($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_service",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>