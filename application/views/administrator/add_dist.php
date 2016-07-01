<?php include 'header.php'; ?>


<?php include 'admin_header.php'; ?>

<!-- Main -->
<div class="container-fluid">
    <div class="row">
            <?php include 'admin_sidebar.php'; ?>
        </div>

        <div class="col-lg-9">
            <div id="main-page">
                <div id = "main-content">
                    <div id="container">
                        <form name="add" id="add" method="post" class="form-horizontal">
                            <h2> Add New Distributor </h2>
                            <ol class="breadcrumb">
                                <li><a href="<?php echo site_url(); ?>/admin/dashboard">Admin Dashboard</a></li>
                                <li class="active"> Add New Distributor </li>
                            </ol>
                            <div class="alert-container" style = 'height: 40px; margin-bottom: 19px;'>
                                    <div style="display:none" id="success_add" class = "alert alert-success"></div>
                                    <div style="display:none" id="fail_add" class = "alert alert-danger"></div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">LFSI ID</label>
                                <label id="preclass" name="preclass" class="col-sm-1 control-label">D0-</label>
                                <div class="col-sm-2">
                                    <input type="text" maxlength="7" class="form-control" id="lfsiid" placeholder="1234567" name="lfsiid" pattern="[0-9]+" required>
                                </div>
                                <span style="color: red;" id="helplfsiid" name="helplfsiid"></span>
                            </div>

                            <div id="fname_div" class="form-group" style='display:block'>
                                <label for="fname" class="col-sm-2 control-label">Given Name / Company Name</label>
                                <div class="col-sm-4">
                                    <input type="text" maxlength="20" class="form-control"  name="fname" id="fname" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" placeholder="Given Name / Company Name" required/>
                                </div>
                                <span style="color: red;" id="helpfname" name="helpfname">
                            </div>

                            <div id="lname_div" class="form-group" style='display:block'>
                                <label for="lname" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-4">
                                    <input type="text" maxlength="20" class="form-control"  name="lname" id="lname" pattern="[A-Z][A-Za-z]+" placeholder="Last Name"/>
                                    <p><em>* Can be omitted if distributor is a company</em></p>
                                </div>
                                <span style="color: red;" id="helplname" name="helplname">
                            </div>

                            <div class="form-group">
								<label for="address" class="col-sm-2 control-label">Address</label>
								<div class="col-sm-4">
									<textarea type="text" name="address" class="form-control" id="address" placeholder="Address" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="3" cols="75"></textarea>
								</div>
								<span style="color: red;" name="helpaddress">
							</div>

                            <div class="form-group"><br />
                                <label for="contact_num" class="col-sm-2 control-label">Contact Number</label>
                                <div class="form-inline col-sm-2">
                                    <input type="text" maxlength="20" class="form-control"  name="contactnum" id="contactnum" pattern="[0-9]+" placeholder="Contact Number" required />
                                </div>
                                <span style="color: red;" name="helpcontactnum">
                            </div>

                            <div class="form-group"><br />
								<div class="col-sm-offset-2 col-sm-10">
									<button onclick="addDetails()" class="btn btn-primary" id="addButton" name="add">Add</button>
								</div>
							</div>


                        <br>        
                    </div>
                </div>
            </div>
        </div>
</div>

<!-- Start of validation script -->

<script>
        $('#add-nav').addClass('active');
            function finalcheckofadd() {
                if (validateLFSIID)
                bootbox.dialog({
                    message: "Confirm details of this distributor?",
                    title: "Confirmation",
                    buttons: {
                            yes: {
                            label: "Yes",
                            className: "btn-primary",
                            callback: function() {
                                                            
                                var preclass = document.getElementById("preclass").innerHTML;
                                var lfsiid = preclass + add.lfsiid.value;
                                var fname = add.fname.value;
                                var lname = add.lname.value;
                                var address = add.address.value;
                                var contact_num = add.contactnum.value;
                                var dist_status = "ACTIVATED";
                                                            
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url();?>/admin/dist_add_execution",
                                    data: { lfsiid : lfsiid,
                                            fname : fname,
                                            lname : lname,
                                            address : address,
                                            contact_num : contact_num,
                                            dist_status : dist_status;
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

                var preclass = document.getElementsByName('preclass')[0].innerHTML;
                var lfsiid = add.lfsiid.value;

                $.ajax({
                    url: "<?php echo site_url();?>/admin/check_lfsiid",
                    type: "POST",
                    data: { preclass: preclass, lfsiid : lfsiid},
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



<?php include 'footer.php'; ?>

