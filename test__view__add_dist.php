<script>
		$('#add-nav').addClass('active');
			function finalcheckofadd() {
				if (validateLFSIID)
				bootbox.dialog({
					message: "Confirm details of this distributor?",
					title: "Confirmation",
					buttons: {
							yes: {
							label: "Save",
							className: "btn-primary",
							callback: function() {
															
								var preclass = document.getElementById("preclass").innerHTML;
								var lfsiid = preclass + add.lfsiid.value;
								var onlife_status = "DEACTIVATED";
								var fname = add.fname.value;
								var lname = add.lname.value;
								var address = add.address.value;
								var contact_num = add.contactnum.value;
								var email_add = add.emailadd.value;
															
								$.ajax({
									type: "POST",
									url: "<?php echo site_url();?>/admin/add_execution",
									data: { lfsiid : lfsiid,
											onlife_status : onlife_status,
											fname : fname,
											lname : lname,
											address : address,
											contact_num : contact_num,
											email_add : email_add,
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
											$("#success_add").show();
											$("#fail_add").hide();
											$("#success_add").html("Distributor successfully added to the database!");
											$("#success_add").fadeIn('slow');
											document.body.scrollTop = document.documentElement.scrollTop = 0;
											setTimeout(function() { $("#success_add").html("Redirecting to Dashboard...");
																	window.location.href = "<?php echo site_url();?>/admin/dashboard/"; }, 2000);	
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
				else showError();
			}

			function showError(){
				$("#success_add").hide();
				$("#fail_add").show();
				$("#fail_add").html("Some distributor data are not valid!");
				$("#fail_add").fadeIn('slow');
				document.body.scrollTop = document.documentElement.scrollTop = 0;
			}

			function addDetails(){

				preclass = document.getElementsByName('preclass')[0].innerHTML;
				lfsiid = add.lfsiid.value;
				//type = add.type.value;

				$.ajax({
					url: "<?php echo site_url();?>/admin/check_lfsiid",
					type: "POST",
					data: { preclass: preclass, lfsiid : lfsiid },
					success: function (result){
						if ($.trim(result) == '1'){

							$('#helplfsiid').html("");

							finalcheckofadd();
						}
						else if ($.trim(result) == '2') {
							$('#helplfsiid').html("LFSI ID already exists.");
							showError();
						}
						else if ($.trim(result) == '3') {
							$('#helplfsiid').html("Invalid LFSI ID.");
							showError();
						}
					}
				});
			}
				
				window.onload = function() {
					add.lfsiid.onblur = validateLFSIID;
					$('#container1').modal('hide');
				}
				

				function validateLFSIID(){
					
					preclass = document.getElementsByName('preclass')[0].innerHTML;
					lfsiid = add.lfsiid.value;
				
					$.ajax({
						url: "<?php echo site_url();?>/admin/check_lfsiid",
						type: "POST",
						data: { preclass: preclass, lfsiid : lfsiid },
						success: function (result){
							if ($.trim(result) == '1'){
								$('#helplfsiid').html("");
								return true;
							}
							else if ($.trim(result) == '2') {
								$('#helplfsiid').html("LFSI ID already exists.");
								return false;
							}
							else if ($.trim(result) == '3') {
								$('#helplfsiid').html("Invalid LFSI ID.");
								return false;
							}
						}
					});
				}
				
				function validateName(){
					msg = "Invalid input. ";
					str = add.name.value;
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

<!-- End of Script -->