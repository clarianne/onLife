<?php include 'header.php'; ?>

<?php include 'admin_header.php'; ?>

<!-- Main -->
<div class="container-fluid">
    <div class="row">

            <?php include 'admin_sidebar.php'; ?>
			<div class="col-lg-9">
				<div id="main-page">
					<div id = "main-content">
					<div id="container">
					<form name="update" id="update" class="form-horizontal" method="post">
							<h2> Update Product Information: </h2>
							<h4><?php echo $update_details->prod_name; ?></h4> 
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
								<li class="active"> Update Order </li>
							</ol>
						<div class="row">
							<div class="col-md-6 col-md-offset-3 ">
								<div class="alert-container" style = 'height: 50px;'>
									<div style="height: 45px; text-align: center;" id = "alert"> </div>
								</div>
							</div>
						</div>
								<div class="alert-container" style = 'height: 40px; margin-bottom: 19px;'>
									<div style="display:none" id="success_update" class = "alert alert-success"></div>
									<div style="display:none" id="fail_update" class = "alert alert-danger"></div>
								</div> 


								 <div class="form-group">
                                <label class="col-sm-2 control-label">Product Code</label>
                                <label id="preclass" name="preclass" class="col-sm-2 control-label"><?php echo $update_details->product_code; ?></label>
                                <div class="col-sm-2">
                                    <input type="hidden" id="previous_prodcode" name="previous_prodcode" value="<?php echo $update_details->product_code;?>">
                                </div>
                                <span style="color: red;" id="product_code" name="helpproduct_code"></span>
                            </div>

                            <div class="form-group">
                                <label for="prod_name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-4">
                                    <textarea type="text" name="prod_name" class="form-control" id="title" placeholder="Product Name" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="2" cols="50"><?php echo $update_details->prod_name;?></textarea>
                                </div>
                                <span style="color: red;" name="helpprod_name">
                            </div>

                            <div class="form-group">
                                <label for="prod_category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-3">
                                    <select name="prod_category" id="prod_category" class="form-control" >
                                    <?php

                                    if ($update_details->prod_category == "Health Care")  
                                    	echo "<option value='Health Care' selected >Health Care</option>
                                    		<option value='Life Synergy Health Care' >Life Synergy Health Care</option>
                                    		<option value='Life Synergy U Beauty Care' >Life Synergy U Beauty Care</option>
                                    		<option value='Materials' >Materials</option>";
                                    else if ($update_details->prod_category == "Life Synergy Health Care")  
                                    	echo "<option value='Health Care' >Health Care</option>
                                    		<option value='Life Synergy Health Care' selected >Life Synergy Health Care</option>
                                    		<option value='Life Synergy U Beauty Care' >Life Synergy U Beauty Care</option>
                                    		<option value='Materials' >Materials</option>";
                                    else if ($update_details->prod_category == "Life Synergy U Beauty Care")  
                                    	echo "<option value='Health Care' >Health Care</option>
                                    		<option value='Life Synergy Health Care' >Life Synergy Health Care</option>
                                    		<option value='Life Synergy U Beauty Care' selected >Life Synergy U Beauty Care</option>
                                    		<option value='Materials' >Materials</option>";
                                    else if ($update_details->prod_category == "Materials")  
                                    	echo "<option value='Health Care' >Health Care</option>
                                    		<option value='Life Synergy Health Care' >Life Synergy Health Care</option>
                                    		<option value='Life Synergy U Beauty Care' >Life Synergy U Beauty Care</option>
                                    		<option value='Materials' selected >Materials</option>";
                                    ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dist_price" class="col-sm-2 control-label">Distributor's Price</label>
                                <div class="form-inline col-sm-3">
                                    <div class="input-group">
                                      <span class="input-group-addon">Php</span>
                                      <input type="number" maxlength="6" class="form-control"  name="dist_price" id="dist_price" pattern="[0-9]+" value="<?php echo $update_details->dist_price;?>" required>
                                    </div>
                                </div>
                                <span style="color: red;" name="helpedvol">
                            </div>

                            <div class="form-group">
                                <label for="ret_price" class="col-sm-2 control-label">SRP</label>
                                <div class="form-inline col-sm-3">
                                    <div class="input-group">
                                      <span class="input-group-addon">Php</span>
                                      <input type="number" maxlength="6" class="form-control"  name="ret_price" id="ret_price" pattern="[0-9]+" value="<?php echo $update_details->ret_price;?>" required>
                                    </div>
                                </div>
                                <span style="color: red;" name="helpedvol">
                            </div>

                            <div class="form-group">
                                <label for="prod_desc" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-5">
                                    <textarea type="text" name="prod_desc" class="form-control" id="prod_desc" placeholder="Describe the product in less than 100 words" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="4" cols="50"><?php echo $update_details->prod_desc;?></textarea>
                                </div>
                                <span style="color: red;" name="helpname">
                            </div>

                            <div class="form-group">
                                <label for="prod_avail" class="col-sm-2 control-label">Availability</label>
                                <div class="col-sm-3">
                                    <select name="prod_avail" id="prod_avail" class="form-control" >
                                    <?php

                                    if ($update_details->prod_avail == "AVAILABLE")  
                                        echo "<option value='AVAILABLE' selected >Available</option>
                                            <option value='NOT AVAILABLE' >Not Available</option>";
                                    else if ($update_details->prod_avail == "NOT AVAILABLE")  
                                        echo "<option value='AVAILABLE' >Available</option>
                                            <option value='NOT AVAILABLE' selected >Not Available</option>";
                                    ?>
                                    </select>
                                </div>
                            </div>

                            
								
								</form>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10"><br />
									<button onclick="updateDetails()" class="btn btn-primary" id="updateButton" name="update">Update</button>
									<a href="<?php echo site_url()?>/admin/products"><button type="button" class="btn btn-danger">Cancel</button></a>
								</div>
							</div>
							<br>
						</div>	
						</div>	
					</div>	
				</div>	
			</div>
			</div>
<script>

			function finalcheckofupdate() {
			//	if (validateLFSIID())
				bootbox.dialog({
					message: "Save changes to this product?",
					title: "Confirmation",
					buttons: {
							yes: {
							label: "Yes",
							className: "btn-primary",
							callback: function() {
															
								//var preclass = document.getElementById("preclass").innerHTML;
								var previous_prodcode = update.previous_prodcode.value;
								//var product_code = update.product_code.value;
                                var prod_name = update.prod_name.value;
                                var prod_category = update.prod_category.value;
                                var prod_desc = update.prod_desc.value;
                                var dist_price = update.dist_price.value;
                                var ret_price = update.ret_price.value;
                                var prod_avail = update.prod_avail.value;
                                //var imgurl = update.imgurl.value;
															
								$.ajax({
									type: "POST",
									url: "<?php echo site_url()?>/admin/prod_update_execution",
									data: { previous_prodcode : previous_prodcode,
											//product_code : product_code,
											prod_name : prod_name,
                                            prod_category : prod_category,
                                            prod_desc : prod_desc,
                                            dist_price : dist_price,
                                            ret_price : ret_price,
                                            prod_avail : prod_avail,
                                           // imgurl : imgurl,
										  },
									beforeSend: function() {
										//$("#con").html('<img src="/function-demos/functions/ajax/images/loading.gif" />');
										$("#error_message").html("loading...");
									},

									error: function(xhr, textStatus, errorThrown) {
											$('#error_message').html(textStatus);
											//console.log(textStatus);
									},

									success: function( result ){

										if( result != "1" ){
											$("#success_update").show();
											$("#fail_update").hide();
											$("#success_update").html("Product information successfully updated!");
											$("#success_update").fadeIn('slow');
											document.body.scrollTop = document.documentElement.scrollTop = 0;
											setTimeout(function() { $("#success_update").html("Redirecting to Products Page...");
																	window.location.href = "<?php echo site_url()?>/admin/products/"; }, 2000);	
										}
									}
								});
							}

							},
							no: {
								label: "No",
								className: "btn-default"
							}
						}
					});
				//else showError();
			}

			function showError(){
				$("#success_update").hide();
				$("#fail_update").show();
				$("#fail_update").html("Some details are not valid!");
				$("#fail_update").fadeIn('slow');
				document.body.scrollTop = document.documentElement.scrollTop = 0;
			}

			function updateDetails(){

				finalcheckofupdate();
			}


				function validateName(){
					msg = "Invalid input. ";
					str = update.name.value;
					if (str == "") {
						msg+="Title is required. ";
					}
					if (!str.match(/^[A-Z][A-Za-z0-9\(\)\ \.\,\-\'\?\!\/]+$/)) {
						msg+="Characters are invalid.";
					}
					if (msg == "Invalid input. ") msg="";

					document.getElementsByName("helpname")[0].innerHTML = msg;
					if (msg == ""){ 
						return true;
					}
				}

				</script>
		<?php include 'footer.php'; ?>