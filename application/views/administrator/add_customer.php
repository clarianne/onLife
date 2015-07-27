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
                                <li><a href="<?php echo site_url(); ?>/admin/dashboard">Home</a></li>
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
                                    <input type="text" maxlength="7" class="form-control" id="materialid" placeholder="1234567" name="materialid" pattern="[A-Za-z0-9]+" required>
                                </div>
                                <span style="color: red;" id="helplfsiid" name="helplfsiid"></span>
                            </div>
                            <div id="isbn_div" class="form-group" style='display:block'>
                                <label for="type" class="col-sm-2 control-label">First Name / Company Name</label>
                                <div class="col-sm-4">
                                    <input type="text" maxlength="20" class="form-control"  name="isbn" id="isbn" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" placeholder="First Name / Company Name" required/>
                                </div>
                                <span style="color: red;" id="helpfname" name="helpfname">
                            </div>
                            <div id="isbn_div" class="form-group" style='display:block'>
                                <label for="type" class="col-sm-2 control-label">Last Name</label>
                                <div class="col-sm-3">
                                    <input type="text" maxlength="20" class="form-control"  name="isbn" id="isbn" pattern="[A-Z][A-Za-z]+" placeholder="Last Name"/>
                                </div>
                                <span style="color: red;" id="helplname" name="helplname">
                            </div>

                            <div class="form-group">
								<label for="title" class="col-sm-2 control-label">Address</label>
								<div class="col-sm-4">
									<textarea type="text" name="name" class="form-control" id="title" placeholder="Title" pattern="[A-Z][A-Za-z0-9\ \.\,\-\'\?\!]+" required rows="2" cols="50"></textarea>
								</div>
								<span style="color: red;" name="helpaddress">
							</div>
                            <div class="form-group"><br />
                                <label for="year" class="col-sm-2 control-label">Contact Number</label>
                                <div class="form-inline col-sm-2">
                                    <input type="text" maxlength="20" class="form-control"  name="contactnum" id="contactnum" pattern="[0-9]+" placeholder="Contact Number" required />
                                </div>
                                <span style="color: red;" name="helpcontactnum">
                            </div>
                            <div id="edvol_div" class="form-group"><br />
                                <label for="ed" class="col-sm-2 control-label">Email Address</label>
                                <div class="form-inline col-sm-2">
                                    <input type="text" name="email" class="form-control" id="emailadd" placeholder="someone@example.com" pattern="^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$">
                                </div>
                                <span style="color: red;" name="helpemail">
                            </div>
                            </form>

                            <div class="form-group"><br />
								<div class="col-sm-offset-2 col-sm-10">
									<button onclick="addDetails()" class="btn btn-primary" id="addButton" name="add">Add</button>
									<!--<a href="<?php echo site_url();?>/admin/add_multiple"><button type="button" class="btn btn-default">Add Multiple Material</button></a>-->
								</div>
							</div>


                        <br>        
                    </div>
                </div>
            </div>
        </div>
</div>



<?php include 'footer.php'; ?>

