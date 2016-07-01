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
                            <h2> Order Details: </h2>
                            <h4><?php echo "Order #" . $update_details->order_id; ?></h4> 
                            <ol class="breadcrumb">
                                <li><a href="<?php echo base_url()?>admin/home">Home</a></li>
                                <li class="active"> Order Details (Unreleased) </li>
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
                                <label class="col-sm-2 control-label">Order ID</label>
                                <label id="preclass" name="preclass" class="col-sm-2 control-label"><?php echo $update_details->order_id; ?></label>
                                <div class="col-sm-2">
                                    <input type="hidden" id="order_id" name="order_id" value="<?php echo $update_details->order_id;?>">
                                </div>
                                <span style="color: red;" id="order_id" name="helporder_id"></span>
                            </div>

                            <div class="form-group">
                                <label for="prod_name" class="col-sm-2 control-label">Order Date</label>
                                
                                <div class="col-sm-4">
                                    <label for="prod_name" class="col-sm-2 control-label"><?php echo $update_details->order_date;?></label>
                                </div>
                                <span style="color: red;" name="helpprod_name">
                            </div>

                            <div class="form-group"><br />
                                    <label class="col-sm-2 control-label">Products Purchased</label>
                                    <div class="form-inline col-sm-6">
                                        <span style='color: red;' name='helpprod'></span>
                                        <table id="formTable">
                                        <?php
                                            $num_products = count($update_details->product);
                                            for ($i=0; $i<$num_products; $i++){
                                                echo "<tr>";
                                                echo "<td><input type='text' name='fname' value='{$update_details->product[$i]->product_code}' class='form-control' disabled/></td>";
                                                echo "<td><input type='text'  name='mname' value='{$update_details->product[$i]->prod_name}' class='form-control' disabled/></td>";
                                                echo "<td><input type='text'  name='lname' value='{$update_details->product[$i]->dist_price}' class='form-control' disabled/></td>";
                                                echo "<td><input type='text'  name='lname' value='{$update_details->product[$i]->quantity}' class='form-control' disabled/></td>";
                                                echo "<td><input type='text'  name='lname' value='{$update_details->product[$i]->item_price}' class='form-control' disabled/></td>";
                                                //if ($i==0) echo " disabled ";
                                                //echo "></td>";
                                                echo "<td><input type='hidden' name='numberOfProducts' value='{$num_products}'/></td>";
                                                echo "</tr>";
                                            }
                                        ?>
                                        </table>
                                    </div>
                                </div>

                            <div class="form-group">
                                <label for="order_total" class="col-sm-2 control-label">Order Total</label>
                                
                                <div class="col-sm-4">
                                    <label for="order_total" class="col-sm-2 control-label"><?php echo $update_details->order_total;?></label>
                                </div>
                            </div>

                            <div class="form-group">
                                   <input type="hidden" id="status" name="status" value="RELEASED">
                                </div>
                            </div>

                            
                                
                                </form>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10"><br />

                                    <a href="<?php echo site_url()?>/dist/unreleased"><button type="button" class="btn btn-default">Go back</button></a>
                                </div>
                            </div>
                            <br>
                        </div>  
                        </div>  
                    </div>  
                </div>  
            </div>
            </div>

<?php include 'footer.php'; ?>