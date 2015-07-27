<?php include 'header.php'; ?>


		<div class="container">
			<div class="signin">
				<div style = "height : 100px">
					<div id = "message" >  </div>
				</div>
				
				<div class="panel panel-info">
					<div class="panel-heading">
						<h3 class="form-signin-heading">onLife Admin Login</h3>
					</div>

					<form id = "login_form" class="form-signin" role="form">
						<input type="email"name = "uname" class="form-control" placeholder="Username" required autofocus>
						<input type="password" name = "pword" class="form-control" placeholder="Password" required>
						<button class="btn btn-lg btn-primary btn-block" type="button" id = "submit">Sign in</button>
					</form>
				</div>
			</div>
		</div>

		<!-- Script for logging in -->
		
		<script src="<?php echo base_url();?>assets/js/jquery.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.js"></script>
		<script type="text/javascript">
		
			$("#login_form").keypress(function(event){
				if(event.keyCode == 13){
					event.preventDefault();
					$("#submit").click();
				}
			});

			$("#submit").click( function(){				
				$(this).attr('disabled', true);
				
				username = $("#login_form").find("input[name='uname']").val();
				password = $("#login_form").find("input[name='pword']").val();

				$.ajax({
					url: "<?php echo site_url('administrator/check_admin'); ?>", //this will check if the admin is found at DB
					type: "POST",
					dataType: "html",
					data: { uname: username, pword: password },

					beforeSend: function() {
						$("#message").removeClass("alert alert-danger");
						$("#message").html("<center><img src='<?php echo base_url();?>assets/img/ajax-loader.gif' /></center>");
					},

					error: function(xhr, textStatus, errorThrown) {
						$("#message").addClass("alert alert-danger");
						$("#message").html( "<strong>" + xhr.status + " " + xhr.statusText + "</strong>");
						$("#message").fadeIn('slow');
					},

					success: function( result ){
						if ( result != "1" ){  
							$("#message").fadeOut('slow', function( ){
								$("#message").addClass("alert alert-danger");
								$("#message").html( "<strong>" + result + "</strong>");
								$("#message").fadeIn('slow');
								$("#submit").attr('disabled', false);
							});
														
						}
						else {
							window.location.href = "<?php echo site_url();?>/admin/dashboard";
						}
					}
				});
			});


		</script>


<?php include 'footer.php'; ?>