<br>
<footer class="footer" id="footer" style="background-color: #2e4053; color:white; margin-bottom: 3px; text-align: center;">&copy; All the rights reserved by Rimon Mahamud Rony | &#x2709; : <a href="mailto:rimonronycste11@gmail.com">rimonronycste11@gmail.com</a> | &#9742; : <a href="tel:+8801862117112">+8801862117112</a> </footer>
<script>
	jQuery(window).scroll(function(){
		var vscroll = jQuery(this).scrollTop();
		jQuery('#logotext').css({
			"transform" : "translate(0px, "+vscroll/2+"px)"
		});

		var vscroll = jQuery(this).scrollTop();
		jQuery('#male').css({
			"transform" : "translate("+vscroll/4+"px)"
		});

		var vscroll = jQuery(this).scrollTop();
		jQuery('#female').css({
			"transform" : "translate( -"+vscroll/4+"px)"
		});

	});

	function detailsmodal(id){
			var data = {"id" : id};
			jQuery.ajax({
				url: '/tutorial/includes/detailsmodal.php',
				method:"post",
				data: data,
				success : function(data){
					jQuery('body').append(data);
					jQuery('#details-modal').modal('toggle');
				},
				error: function(){
					alert("something went wrong!");
				}
			})

	}

function add_to_cart(){
	//alert("works");
	jQuery('#modal_errors').html("");
	var size = jQuery('#size').val();
	var quantity = jQuery('#quantity').val();
	var available = jQuery('#available').val();
	var error = '';
	var data = jQuery('#add_product_form').serialize();

	if (size == '' || quantity =='' || quantity == 0) {
		error += '<p class="text-danger text-center" style="background-color:#A1B3E5; height:25px;">You must choose a size and quantity.</p> <hr>';
		jQuery('#modal_errors').html(error);
		return;
	}
	else if (quantity < available){
		error += '<p class="text-danger text-center" style="background-color:#A1B3E5; height:25px;">There are only '+available+' available.</p> <hr>';
		jQuery('#modal_errors').html(error);
		return;
	}
	else{
		jQuery.ajax({
			url:'/tutorial/admin/parsers/add_cart.php',
			method: 'post',
			data : data,
			success: function(){
				location.reload();
			},
			error : function(){alert("something went wrong")}
		});
	}


	 }

</script>
</body>
</html>
