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
							<h2> Update Distributor Information: </h2>
							<h4><?php echo $update_details->fname . " " . $update_details->lname; ?></h4> 
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url()?>admin/home">Home</a></li>
								<li class="active"> Update Distributors </li>
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
									<label class="col-sm-2 control-label">LFSI ID</label>
									<label id="preclass" name="preclass" class="col-sm-2 control-label"><?php echo $update_details->lfsi_id; ?></label>
									<div class="col-sm-1">
										<input type="hidden" id="previous_lfsiid" name="previous_lfsiid" value="<?php echo $update_details->lfsi_id;?>">
										<input type="hidden" id="lfsi_id" name="lfsi_id" value="<?php echo $update_details->lfsi_id;?>">
									</div>
										<span style="color: red;" id="helpmaterialid" name="helpmaterialid"> </span>
								</div>

								<div id="fname_div" class="form-group" style='display:block'>
									<label for="fname" class="col-sm-2 control-label">Given Name / Company Name</label>
									<div class="col-sm-4">
										<input type="text" maxlength="20" class="form-control" value="<?php echo $update_details->fname;?>"  name="fname" id="fname" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" placeholder="Given Name / Company Name" required/>
									</div>
									<span style="color: red;" name="helpname">
								</div>

								<div id="lname_div" class="form-group" style='display:block'>
									<label for="lname" class="col-sm-2 control-label">Last Name</label>
									<div class="col-sm-4">
										<input type="text" maxlength="20" class="form-control" value="<?php echo $update_details->lname;?>"  name="lname" id="lname" pattern="[A-Z][A-Za-z]+" placeholder="Last Name" required/>
									</div>
									<span style="color: red;" name="helpname">
								</div>

								<div class="form-group">
								<label for="address" class="col-sm-2 control-label">Address</label>
								<div class="col-sm-4">
									<textarea type="text" name="address" class="form-control" id="address" placeholder="Address" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="3" cols="75"><?php echo $update_details->address;?></textarea>
								</div>
								<span style="color: red;" name="helpaddress">
								</div>

	                            <div class="form-group"><br />
	                                <label for="contact_num" class="col-sm-2 control-label">Contact Number</label>
	                                <div class="form-inline col-sm-2">
	                                    <input type="text" maxlength="20" class="form-control" value="<?php echo $update_details->contact_num;?>"  name="contactnum" id="contactnum" pattern="[0-9]+" placeholder="Contact Number" required />
	                                </div>
	                                <span style="color: red;" name="helpcontactnum">
	                            </div>

	                             <div class="form-group">
	                                <label for="dist_status" class="col-sm-2 control-label">Status</label>
	                                <div class="col-sm-3">
	                                    <select name="dist_status" id="dist_status" class="form-control" >
	                                    <?php

	                                    if ($update_details->dist_status == "ACTIVATED")  
	                                        echo "<option value='ACTIVATED' selected >Activated</option>
	                                            <option value='DEACTIVATED' >Deactivated</option>";
	                                    else if ($update_details->dist_status == "DEACTIVATED")  
	                                        echo "<option value='ACTIVATED' >Activated</option>
	                                            <option value='DEACTIVATED' selected >Deactivated</option>";
	                                    ?>
	                                    </select>
                               		 </div>
                            	</div>
								
								</form>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10"><br />
									<button onclick="updateDetails()" class="btn btn-primary" id="updateButton" name="update">Update</button>
									<a href="<?php echo site_url()?>/admin/distributors"><button type="button" class="btn btn-danger">Cancel</button></a>
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
					message: "Save changes to this distributor?",
					title: "Confirmation",
					buttons: {
							yes: {
							label: "Yes",
							className: "btn-primary",
							callback: function() {
															
								//var preclass = document.getElementById("preclass").innerHTML;
								var previous_lfsiid = update.previous_lfsiid.value;
								var lfsi_id = update.lfsi_id.value;
                                var fname = update.fname.value;
                                var lname = update.lname.value;
                                var address = update.address.value;
                                var contact_num = update.contactnum.value;
                                var dist_status = update.dist_status.value;
															
								$.ajax({
									type: "POST",
									url: "<?php echo site_url()?>/admin/dist_update_execution",
									data: { previous_lfsiid : previous_lfsiid,
											lfsi_id : lfsi_id,
                                            fname : fname,
                                            lname : lname,
                                            address : address,
                                            contact_num : contact_num,
                                            dist_status : dist_status,
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
											$("#success_update").html("Distributor information successfully updated!");
											$("#success_update").fadeIn('slow');
											document.body.scrollTop = document.documentElement.scrollTop = 0;
											setTimeout(function() { $("#success_update").html("Redirecting to Distributors Page...");
																	window.location.href = "<?php echo site_url()?>/admin/distributors"; }, 2000);	
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

				//preclass = document.getElementsByName('preclass')[0].innerHTML;
				//lfsi_id = update.lfsi_id.value;
				finalcheckofupdate();
				
				/*$.ajax({
					url: "<?php //echo site_url()?>/admin/check_new_lfsi_id",
					type: "POST",
					data: { preclass: preclass, lfsi_id : lfsi_id, previous_matID : previous_matID},
					success: function (result){
						if ($.trim(result) == '1'){

							$('#helplfsi_id').html("");

							if (type == 'Book' || type == 'References' || type == 'Journals' || type == 'Magazines') {

								isbn = update.isbn.value;
								type = update.type.value;
								previous_isbn = update.previous_isbn.value;

								
							}
							else finalcheckofupdate();
						}
					}
				});*/
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