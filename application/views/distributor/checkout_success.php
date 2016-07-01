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
                        <li class="active"><a href="<?php echo site_url(); ?>/dist/checkout">Checkout</a></li>
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
                        <h2>Checkout Success!</h2>
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
                    </div>
                    
                   
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">

                        <p> Your order has been placed! Check your profile <a href="<?php echo site_url(); ?>/dist/profile">here</a>.
                        <p><a href="<?php echo site_url(); ?>/dist/shop">Go back to the Store</a></p>                  
                    </div>                    
                </div>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>