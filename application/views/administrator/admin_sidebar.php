         <!--   <a href="#"><strong><i class="glyphicon glyphicon-wrench"></i> Tools</strong></a>

            <hr>

        -->

                <div class="col-sm-3">
            <!-- Left column -->

                <ul class="nav nav-stacked">
                
                <li class="nav-header">
                    <a href="#">
                        <strong>
                            <?php

                              echo "Hello, ";
                              echo "$info->fname ";
                              echo "$info->mname ";
                              echo "$info->lname";
                              echo "!";

                            ?>
                        </strong><li><a href="#"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;View Profile</a></li>
                    </a>
                </li>

                <li class="nav-header"><a href="$">
                    <?php include 'server_time.php'; ?>
            
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
                        <li><a href="<?php echo site_url(); ?>/admin/released">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Released</a></li>

                        <li><a href="<?php echo site_url(); ?>/admin/unreleased">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unreleased <span class="badge badge-info">4</span></a></li>                        
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

                <hr>

                <li><a href="<?php echo site_url(); ?>/admin/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Logout</a></li>

        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">

            <!-- column 2 -->
            <!--<ul class="list-inline pull-right">
                <li><a href="#"><i class="glyphicon glyphicon-cog"></i></a></li>
                <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-comment"></i><span class="count">3</span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">1. Is there a way..</a></li>
                        <li><a href="#">2. Hello, admin. I would..</a></li>
                        <li><a href="#"><strong>All messages</strong></a></li>
                    </ul>
                </li>
                <li><a href="#"><i class="glyphicon glyphicon-user"></i></a></li>
                <li><a title="Add Widget" data-toggle="modal" href="#addWidgetModal"><span class="glyphicon glyphicon-plus-sign"></span> Add Widget</a></li>
            </ul>-->
            