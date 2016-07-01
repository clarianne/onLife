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
                        <li class="active"><a href="<?php echo site_url(); ?>/dist/shop">Store</a></li>
                        <!--<li><a href="single-product.html">Single product</a></li>-->
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
                        <h2>onLife Store</h2>
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
                        <div class="product-breadcrumb">
                            <a href="<?php echo site_url(); ?>/dist/dist_index">Home</a>
                            <a href="">onLife Store</a>
                        </div>
                        

                        <?php
                        echo "<div class='row'>";
                                if(count($flag)==0){
                                    echo "<tbody>";
                                    echo "<td colspan = '7' class = 'nolibmat' style='background-color:rgba(0,0,0,0.1); color: black;'><center>No product found.</center></td>";
                                    echo "</tbody>";
                                }else{ 
                                    foreach ($sql2 as $q){

                                                echo "<div class='col-md-3 col-sm-6'>";
                                                echo "<div class='single-shop-product'>";
                                                echo "<div class='product-upper'>";
                                                echo "<img src='";
                                                echo base_url() . "assets/img/products/" . $q->product_code .".jpg' alt = ''>";
                                                echo "</div>";

                                                echo "<form method='post' name='display' action='show_product'>";
                                                echo "<input type='hidden' name='product_code' value='" . $q->product_code . "'/>";
                                                echo "<button type='submit' class='updateButton prod_name' name='display'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Show'>" . $q->prod_name . "</a></button></form>";

                                                echo "<div class='product-carousel-price'>";
                                                echo "<ins>" . $q->dist_price . "</ins>";
                                                echo "</div>";
                                                        
                                                echo "<div class='product-option-shop'>";
                                                echo "<form method='post' name='display' action='add_to_cart'>";
                                                echo "<input type='hidden' name='product_code' value='" . $q->product_code . "'/>";
                                                echo "<input type='hidden' name='prod_name' value='" . $q->prod_name . "'/>";
                                                echo "<input type='hidden' name='dist_price' value='" . $q->dist_price . "'/>";
                                                echo "<input type='hidden' name='quantity' value='1'/>";
                                                echo "<button type='submit' class='updateButton prod_name' name='display'><a data-toggle='tooltip' class='tooltipLink' data-original-title='Show'>Add to Cart</a></button></form>";
                                                echo "</div>";
                                                echo "</div>";
                                                echo "</div>";
                                                }
                                            echo "</div>";  
                                            }

                                    
                         ?>
                        </div>
                    </div>
                </div>                    
            </div>



                
            </div>
            </div>
            
            <div class="row">
                <!--<div class="col-md-12">
                    <div class="product-pagination text-center">
                        <nav>
                          <ul class="pagination">
                            <li>
                              <a href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                              </a>
                            </li>
                            <li><a href="#">1</a></li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#">5</a></li>
                            <li>
                              <a href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                              </a>
                            </li>
                          </ul>
                        </nav>                        
                    </div>
                </div>
            </div>-->
        </div>
    </div>


<?php include 'footer.php' ?>