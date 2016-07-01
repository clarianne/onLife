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
                        <h2>Checkout</h2>
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
                        <div class="woocommerce">

                            

                                <div id="customer_details" class="col2-set">
                                    <div class="col-1">
                                        <div class="woocommerce-billing-fields">
                                            <h3>Billing Details</h3>
                                            <form action="<?php echo site_url()?>/place_order_execution" method="post" class="form" role="form">
                                            <?php if ($info->lname !=""){ ?>
                                            <p id="billing_first_name_field" class="form-row form-row-first validate-required">
                                                <label class="" for="billing_first_name">First Name
                                                </label>
                                                <input type="text" value="<?php echo $info->fname; ?>" placeholder="" id="fname" name="fname" class="input-text " disabled>
                                                <input type="hidden" value="<?php echo $info->lfsi_id; ?>" placeholder="" id="lfsi_id" name="lfsi_id" class="input-text " disabled>
                                            </p>

                                            <p id="billing_last_name_field" class="form-row form-row-last validate-required">
                                                <label class="" for="billing_last_name">Last Name
                                                </label>
                                                <input type="text" value="<?php echo $info->lname; ?>" placeholder="" id="lname" name="lname" class="input-text " disabled>
                                            </p>
                                            <div class="clear"></div>
                                            <?php } else{?>
                                            <p id="billing_company_field" class="form-row form-row-wide">
                                                <label class="" for="billing_company">Company Name</label>
                                                <input type="text" value="<?php echo $info->fname; ?>" placeholder="" id="fname" name="fname" class="input-text " disabled>
                                            </p><?php }?>

                                            <p id="billing_address_1_field" class="form-row form-row-wide address-field validate-required">
                                                <label class="" for="billing_address_1">Address
                                                </label>
                                                <textarea type="text" value="" placeholder="Street address" id="address" name="address" class="input-text " disabled><?php echo $info->address; ?></textarea>
                                            </p>

                                           
                                            <div class="clear"></div>

                                            <p id="billing_email_field" class="form-row form-row-first validate-required validate-email">
                                                <label class="" for="billing_email">Email Address
                                                </label>
                                                <input type="text" value="<?php echo $info->email_add; ?>" placeholder="" id="email_add" name="email_add" class="input-text " disabled>
                                            </p>

                                            <p id="billing_phone_field" class="form-row form-row-last validate-required validate-phone">
                                                <label class="" for="billing_phone">Contact Number
                                                </label>
                                                <input type="text" value="<?php echo $info->contact_num; ?>" placeholder="" id="contact_num" name="contact_num" class="input-text " disabled>
                                            </p>
                                            <div class="clear"></div>

                                        </div>
                                    </div>

                                </div>

                                <h3 id="order_review_heading">Your order</h3>

                                <div id="order_review" style="position: relative;">
                                
                                    <table class="shop_table">
                                        <thead>
                                            <tr>
                                                <th class="product-name">Product</th>
                                                <th class="product-total">Total</th>
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
                                                    echo " <input type='hidden' name='rowid' id='order_item_id' value='";
                                                    echo $item['rowid'];
                                                    echo "'>";
                                                    echo " <input type='hidden' name='id' id='product_code' value='";
                                                    echo $item['id'];
                                                    echo "'>";
                                                    echo "<td class='product-name'>";
                                                    echo $item['name']. " " ;
                                                    echo " <input type='hidden' name='name' id='prod_name' value='";
                                                    echo $item['name'];
                                                    echo "'>";
                                                    echo "<strong class='product-quantity'>×";
                                                    echo $item['qty'];
                                                    echo " <input type='hidden' name='qty' id='quantity' value='";
                                                    echo $item['qty'];
                                                    echo "'>";
                                                    echo "</strong> </td>";
                                                    echo "<td class='product-total'>";
                                                    echo "<span class='amount'>";
                                                    echo "Php " . $item['subtotal'];
                                                    echo " <input type='hidden' name='subtotal' id='item_price' value='";
                                                    echo $item['subtotal'];
                                                    echo "'>";
                                                    echo "</span> </td>";
                                                    echo "</tr>";                             

                                                    $grand_total = $grand_total + $item['subtotal'];
                                                }
                                        }?>
                                        </tbody>
                                        <tfoot>

                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount"><?php echo "Php " . $grand_total;?></span>
                                                </td>
                                            </tr>

                                            <tr class="shipping">
                                                <th>Shipping and Handling</th>
                                                <td>

                                                    <?php echo "Php " . $shipping_fee;?>
                                                </td>
                                            </tr>


                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount"><?php $order_total = $grand_total + $shipping_fee; echo "Php " . $order_total;?></span></strong> </td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                           <input type='hidden' value='<?php echo $order_total;?>' id='order_total'>
                                            <td colspan='2'>
                                            <button class="btn btn-lg btn-primary" id="place_order" type="button">Place Order</button></td>
                                            </form>
                                        </tr>

                                        </tfoot>
                                    </table>
                                </div>

                        </div>                       
                    </div>                    
                </div>
            </div>
        </div>
    </div>

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootbox.min.js"></script>
<script>
    $('#place_order').click( function(){
            
          var lfsi_id = document.getElementById('lfsi_id').value;

          var status = "UNRELEASED";
          var order_total = document.getElementById('order_total').value;
          
          var oi_product_code = document.getElementsByName("id");
          var oi_quantity = document.getElementsByName("qty");
          var oi_item_price = document.getElementsByName("subtotal");
                                
          order_items = new Array();
          var i = 0;
              while (oi_product_code[i]) {
              array = new Array(oi_product_code[i].value, oi_quantity[i].value, oi_item_price[i++].value);
              order_items.push(array);
          }

        $.ajax({
          url: "<?php echo site_url();?>/distributor/place_order_execution",
          type: "POST",
          data: {   lfsi_id : lfsi_id,
                    status : status,
                    order_total : order_total,
                    order_items : order_items,

           },

      beforeSend: function() {
        $("#reg").removeClass('alert alert-danger');
        $("#reg").html("<center><img src='<?php echo base_url();?>assets/img/ajax-loader.gif' /></center>");
      },
      
      success: function(result){

        if( result != "1" ){

          $("#reg").hide();
          bootbox.dialog({
          message: "Your order has been placed!",
          title: "<h3>Order Placed!<h3>",
          buttons:{
            no: {
            label: "Okay",
            className: "btn-primary",
            callback: function() {
               window.location.href = "<?php echo site_url();?>/dist/checkout_success/";
            }
            }
          }
          });
        }



      },


      error: function(){
        $("#reg").addClass("alert alert-danger");
        $("#reg").html("<center>An error has occurred. Try again.</center>");
      }
        });
    });


</script>

<?php include 'footer.php'; ?>