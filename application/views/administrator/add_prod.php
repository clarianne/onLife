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
                        <form name="add" id="add" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <h2> Add New Product </h2>

                            <ol class="breadcrumb">
                                <li><a href="<?php echo site_url(); ?>/admin/dashboard">Admin Dashboard</a></li>
                                <li class="active"> Add New Product </li>
                            </ol>

                            <p>All fields are required. If the data for the dimensions and weight are not available, leave it as "0".</p>
                            <div class="alert-container" style = 'height: 40px; margin-bottom: 19px;'>
                                    <div style="display:none" id="success_add" class = "alert alert-success"></div>
                                    <div style="display:none" id="fail_add" class = "alert alert-danger"></div>
                            </div> 
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Product Code</label>
                                <div class="col-sm-2">
                                    <input type="text" maxlength="12" class="form-control" id="prod_id" placeholder="PRODCODE" name="product_code" pattern="[A-Za-z0-9]+" required>
                                </div>
                                <span style="color: red;" id="product_code" name="helpproduct_code"></span>
                            </div>

                            <div class="form-group">
                                <label for="prod_name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-4">
                                    <textarea type="text" name="prod_name" class="form-control" id="title" placeholder="Product Name" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="2" cols="50"></textarea>
                                </div>
                                <span style="color: red;" name="helpprod_name">
                            </div>

                            <div class="form-group">
                                <label for="prod_category" class="col-sm-2 control-label">Category</label>
                                <div class="col-sm-3">
                                    <select name="prod_category" id="type" class="form-control" >
                                        <option value="Health Care" >Health Care</option>
                                        <option value="Life Synergy Health Care">Life Synergy Health Care</option>
                                        <option value="Life Synergy U Beauty Care">Life Synergy U Beauty Care</option>
                                        <option value="Materials">Materials</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="dist_price" class="col-sm-2 control-label">Distributor's Price</label>
                                <div class="form-inline col-sm-3">
                                    <div class="input-group">
                                      <span class="input-group-addon">Php</span>
                                      <input type="number" maxlength="6" class="form-control"  name="dist_price" id="dist_price" pattern="[0-9]+" value="0" required>
                                      <span class="input-group-addon" id="dist_price_zero">.00</span>
                                    </div>
                                </div>
                                <span style="color: red;" name="helpedvol">
                            </div>

                            <div class="form-group">
                                <label for="ret_price" class="col-sm-2 control-label">SRP</label>
                                <div class="form-inline col-sm-3">
                                    <div class="input-group">
                                      <span class="input-group-addon">Php</span>
                                      <input type="number" maxlength="6" class="form-control"  name="ret_price" id="ret_price" pattern="[0-9]+" value="0" required>
                                      <span class="input-group-addon" id="ret_price_zero">.00</span>
                                    </div>
                                </div>
                                <span style="color: red;" name="helpedvol">
                            </div>

                            <div class="form-group">
                                <label for="prod_desc" class="col-sm-2 control-label">Description</label>
                                <div class="col-sm-5">
                                    <textarea type="text" name="prod_desc" class="form-control" id="prod_desc" placeholder="Describe the product in less than 100 words" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="4" cols="50"></textarea>
                                </div>
                                <span style="color: red;" name="helpname">
                            </div>

                            <div class="form-group">
                                <label for="length" class="col-sm-2 control-label">Length</label>
                                <div class="form-inline col-sm-2">
                                    <div class="input-group">
                                         <input type="text" maxlength="6" class="form-control"  name="length_prod" id="length_prod" pattern="[0-9]+\.[0-9]+" value="0" required>
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="width" class="col-sm-2 control-label">Width</label>
                                <div class="form-inline col-sm-2">
                                    <div class="input-group">
                                        <input type="text" maxlength="6" class="form-control"  name="width_prod" id="width_prod" pattern="[0-9]+\.[0-9]+" value="0" required>
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="height" class="col-sm-2 control-label">Height</label>
                                <div class="form-inline col-sm-2">
                                    <div class="input-group">
                                        <input type="text" maxlength="6" class="form-control" name="height_prod" id="height_prod" pattern="[0-9]+\.[0-9]+" value="0" required>
                                        <span class="input-group-addon">cm</span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="weight" class="col-sm-2 control-label">Weight</label>
                                <div class="form-inline col-sm-2">
                                    <div class="input-group">
                                        <input type="text" maxlength="6" class="form-control" name="weight" id="weight" pattern="[0-9]+\.[0-9]+" value="0" required>
                                        <span class="input-group-addon">kg</span>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="form-group">
                                <label for="imgurl" class="col-sm-2 control-label">Upload Photo</label>
                                <div class="form-inline col-sm-3">
                                    <input type="file" name="imgurl" id="imgurl">
                                </div>
                            </div>-->
 
                            </form> 
                            <div class="form-group"><br />
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button onclick="addDetails()" class="btn btn-primary" id="addButton" name="add">Add</button>
                                   <!-- <a href="<?php echo site_url();?>/admin/add_multiple"><button type="button" class="btn btn-default">Add Multiple Material</button></a>-->
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
                if (validateProdId)
                bootbox.dialog({
                    message: "Are you sure to add this product?",
                    title: "Confirmation",
                    buttons: {
                            yes: {
                            label: "Add",
                            className: "btn-primary",
                            callback: function() {
                                                            
                                //var preclass = document.getElementById("preclass").innerHTML;
                                var product_code = add.product_code.value;
                                var prod_name = add.prod_name.value;
                                var prod_category = add.prod_category.value;
                                var dist_price_zero = document.getElementById("dist_price_zero").innerHTML;
                                var dist_price = add.dist_price.value + dist_price_zero;
                                var ret_price_zero = document.getElementById("ret_price_zero").innerHTML;
                                var ret_price = add.ret_price.value + ret_price_zero;
                                var prod_desc = add.prod_desc.value;
                                var length = add.length_prod.value;
                                var width = add.width_prod.value;
                                var height = add.height_prod.value;
                                var weight = add.weight.value;
                                var imgurl = "";
                                                            
                                $.ajax({
                                    type: "POST",
                                    url: "<?php echo site_url();?>/admin/prod_add_execution",
                                    data: { product_code : product_code,
                                            prod_name : prod_name,
                                            prod_category : prod_category,
                                            dist_price : dist_price,
                                            ret_price : ret_price,
                                            prod_desc : prod_desc,
                                            length : length,
                                            width : width,
                                            height : height,
                                            weight : weight,
                                            imgurl : imgurl,
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
                                            $("#success_add").html("Product successfully added to the database!");
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
                                label: "Cancel",
                                className: "btn-default"
                            }
                        }
                    });
                else showError();
            }

            function showError(){
                $("#success_add").hide();
                $("#fail_add").show();
                $("#fail_add").html("Some product data are not valid!");
                $("#fail_add").fadeIn('slow');
                document.body.scrollTop = document.documentElement.scrollTop = 0;
            }

            function addDetails(){

               // preclass = document.getElementsByName('preclass')[0].innerHTML;
                product_code = add.product_code.value;
                //type = add.type.value;

                $.ajax({
                    url: "<?php echo site_url();?>/admin/check_product_code",
                    type: "GET",
                    data: { product_code : product_code },
                    success: function (result){
                        if ($.trim(result) == '1'){

                            $('#helpproduct_code').html("");

                            finalcheckofadd();
                        }
                        else if ($.trim(result) == '2') {
                            $('#helpproduct_code').html("Product ID already exists.");
                            showError();
                        }
                        else if ($.trim(result) == '3') {
                            $('#helpproduct_code').html("Invalid Product ID.");
                            showError();
                        }
                    }
                });
            }
                
                /*window.onload = function() {
                    add.lfsiid.onblur = validateLFSIID;
                    $('#container1').modal('hide');
                }*/
                

                function validateProdId(){
                    
                   // preclass = document.getElementsByName('preclass')[0].innerHTML;
                    product_code = add.product_code.value;
                
                    $.ajax({
                        url: "<?php echo site_url();?>/admin/check_product_code",
                        type: "POST",
                        data: { product_code : product_code },
                        success: function (result){
                            if ($.trim(result) == '1'){
                                $('#helpproduct_code').html("");
                                return true;
                            }
                            else if ($.trim(result) == '2') {
                                $('#helpproduct_code').html("Product ID already exists.");
                                return false;
                            }
                            else if ($.trim(result) == '3') {
                                $('#helpproduct_code').html("Invalid Product ID.");
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