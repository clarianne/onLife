<div class="header-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                   <!--logo here-->
                   <a href="<?php echo site_url(); ?>/dist/dist_index"><img src="<?php echo base_url("assets/img/onlife_mini.png"); ?>" height="50px"></a>
                </div>

                    <div class="col-md-4">
                    <div class="header-right">
                    <ul class="list-unstyled list-inline">
                            <li>
                                <a href="<?php echo site_url(); ?>/dist/profile"><span class="key">Hello, </span>

                                <span class="value">
                                   <?php echo $info->fname . " " . $info->lname . "!";

                                   ?>

                                </span></a>

                                <!--<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="#"><i class="fa fa-user"></i> My Account</a></li>
                                    <li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
                                </ul>-->
                            </li>
                            <!--<li><a href="#"><i class="fa fa-shopping-cart"></i> Shopping Cart </a></li>-->
                            <li><a href="<?php echo site_url(); ?>/dist/logout"><i class="fa fa-sign-out"></i> Logout</a></li>
                        </ul>
                    </div>
                </div>
                
            </div>
        </div>
    </div> <!-- End header area -->