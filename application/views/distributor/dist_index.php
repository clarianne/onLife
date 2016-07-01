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
                        <li class="active"><a href="<?php echo site_url(); ?>/dist/dist_index">Home</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/shop">Store</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/cart">Cart</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/checkout">Checkout</a></li>
                        <li><a href="<?php echo site_url(); ?>/dist/contact">Contact</a></li>
                    </ul>
                </div>  
            </div>
        </div>
    </div> <!-- End mainmenu area -->
    
    <div class="slider-area">
          <!-- Slider -->
      <div class="block-slider block-slider4">
        <ul class="" id="bxslider-home4">
          <li>
            <img src="<?php echo base_url();?>assets/img/products/P01.jpg" alt="Slide">
          </li>
          <li><img src="<?php echo base_url();?>assets/img/products/P02.jpg" alt="Slide">
          </li>
        </ul>
      </div>
      <!-- ./Slider -->
    </div> <!-- End slider area -->
    
    
    
    <div class="maincontent-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title">Featured Products</h2>
                        <div class="product-carousel">
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
    </div> <!-- End main content area -->
    
<?php include 'footer.php'; ?>