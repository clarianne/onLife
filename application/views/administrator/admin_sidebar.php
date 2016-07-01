                <div class="col-sm-3">
            <!-- Left column -->

                <ul class="nav nav-stacked">
                
                <li class="nav-header">
                    <a href="#">
                        <strong>
                            <?php

                              echo "Hello, ";
                              echo "$info->fname ";
                              echo "$info->lname";
                              echo "!";

                            ?>
                        </strong>
                    </a>
                </li>

                <li class="nav-header"><a href="$">
                   <?php include 'server_time.php'; ?>
                </a></li>
            
                    <script src="<?php echo base_url("assets/js/jquery-2.1.1.min.js"); ?>" type="text/javascript"></script>
                    <script>
                        $(document).ready(function(){
                        setInterval(function(){
                        $(".server_time").load('server_time')
                        }, 1000);
                        });
                    </script>
                    </a>
                </li>

            <hr>

                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#orderMenu"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;<b>Orders</b></i></a>

                    <ul class="nav nav-stacked collapse" id="orderMenu">

                        <?php

                            echo "<li><a href='";
                            echo site_url() . "/admin/unreleased'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unreleased";

                          //  if ($unr_count != 0){

                                echo "<span class='badge badge-info'>" . $unr_count . "</span></a></li>";
                            //}





                        ?>

                        <li><a href="<?php echo site_url(); ?>/admin/released">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Released</a></li>                 
                    </ul>

                </li>

                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#customerMenu"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<b>Distributors</b></i></a>

                    <ul class="nav nav-stacked collapse" id="customerMenu">
                        <li><a href="<?php echo site_url(); ?>/admin/distributors">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Distributors</a></li>

                        <li><a href="<?php echo site_url(); ?>/admin/add_dist">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add New Distributor</a></li>                        
                    </ul>

                </li>

                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#productMenu"><i class="glyphicon glyphicon-star"></i>&nbsp;&nbsp;<b>Products</b></i></a>

                    <ul class="nav nav-stacked collapse" id="productMenu">

                        <li><a href="<?php echo site_url(); ?>/admin/products">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;View Products</a></li>

                        <li><a href="<?php echo site_url(); ?>/admin/add_prod">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Add New Product</a></li>                        
                    </ul>

                </li>

                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#archiveMenu"><i class="fa fa-archive"></i>&nbsp;&nbsp;<b>Archive</b></i></a>

                    <ul class="nav nav-stacked collapse" id="archiveMenu">

                        <li><a href="<?php echo site_url(); ?>/admin/dist_archive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Distributors</a></li>

                        <li><a href="<?php echo site_url(); ?>/admin/prod_archive">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Products</a></li>                        
                    </ul>

                </li>

                <hr>

                <li><a href="<?php echo site_url(); ?>/admin/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Logout</a></li>

        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">