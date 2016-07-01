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
                

            <div class="row">
                <!-- center left-->
                <div class="col-md-6">

                    <!--tabs-->
                    <div class="panel">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#released_orders" data-toggle="tab">Released Orders</a></li>
                            <li><a href="#unreleased_orders" data-toggle="tab">Unreleased Orders</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active well" id="released_orders">
                            <?php 
                            	if(count($r_5) == 0) echo "No released orders.";
                            	else{
                            	foreach ($r_5 as $q) {
	                               echo "<p><b>Order #";
	                               echo $q->order_id;
	                               echo"</b>";
	                               echo " (released last " . $q->release_date . ")</p>";
                           		}
                            }?>
                            </div>
                            <div class="tab-pane well" id="unreleased_orders">
                                <?php 
                                	if(count($unr_5) == 0) echo "No unreleased orders.";
                                	else{
                                	foreach ($unr_5 as $q) {
		                               echo "<p><b>Order #";
		                               echo $q->order_id;
		                               echo"</b>";
		                               echo " (ordered last " . $q->order_date . ")</p>";
		                           }
                            	}?>
                            </div>
                        </div>

                    </div>
                    <!--/tabs-->

                </div>
                <!--/col-->

            </div>
            <!--/row-->


        </div>
        <!--/col-span-9-->
    </div>
</div>
<!-- /Main -->

<?php include 'footer.php'; ?>