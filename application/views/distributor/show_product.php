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
    
    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2><?php echo $update_details->prod_name; ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form method="post" role="form">
                                          
                        <input type="text" name="search"  size="80"/>
                        <input class = "btn btn-primary" type="submit" value="Search" name="search_products"/> 
                                           
                        </form>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="<?php echo site_url(); ?>/dist/dist_index">Home</a>
                            <a href="<?php echo site_url(); ?>/dist/shop">onLife Store</a>
                            <a href=""><?php echo $update_details->prod_name; ?></a>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                    <?php
                                        echo "<img src='";
                                        echo base_url() . "assets/img/products/" . $update_details->product_code .".jpg' alt = ''>";
                                    ?>


                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $update_details->prod_name; ?></h2>
                                    <div class="product-inner-price">
                                        <ins>Distributor's Price: Php <?php echo $update_details->dist_price; ?></ins><br>
                                        <ins>Retail Price: Php <?php echo $update_details->ret_price; ?></ins>
                                    </div>    
                                    
                                    <form method='post' name='display' action = 'add_to_cart' class='cart'>
                                        <div class="quantity">
                                            <input type='hidden' name='product_code' value='<?php echo $update_details->product_code; ?>'/>
                                            <input type='hidden' name='prod_name' value='<?php echo $update_details->prod_name; ?>'/>
                                            <input type='hidden' name='dist_price' value='<?php echo $update_details->dist_price; ?>'/>
                                            <input type="number" size="4" class="input-text qty text" title="Qty" value="1" name="quantity" min="1" step="1">
                                            
                                        </div>
                                        <button type='submit' class='btn btn-primary' name='display'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Show'>Add to Cart</a></button>
                                        </form>
                                    
                                    <div class="product-inner-category">
                                        <p>Category:<b> <?php echo $update_details->prod_category; ?></b></p>
                                    </div> 
                                    
                                    <div role="tabpanel">

                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>  
                                                <p><?php echo $update_details->prod_desc; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Other Products</h2>
                            <div class="related-products-carousel">
                            <?php
                                foreach ($sql2 as $q){
                                    echo "<div class='single-product'>";
                                    echo "<div class='product-f-image'>";
                                    echo "<img src='";
                                    echo base_url() . "assets/img/products/" . $q->product_code .".jpg' alt = ''>";

                                    echo "<form method='post' name='display' action='show_product'>";
                                    echo "<input type='hidden' name='product_code' value='" . $q->product_code . "'/>";
                                    echo "</div>";

                                    echo "<button type='submit' class='updateButton prod_name' name='display'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Show'>" . $q->prod_name . "</a></button></form>";

                                    echo "<div class='product-carousel-price'>";
                                    echo " <ins>DP: Php ";
                                    echo $q->dist_price;
                                    echo "</ins><br>";
                                    echo "<ins>SRP: Php ";
                                    echo $q->ret_price;
                                    echo "</ins>";
                                    echo "</div>";
                                    echo "</div>";
                                }
                            ?>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php' ?>