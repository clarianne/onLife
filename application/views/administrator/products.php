<?php include 'header.php'; ?>

      
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

<?php include 'admin_header.php'; ?>

<!-- Main -->
<div class="container-fluid">
    <div class="row">

            <?php include 'admin_sidebar.php'; ?>

            <div class="col-lg-9">
				<div id="main-page">
					<div id = "main-content">
							<h2> List of all Products </h2>
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
										<form method="post"  style="width: 800px ; margin-left: auto; margin-right: auto;" role="form">
						                  
											<input type="text" name="search"  size="80"/>
											<input class = "btn btn-primary" type="submit" value="Search" name="search_products"/> 
						                   
			                    		</form>
									</div><!-- /input-group -->
								</div><!-- /.col-lg-6 -->
							</div><!-- /.row -->
						<br /><br />
						<?php include 'includes/pager.php'; ?>
						<?php
                        echo "<table class = 'table table-hover table-bordered'>
                            <thead>
                                <tr>
									<th width = '20%'><center>Product Code</center></th>
									<th width = '40%'><center>Product Name</center></th>
									<th width = '10%'><center>Distributors' Price</center></th>
									<th width = '10%'><center>Retail Price</center></th>
									<th width = '10%'><center>Description</center></th>
									<td width = '20%'><center></center></td>
                                </tr>
                            </thead>";
                                if(count($flag)==0){
                                	echo "<tbody>";
                                    echo "<td colspan = '7' class = 'nolibmat' style='background-color:rgba(0,0,0,0.1); color: black;'><center>No product found.</center></td>";
                                    echo "</tbody>";
                                }else{ 
                                    echo "<tbody>";	
                                    foreach ($sql2 as $q){
										echo "<tr id = '{$q->product_code}'>";
												
												
											echo "<td class = 'product_code'><center><span class='table-text'>{$q->product_code} </span></center></td>";
											
											//echo "<td><center>" . $fname . " " . $lname . "</center></td>";
											echo "<td class = 'prod_name'>" . $q->prod_name . "</td>";
											echo "<td class = 'dist_price'>" . $q->dist_price . "</td>";
											echo "<td class = 'ret_price'>" . $q->ret_price . "</td>";
											echo "<td class = 'prod_desc'>" . $q->prod_desc . "</td><td>";

												echo "<form method='post' name='update' action='update_product'>";
												echo "<input type='hidden' name='product_code' value='" . $q->product_code . "'/>";
												echo "<button type='submit' class='updateButton btn btn-default' name='update'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Edit'><span class='glyphicon glyphicon-edit'></span></a></button></form>";
												echo "<button onclick = 'deleteProd($(this))' class='deleteButton btn btn-danger' name='return'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Delete'><span class='glyphicon glyphicon-remove'></span></a></button>";
												echo "</td></tr>";
											}
                                       	echo "</tbody>";
                                    }
                                echo "</table>";   
                         ?>
						<?php include 'includes/pager.php'; ?>
					</div>
				</div>

<?php include 'footer.php'; ?>