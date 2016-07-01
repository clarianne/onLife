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
                        <li class="active"><a href="<?php echo site_url(); ?>/dist/cart">Cart</a></li>
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
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->
    
    
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
                    
                    <!--<div class="single-sidebar">
                        <div class="cross-sells">
                                <h2 class="sidebar-title">Other Products</h2>
                                <ul class="products">
                                    
                                    <?php
                                    foreach($sql2 as $q){
	                                    echo "<li class='product'>";
	                                    echo "<a href='single-product.html'>";
	                                    echo "<img width='325' height='325' class='attachment-shop_catalog wp-post-image' src='";
	                                    echo base_url() . "assets/img/product-2.jpg' alt = ''>";
	                                    echo "<h3>" . $q->prod_name . "</h3>";
	                                    echo "<span class='price'><span class='amount'>DP: Php " . $q->dist_price . "</span></span>";
	                                    echo "</a>";
	                                    echo "<a class='add_to_cart_button' data-quantity='1' data-product_sku='' data-product_id='22' rel='nofollow' href='single-product.html'>Add to Cart</a>";
	                                    echo "</li>";
	                                }
                                    ?>
                                </ul>
                            </div>
                    </div>-->
                    
                   
                </div>
                
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="woocommerce">
                        <p><i>* to delete the <u>first cart item</u>, please set <b>Quantity</b> to <b>'0'</b>.</i></p>
                            <form method="post" action="#">
                                <table cellspacing="0" class="shop_table cart">
                                    <thead>
                                        <tr>
                                            <th class="product-remove">&nbsp;</th>
                                            <th class="product-name">Product</th>
                                            <th class="product-price">Price</th>
                                            <th class="product-quantity">Quantity</th>
                                            <th class="product-subtotal">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $grand_total = 0;
                                    $shipping_fee = 360;
                                    $cart_check = $this->cart->contents();

                                    // If cart is empty, this will show below message.
                                    if(empty($cart_check)) {
                                        echo "<tr><td class ='actions' colspan='6'>Your cart is empty. Go to the <a href='";
                                        echo site_url() . "/dist/shop'>onLife Store</a> to add more items.";
                                        echo "</td></tr>";
                                    }

                                    else{
                                        $cart = $this->cart->contents();
                                        foreach ($cart as $item){
                                            echo "<tr class='cart_item'>";
                                            echo "<td class='product-remove'>";
                                            echo "<form action='remove' method='post'>";
                                            echo "<button title='Remove this item' type='submit'>x</button> ";
                                            //echo $item['rowid'];
                                            echo " <input type='hidden' name='rowid' value='";
                                            echo $item['rowid'];
                                            echo "'>";
                                            //echo "</form>";
                                            echo "</td>";
                                            echo "</form>";

                                            echo "<td class='product-name'>";
                                            echo $item['name'];
                                            echo "</td>";
                                            
                                            echo "<td class='product-price'>";
                                            echo "<span class='amount'>";
                                            echo "Php " . $item['price'];
                                            echo "</span> ";
                                            echo "</td>";

                                            echo "<form method='post' name='display' action = 'update_cart' class='cart'>";
                                            echo " <input type='hidden' name='rowid' value='";
                                            echo $item['rowid'];
                                            echo "'>";
                                            echo "<td class='product-quantity'>";
                                            echo "<div class='quantity buttons_added'>";
                                            echo "<input type='number' size='4' name = 'quantity' class='input-text qty text' title='Qty' value='";
                                            echo $item['qty'];
                                            echo "' min='0' step='1'>";
                                            echo "</div>";
                                            echo "</td>";

                                            echo "<td class='product-subtotal'>";
                                            echo "<span class='amount'>";
                                            echo "Php " . $item['subtotal'];
                                            echo "</span> ";
                                            echo "</td>";
                                            echo "</tr>";
                                            
                                            

                                            $grand_total = $grand_total + $item['subtotal'];
                                        }

                                        echo "<tr>";
                                        echo "<td class='actions' colspan='5'>";
                                        echo "<input type='submit' value='Update Cart' name='update_cart' class='button'>";
                                        echo "</form>";
                                        echo "</td>";
                                        
                                        echo "</tr>";

                                    }
                                    ?>
                                     
                                    </tbody>
                                </table>
                            </form>

                            <div class="cart-collaterals">


                            <div class="cart_totals ">
                                <h2>Cart Totals</h2>

                                <table cellspacing="0">
                                    <tbody>
                                        <tr class="cart-subtotal">
                                            <th>Cart Subtotal</th>
                                            <td><span class="amount"><?php echo "Php " . $grand_total;?></span></td>
                                        </tr>

                                        <tr class="shipping">
                                            <th>Shipping and Handling</th>
                                            <td><?php echo "Php " . $shipping_fee;?></td>
                                        </tr>

                                        <tr class="order-total">
                                            <th>Order Total</th>
                                            <td><strong><span class="amount"><?php $total = $grand_total + $shipping_fee; echo "Php " . $total?></span></strong> </td>
                                        </tr>

                                        <tr class="cart-subtotal">
                                            <form action='checkout' method='post'>
                                            <?php   echo " <input type='hidden' name='total' value='";
                                                    echo $total;
                                                    echo "'>";?>
                                            <td colspan='2'><input type='submit' value='Proceed to Checkout' name='checkout' class='button'></td>
                                            </form>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            </div>
                        </div>                        
                    </div>                    
                </div>
            </div>
        </div>
    </div>


    <?php include 'footer.php'; ?>