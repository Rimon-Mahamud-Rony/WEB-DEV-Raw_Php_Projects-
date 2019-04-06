</div>
<footer class="footer" id="footer" style="background-color: #2e4053; color:white; margin-bottom: 3px; text-align: center;">&copy; All the rights reserved by Rimon Mahamud Rony | &#x2709; : <a href="mailto:rimonronycste11@gmail.com">rimonronycste11@gmail.com</a> | &#9742; : <a href="tel:+8801862117112">+8801862117112</a> </footer>
</body>

<script>
	function updateSizes(){
		var sizeString ='';
		for (var i=1; i<=12; i++)
		{
			if(jQuery('#size'+i).val() !=''){
				sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
			}
		}
		jQuery('#sizes').val(sizeString);
	}

	//ajax request for fire the items from child categories.php
	function get_child_options(selected){
		if (typeof selected ==='undefined') {
			var selected = '';
		}
		var parentID = jQuery('#parent').val();
		jQuery.ajax({ //fired off this request of the id in 'parent'
			url: '/tutorial/admin/parsers/child_categories.php',
			type:'POST',
			data: {parentID : parentID, selected: selected},
			success: function(data){
				jQuery('#child').html(data);
			},
			error: function(){
				alert("Something went wrong with the child options.")
			},
			
		});
	}
	jQuery('select[name="parent"]').change(function(){
		get_child_options();
	});// eikhan theke jquery request gula shunche ze se select e kake call kortese.. ami eikhane select diye parent ke zokhon e call kore kichu ekta select korlam , sathe sathe change built in fuction e ami get_child_options ke call kore disi ... se jonnno se protita alada alada parent er jonno tar children gula show kore ... oiiiiiiiiiiii.......... get_child_options er maddhome......
</script>
</html>
