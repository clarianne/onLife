<?php include "header_login.php"; ?>

    <div class="login-form">
    <h1>Add logo here</h1>

        <form id = "login_form" class="form-signin" role="form">

          <div class="form-group">
          	<input type="text" placeholder="Email Address" value="<?php echo $this->session->userdata('forgot');?>"  class="form-control"  name="email_add" required><i class="fa fa-user"></i>
          </div>

          <div class="form-group log-status">
          	<input type="password" placeholder="Password" class="form-control" name="password" required><i class="fa fa-lock"></i>
          </div>

  		    <a href="#forgot" id="forgotText" data-toggle="modal"> Forgot password? </a>

          <button class="btn btn-lg btn-primary btn-block" type="button" id = "sign_in">Sign in</button>

        </form>

     </div>

   </div>

      <div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">

        <div class="modal-dialog">

        <div class="modal-content">

          <div class="modal-header">

          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

          <h3 class="modal-title" id="myModalLabel">Password retrieval<br /></h3>Please enter your email address before closing this window.
          </div>

          <div id="details" class="modal-body">	

        	<form id = "details_form"><input id = "email_add" type="email_add" class="form-control" placeholder="Enter Email address" required autofocus></form>

            </div>

            <div  id="modal-footer" class="modal-footer">

        	<div id='err'></div><button class="btn btn-primary" id="submit">Submit</button>

          <button class="btn btn-danger" data-dismiss="modal" aria-hidden="true" id="cancel">Cancel</button>

          </div>

         </div>

        </div>

      <script src="<?php echo base_url();?>assets/js/jquery-2.1.0.min.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
      <script src="<?php echo base_url();?>assets/js/bootbox.min.js"></script>

<script type="text/javascript">
    
      $("#login_form").keypress(function(event){
        if(event.keyCode == 13){
          event.preventDefault();
          $("#sign_in").click();
        }
      });
      
      $("#sign_in").click( function(){

        email_add = $("#login_form").find("input[name='email_add']").val();
        password = $("#login_form").find("input[name='password']").val();

        $.ajax({
          url: "<?php echo site_url('distributor/check_dist'); ?>", //this will check if the admin is found at DB
          type: "POST",
          dataType: "html",
          data: { email_add: email_add, password: password },

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
              window.location.href = "<?php echo site_url();?>/dist/dist_index";
            }
          }
        });
      });

    </script>

    <script type="text/javascript">
      function displayError(message){
        var finmessage;
        if(message == 'verified'){
          $("#verified").addClass("alert alert-success");
          $("#verified").show();
          $("#verified").html("Your account is successfully activated.");
          $("#verified").fadeIn('slow');
        }
        else{
          if(message == 'done') finmessage = "Your account is already activated.";
          else if(message =='dne') finmessage = "Your account does not exist.";
          else if(message = 'dnm') finmessage = "Password does not match email address.";
          $("#verfied").hide();
          $("#failed").addClass("alert alert-danger");
          $("#failed").show();
          $("#failed").html(finmessage);
          $("#failed").fadeIn('slow');
          setTimeout(function() { $('#failed').fadeOut('slow') }, 5000);
        }
      };


  /*function showBootBox(){
       bootbox.dialog({
          message: "Your account is <strong>not yet activated</strong>.",
          title: "Account Deactivated",
      onEscape: function() {},
          buttons:{
            yes:{
            label: "Resend verification.",
            className: "btn-primary",
            callback: function() {
              //title: "Verification sent."
              //message: "Verification has been resent to your email."

              var email = <?php //echo "'$email'"; ?>;
              var password = <?php //echo "'$password'"; ?>;
              $.ajax({
            type: "POST",
            url: "<?php //echo site_url('borrower/resend_mail');?>",
            data: {email: email, 
                idnumber: idnumber,
                password: password},
                
            beforeSend: function() {
              $("#verfied").show();
              $("#verified").html("<center><img src='<?php //echo base_url();?>assets/images/ajax-loader.gif' /></center>");
            },
            success: function(result)
            {
              if(result == "sent"){
                $("#verified").addClass("alert alert-success"); 
                $("#verified").html("Verification has been sent to your email.");
                $("#verified").fadeIn('slow');
              }
              else{
                $("#verified").hide();
                $("#failed").addClass("alert alert-danger");
                $("#failed").show();
                $("#failed").html("Connection error. Please try again.");
                $("#failed").fadeIn('slow');
              }
            },
            error: function()
            {
              $("#failed").addClass("alert alert-danger");
              $("#failed").show();
              $("#failed").html("An error has occured. Please try again.");
              $("#failed").fadeIn('slow');
            }
        });
            }
            },
            no: {
            label: "Cancel",
            className: "btn-default"
            }
           }
        });

  };*/

/* $(document).ready(function(){   
  var flag = 0;
  var email;
  var verf_code;

  $('#forgot').on('hidden.bs.modal',function(e){
    flag=0;
    $("#details").replaceWith('<div id="details" class="modal-body"><input id="email_add" type="email_add" class="form-control" placeholder="Enter Email address" required autofocus>');
    $("#err").hide();
  });


  $("#submit").click(function(){
        if(flag ==0){

        //email verification
      email = $("#email").val();
      $.ajax({
        type: "POST",
        url: "<?php //echo site_url('borrower/forgot_password');?>",
        data: {'email_add':email,
             'action': 'verify_email'
            },
        dataType: "JSON",
    beforeSend: function (){
      $("#err").removeClass('alert alert-danger');
      $("#err").html("<img src='<?php// echo base_url();?>assets/images/ajax-loader.gif' />");
    },    
        success: function(data) 
        {
            if(data.stat == 'success')
            {
        $("#err").html("");
              $("#details").html('<b>'+data.message+'.</b><br><br><form id = "details_form"><input id = "code_input" type="email_add" class="form-control" placeholder="Enter verification code" required autofocus></form> ');
              verf_code = data.verf_code;
              flag = 1;
            }
      else if(data.stat =='failed')
      {
        $("#err").show();
        $("#err").addClass('alert alert-danger');
        $("#err").html(data.message);
        flag = 0;
      }
            else
            {
        $("#err").show();
        $("#err").addClass('alert alert-danger');
        $("#err").html(data.message);
        flag = 0;
                
            }
        },
        error: function(xhr, data, errorThrown)
        { 
      
      $("#err").show();
      $("#err").addClass('alert alert-danger');
      $("#err").html("An error occurred.");
        }

      });
    }

   else if(flag == 1)
    {  //code verification
      var code_input = $("#code_input").val();
        $.ajax({
          url:"<?php //echo site_url('borrower/forgot_password');?>",
          type: "POST",
          data: {'code_input':code_input,
              'verf_code': verf_code,
              'action': 'verify_code'
              },
          dataType: "JSON",
      beforeSend: function (){
      $("#err").removeClass('alert alert-danger');
      $("#err").html("<img src='<?php //echo base_url();?>assets/images/ajax-loader.gif' />");
      },
          success: function(data)
          {
              if(data.stat == 'success')
              {
        $("#err").html("");
                $("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
                flag = 2; 
              }
              else
              {
        $("#err").show();
        $("#err").addClass('alert alert-danger');
        $("#err").html("Code denied.");
                $("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "code_input" class="form-control" placeholder="Enter verification code" required autofocus></form>');
                flag = 1;
              }
          },

          error: function()
          {
            $("#err").show();
      $("#err").addClass('alert alert-danger');
      $("#err").html("An error has occured.");
          }

        });
        
    }

    else if(flag == 2){ //change password
      var new_password = $("#new_password").val();
      var retype_new_pw = $("#retype_new_pw").val();
      
        if(new_password == retype_new_pw)
        {
    
    if( new_password.length > 6){
    
        $.ajax({
        url: "<?php //echo site_url('borrower/forgot_password');?>",
        type: "POST",
        data: {'new_password': new_password,
          'retype_new_pw': retype_new_pw,
          'email_add': email,
          'action': 'change_pw'

        },
        dataType: "JSON",
        beforeSend: function (){
        $("#err").removeClass('alert alert-danger');
        $("#err").html("<img src='<?php// echo base_url();?>assets/images/ajax-loader.gif' />");
        },    
        success: function(data)
        {
          if(data.stat == 'success')
          {$("#err").html("");
            $('#details').html('<b>'+data.message+'</b>');
            $("#modal-footer").html('<button class="btn btn-primary" data-dismiss="modal" aria-hidden="true" id="done">Done</button>'); 
          }
          else
          {$("#err").html("");
            $("#details").html('<b>'+data.message+'</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
            flag = 2;
          }
        },
        error: function()
        {
          $("#err").show();
          $("#err").addClass('alert alert-danger');
          $("#err").html("An error has occured.");
        }
        });
      }
    //password <6 character
    else{
      $("#err").show();
      $("#err").addClass('alert alert-danger');
      $("#err").html("Invalid password.");
      $("#details").html('<b>Password must be at least 6 characters</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
      flag = 2;
    }
      
        }
    //password don't match
        else
        {
      $("#err").show();
      $("#err").addClass('alert alert-danger');
      $("#err").html("Invalid password.");
      $("#details").html('<b>Passwords must match</b><br><br><form id = "details_form"><input id = "new_password" type="password" class="form-control" placeholder="New Password" required><br><input id = "retype_new_pw" type="password" class="form-control" placeholder="Verify New Password" required></form>');
      flag = 2;
        }
    }
  });
 });*/
</script>

  <?php
    if($message != 'null' || !isset($message)){
      if($message == 'verified'){
        echo "<script type='text/javascript'>displayError(";
        echo "'verified'";
        echo ")</script>";
      }else if($message == 'done' || $message =='dne' ||  $message =='dnm'){
        echo "<script type='text/javascript'>displayError(";
        echo "'$message'";
        echo ")</script>";
      }
      else if($message=='deactivated'){
        echo "<script type='text/javascript'>showBootBox()";
        echo "</script>";
      }
    }
  ?>
<?php include 'footer.php'; ?>