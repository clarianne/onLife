                <div class="col-sm-3">
            <!-- Left column -->

                <ul class="nav nav-stacked">
                <hr />

                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#orderMenu"><i class="glyphicon glyphicon-shopping-cart"></i>&nbsp;&nbsp;<b>Order History</b></i></a>

                    <ul class="nav nav-stacked collapse" id="orderMenu">

                        <?php

                            echo "<li><a href='";
                            echo site_url() . "/dist/unreleased'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Unreleased";

                                echo "<span class='badge badge-info'>" . $unr_count . "</span></a></li>";





                        ?>

                        <li><a href="<?php echo site_url(); ?>/dist/released">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Released</a></li>                 
                    </ul>

                </li>

                <li class="nav-header"> <a href="#" data-toggle="collapse" data-target="#customerMenu"><i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;<b>Edit Profile</b></i></a>

                    <ul class="nav nav-stacked collapse" id="customerMenu">
                        <li><a href="<?php echo site_url(); ?>/dist/update_billing">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Billing Information</a></li>

                        <li><a href="<?php echo site_url(); ?>/dist/update_login">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Update Login Information</a></li>                        
                    </ul>

                </li>

               

                <hr>

                <li><a href="<?php echo site_url(); ?>/admin/logout"><i class="glyphicon glyphicon-log-out"></i>&nbsp;&nbsp;Logout</a></li>

        </div>
        <!-- /col-3 -->
        <div class="col-sm-9">