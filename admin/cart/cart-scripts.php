<script>
$(function(){
  
 

  getCart();

  $('#productForm').submit(function(e){
  	e.preventDefault();
  	var product = $(this).serialize();
  	$.ajax({
  		type: 'POST',
  		url: url:_base_url_+"classes/Master.php?f=addToCart",
  		data: product,
  		dataType: 'json',
  		success: function(response){
  			$('#callout').show();
  			$('.message').html(response.message);
			  getCart();
  			if(response.error){
  				cuteToast({
  				type: "error", // or 'info', 'error', 'warning'
  				message: response.message,
  				timer: 5000
				});
  			}
  			else{
				$('#callout').removeClass('callout-danger').addClass('callout-success');
				getDetails();
					getCart();
					getTotal();
  			}
  		}
  	});
  });




  $(document).on('click', '.close', function(){
  	$('#callout').hide();
  });


});

function getCart(){
	$.ajax({
		type: 'POST',
		url: _base_url_+"admin/cart/cart_fetch.php",
		dataType: 'json',
		success: function(response){
			$('#cart_menu').html(response.list);
			$('.cart_count').html(response.count);
		}
	});
}
function addToCart(){
  	var product = $('#productForm').serialize();
  	$.ajax({
  		type: 'POST',
  		url: _base_url_+"admin/cart/cart_add.php",
  		data: product,
  		dataType: 'json',
  		success: function(response){
  			$('#callout').show();
  			alert_toast(response.message,'success');
			  //getCart();
			    getDetails();
					getCart();
					getTotal();
  			if(response.error){
  				alert_toast(response.message,'error');
  			}
  			else{
				$('#callout').removeClass('callout-danger').addClass('callout-success');
				getDetails();
					getCart();
					getTotal();
  			}
  		}
  		});
  	}

</script>