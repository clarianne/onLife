<?php include 'header.php'; ?>
<!-- START OF SIGN UP -->
<div class="container" id="register-container-margin">
    <div class="row">
        <div class = "col-xs-12 col-sm-5 col-md-8 col-lg-offset-1" id="side-png-background">
            <div id="bg">
              <h3>Some reminders:</h3>
              <ul class="ul-font">
                  <li>Only active distributors can sign up for an onLife account. Please provide your LFSI ID and email address as stated in your distributor's registration form.</li>
                  <li>If by chance you forgot your LFSI ID, please contact the main office at (02) 687-4770 and look for Ma'am Eds.</li>
              </ul>
            </div>
        </div>
       <div class="col-xs-6 col-md-4 col-lg-offset-1"><br/><br/><br/>
          <legend><center><a href="#"><i class="glyphicon glyphicon-globe"></i></a> Create your onLife account</center></legend>

          <form action="<?php echo site_url()?>/registration" method="post" class="form" role="form">

          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
               <div class="form-group">
                    <div class="col-sm-4">
                      <label for="lfsi_id"> LFSI ID </label>
                    </div>
                  <div class="col-sm-8">
                    <input placeholder="XX-XXXXXXX" class="form-control" name="lfsi_id" id="lfsi_id" value="<?php echo set_value('lfsi_id');?>" type="text" required />
                     <div class="error-space">
                       <span id="error_message" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                      <label for="email_add"> Email </label><br/>
                    </div>
                  <div class="col-sm-8">
                    <input placeholder="email@address.com" class="form-control" name="email_add" id="email_add" value="<?php echo set_value('email_add');?>" type="email" required>
                     <div class="error-space">
                       <span id="error_message1" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="row"><br/>
            <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                      <label for="password"> Password </label><br/>
                    </div>
                  <div class="col-sm-8">
                    <input placeholder="Enter password" class="form-control" name="password" id="password" type="password"/>
                     <div class="error-space">
                       <span id="error_message2" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class = "row"><br/>
            <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                      <label for="password_conf"> Re-enter password </label><br/>
                    </div>
                  <div class="col-sm-8">
                    <input placeholder="Re-enter password" class="form-control" name="password_conf" id="password_conf" onblur="validatePassword()" type="password"/>
                     <div class="error-space">
                       <span id="error_message3" class="error_color"></span>
                    </div>
                  </div>
              </div>
            </div>
          </div>
      <div id="reg"></div>
          <div class = "row"><br/>
             <div class="col-xs-4 col-md-12">
              <div class="form-group">
                    <div class="col-sm-4">
                    </div>
                  <div class="col-sm-8">
                    <button class="btn btn-lg btn-primary" id="sign_up" type="button"  > Sign up</button>
                    <a href="<?php echo site_url(); ?>/dist/login"><button class="btn btn-lg btn-default" id="sign_up" type="button" > Log in</button></a>
                  </div>
              </div>
            </div>
          </div>      
        </div>
    </div>
</div>
         <!-- END OF SIGN UP -->
<hr class="featurette-divider">
  <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
  <link href="<?php echo base_url(); ?>assets/css/signup.css" rel="stylesheet">
  <script>

  //$('#add').hide();
  var flagId = false;
  var flagEmail = false;
  var flagValidate = false;
  var flagPass = false;


    $('#lfsi_id').blur( check_lfsi_id );

    $('#email_add').blur( check_email );

    $('#password').blur( check_password);

   function validatePassword(){  
      var password = document.getElementById('password').value;
      var password_conf = document.getElementById('password_conf').value;
    
    if(password == password_conf){
      $('#error_message3').html("");
      flagValidate =  true;
      }else{
      $('#error_message3').html("Password does not match. Check passwords");
      flagValidate =  false;
      password_conf.focus;
    }
    }

    function check_password(){
      var password = $('#password').val();

      $.ajax({
        url: "<?php echo site_url();?>/dist/checkpassword",
        type: "POST",
        data: { password : password},

        success: function(result){
          if($.trim(result)=="1"){
         $('#error_message2').html("Password length must be atleast 6 alphanumeric characters");
               flagPass =  false;
         validatePassword();
            }
          else{
             $('#error_message2').html("");
             flagPass =  true;
          }
        }
      });
    }

    function check_email(){
      var value = $('#email_add').val();
        $.ajax({
          url: "<?php echo site_url();?>/dist/checkemail",
          type: "POST",
          data: { email : value},
          success: function(result){
              if($.trim(result)=="2"){
        $('#error_message1').html("Email in use");
                flagEmail =  false;
              }
              else if($.trim(result)=="1"){
                $('#error_message1').html("Email must be in xxxx@domain format<br/>ex. xxxxx@gmail.com");
                flagEmail =  false;
              }
              else if($.trim(result)=="0"){
        $('#error_message1').html("");
                flagEmail =  true;
              }
            }
        });
    }

    function check_lfsi_id(){
        var value = $('#lfsi_id').val();
        $.ajax({
          url: "<?php echo site_url();?>/dist/checklfsi_id",
          type: "POST",
          data: { lfsi_id : value},
          success: function(result){
            if($.trim(result)=="1"){
               $('#error_message').html("LFSI ID in use");
                flagId =  false;
            }
            else if($.trim(result)=="2"){
               $('#error_message').html("Not a registered distributor");
                 flagId =  false;
            }
            else if($.trim(result)=="3"){
               $('#error_message').html("Invalid LFSI ID!<br/> XX-XXXXXXX");
               flagId =  false;
            }
            else if($.trim(result)=="0"){
               $('#error_message').html("");
               flagId =  true;
            }
          }
        } );
    }

    $('#sign_up').click( function(){
    check_lfsi_id();
    check_email();
    check_password();
    
        if( flagId && flagEmail && flagValidate && flagPass ){
    
          var lfsi_id = document.getElementById('lfsi_id').value;
          var password = document.getElementById('password').value;
          var email = $('#email_add').val();
          var onlife_status = 'ACTIVATED';

        $.ajax({
          url: "<?php echo site_url();?>/distributor/registration",
          type: "POST",
          data: { lfsi_id : lfsi_id, email : email, onlife_status : onlife_status, password : password },

      beforeSend: function() {
        $("#reg").removeClass('alert alert-danger');
        $("#reg").html("<center><img src='<?php echo base_url();?>assets/img/ajax-loader.gif' /></center>");
      },
      
      success: function(result){

        if( result != "1" ){

          $("#reg").hide();
          bootbox.dialog({
          message: "Your account has been created!",
          title: "<h3>Account Created!<h3>",
          buttons:{
            no: {
            label: "Log In",
            className: "btn-primary",
            callback: function() {
               window.location.href = "<?php echo site_url();?>/dist/login/";
            }
            }
          }
          });
        }



      },


      error: function(){
        $("#reg").addClass("alert alert-danger");
        $("#reg").html("<center>An error has occurred. Try again.</center>");
      }
        });
        }
    });

  </script>

<?php include 'footer.php' ?>