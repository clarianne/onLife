<?php include 'header.php'; ?>
<?php include 'dist_header.php'; ?>  

<div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div> 
                <div class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                       <li><a href="<?php echo site_url(); ?>/dist/dist_index">Home</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/shop">Store</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/cart">Cart</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/checkout">Checkout</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/contact">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->


<div class="container-fluid">
    <div class="row">
            <?php include 'dist_sidebar.php'; ?>
                

            <div class="col-lg-9">
                <div id="main-page">
                    <div id = "main-content">
                    <div id="container">
                    <form name="update" id="update" class="form-horizontal" method="post">
                            <h2> Update Billing Information: </h2>
                            <h4><?php echo $info->fname . " " . $info->lname; ?></h4> 
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url()?>dist/profile">Profile</a></li>
                                <li class="active"> Update Billing Information </li>
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

                                <input type="hidden" id="lfsi_id" name="lfsi_id" value="<?php echo $info->lfsi_id;?>">
                                <div class="form-group">
                                <label for="address" class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-4">
                                    <textarea type="text" name="address" class="form-control" id="address" placeholder="Address" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="3" cols="75"><?php echo $info->address;?></textarea>
                                </div>
                                <span style="color: red;" name="helpaddress">
                                </div>

                                <div class="form-group"><br />
                                    <label for="contact_num" class="col-sm-2 control-label">Contact Number</label>
                                    <div class="form-inline col-sm-2">
                                        <input type="text" maxlength="20" class="form-control" value="<?php echo $info->contact_num;?>"  name="contactnum" id="contactnum" pattern="[0-9]+" placeholder="Contact Number" required />
                                    </div>
                                    <span style="color: red;" name="helpcontactnum">
                                </div>
                                
                                </form>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10"><br />
                                    <button onclick="updateDetails()" class="btn btn-primary" id="updateButton" name="update">Update</button>
                                    <a href="<?php echo site_url()?>/dist/profile"><button type="button" class="btn btn-danger">Cancel</button></a>
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
            //  if (validateLFSIID())
                bootbox.dialog({
                    message: "Save changes to your billing information?",
                    title: "Confirmation",
                    buttons: {
                            yes: {
                            label: "Yes",
                            className: "btn-primary",
                            callback: function() {
                                                            
                                //var preclass = document.getElementById("preclass").innerHTML;
                                //var previous_lfsiid = update.previous_lfsiid.value;
                                var lfsi_id = update.lfsi_id.value;
                                //var fname = update.fname.value;
                                //var lname = update.lname.value;
                                var address = update.address.value;
                                var contact_num = update.contactnum.value;
                                //var dist_status = update.dist_status.value;
                                                            
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url()?>/dist/update_billing_execution",
                                    data: { //previous_lfsiid : previous_lfsiid,
                                            lfsi_id : lfsi_id,
                                           // fname : fname,
                                           // lname : lname,
                                            address : address,
                                            contact_num : contact_num,
                                            //dist_status : dist_status,
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
                                            $("#success_update").html("Billing information successfully updated!");
                                            $("#success_update").fadeIn('slow');
                                            document.body.scrollTop = document.documentElement.scrollTop = 0;
                                            setTimeout(function() { $("#success_update").html("Redirecting to Profile Page...");
                                                                    window.location.href = "<?php echo site_url()?>/dist/profile"; }, 2000);  
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
                </script>

<?php include 'footer.php'; ?>