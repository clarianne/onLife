<?php include 'header.php'; ?>


<?php include 'admin_header.php'; ?>

<!-- Main -->
<div class="container-fluid">
    <div class="row">

            <?php include 'admin_sidebar.php'; ?>

            <div class="col-lg-9">
				<div id="main-page">
					<div id = "main-content">
							<h2> View Products </h2>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
								<li class="active"> View Products </li>
							</ol>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 ">
								<div class="alert-container" style = 'height: 50px;'>
									<div style="height: 45px; text-align: center;" id = "alert"> </div>
								</div>
							</div>
						</div>
						<br />
	            		<div class="row">
								<div class="col-md-6 col-md-offset-3 ">
									<div class="input-group">
										<input type="text" id = "searchUser" class="form-control">
										<span class="input-group-btn">
											<button class="btn btn-default" id = "searchUserButton" type="button" value="Search"> Search</button>
										</span>
									</div><!-- /input-group -->
								</div><!-- /.col-lg-6 -->
							</div><!-- /.row -->
						<br /><br />
						<?php include 'includes/pager.php'; ?>
						<table class="table table-hover table-bordered" border = "1" cellspacing='5' cellpadding='5' align = 'center'>
							<thead>
								<tr>
									<th width = "20%"><center>Product Code</center></th>
									<th width = "40%"><center>Product Name</center></th>
									<th width = "10%"><center>Distributor's Price</center></th>
									<th width = "10%"><center>Retail Price</center></th>
									<!--<th width="30%"><center>Description</center></th>-->
									<!--<th class="col-md-6"><center>Dimensions</center></th>-->
									<!--<th width="5%"><center>Width</center></th>
									<th width="5%"><center>Height</center></th>
									<th width="5%"><center>Weight</center></th>
									<th width="5%"><center>Remove</center></th>
									<th width="15%"><center>Status</center></th>-->
									<td width = "20%"><center></center></td>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									foreach ($products as $data){
										$data = (array)$data;
										echo "<tr id = '${data['product_code']}'>";
										echo "<td class = 'product_code' > ${data['product_code']}  </td>";
										echo "<td class = 'prod_name' > ${data['prod_name']}  </td>";

										echo "<td class = 'dist_price' >Php ${data['dist_price']}  </td>";
										if($data['ret_price'] == '0'){
											echo "<td class = 'ret_price' > N/A  </td>";
										} else{
											echo "<td class = 'ret_price' >Php ${data['ret_price']}  </td>";
										}
										//echo "<td class = 'prod_desc' > ${data['prod_desc']}  </td>";

										/*if($data['length'] == '0'){
											echo "<td class = 'length' ><b>Length:</b> N/A";
										} else{
											echo "<td class = 'length' ><b>Length:</b> ${data['length']}  cm";
										}
										echo "<br>";

										if($data['width'] == '0'){
											echo "<b>Width:</b> N/A";
										} else{
											echo "<b>Width:</b> ${data['width']}  cm";
										}
										echo "<br>";

										if($data['height'] == '0'){
											echo "<b>Height:</b> N/A ";
										} else{
											echo "<b>Height</b> ${data['height']}  cm";
										}
										echo "<br>";

										if($data['weight'] == '0'){
											echo "<b>Weight:</b> N/A </td>";
										} else{
											echo "<b>Weight:</b> ${data['weight']}  kg</td>";
										}*/

										echo "<td> <button class = 'btn btn-default' onclick = 'confirmEditProduct($(this))' > <span class='glyphicon glyphicon-edit' aria-hidden='true'></span> </button> ";
										echo "<button class = 'btn btn-default' onclick = 'confirmDeleteProduct($(this))' > <span class='glyphicon glyphicon-remove' aria-hidden='true'></span> </button> </td>";
										echo "</tr>";	
									}
								?>
							</tbody>
						</table>
						<?php include 'includes/pager.php'; ?>
					</div>
				</div>
      
<script type="text/javascript">

		function confirmDeleteProduct( thisDiv ){
			
			bootbox.dialog({
				message: "This product will be deleted. Are you sure you want to proceed?",
				title: "Delete Product",
				onEscape: function() {},
				buttons: {
					yes: {
						label: "Yes, continue.",
						className: "btn-primary",
						callback: function() {
							bootbox.dialog({
							  message: "Password: <input type='password' id='pw'></input>",
							  title: "Please enter password",
							  buttons: {
								main: {
								  label: "Confirm",
								  className: "btn-primary",
								  callback: function() {
									console.log("Hi "+ $('#pw').val());
									password = $('#pw').val();
									if( password != "" ){
											$.ajax({
												type : "POST",
												url : "<?php echo site_url(); ?>/admin/check_password",
												data : { password : password },
												success : function( result ){
													if( result == "1" ){
 														deleteProduct(thisDiv);
													} else {
														bootbox.dialog({
															message: "Error in password!",
															title: "Error Delete Product",
															onEscape: function() {},
															buttons: {
																no: {
																	label: "Dismiss",
																	className: "btn-default"
																}
															}
														});
													}
												}
											});																
									}
								  }
								}
							  }
							});
						}
					},
					no: {
						label: "No.",
						className: "btn-default"
					}
				}
			});
		}

		function deleteProduct( thisDiv ){
			var idnumber = thisDiv.parent().siblings('.idnumber').text().trim();
			$.ajax({
				type : "POST",
				url : "<?php echo site_url(); ?>/admin/delete_account",
				data : { idnumber : idnumber },
				beforeSend: function() {
					$("#alert").show();
					$("#alert").removeClass("alert alert-success");
					$("#alert").html("<center><img src='<?php echo base_url();?>dist/images/ajax-loader.gif' /></center>");
				},

				error: function(xhr, textStatus, errorThrown) {
					$("#alert").addClass("alert alert-success");
					$("#alert").html( "<strong>" + xhr.status + " " + xhr.statusText + "</strong>");
					$("#alert").fadeIn('slow');
				},
				success : function( result ){
					if( result == "" ){
						$("#alert").fadeOut('slow', function( ){
							
							$("#alert").addClass( " alert alert-success " );
							$("#alert").html("<strong>" + idnumber + "</strong> account was removed.");
							$('#'+idnumber).remove();
							$("#alert").fadeIn('slow');
		
							document.body.scrollTop = document.documentElement.scrollTop = 0;
							setTimeout(function() { $('#alert').fadeOut('slow') }, 5000);	
						});
						
					}

					$('table').trigger('update');
				}
			});
		}

		</script>

<?php include 'footer.php'; ?>