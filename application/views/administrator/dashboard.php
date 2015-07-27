<?php include 'header.php'; ?>


<?php include 'admin_header.php'; ?>

<!-- Main -->
<div class="container-fluid">
    <div class="row">
            <?php include 'admin_sidebar.php'; ?>
                

            <div class="row">
                <!-- center left-->
                <div class="col-md-6">

                    <!--tabs-->
                    <div class="panel">
                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active"><a href="#profile" data-toggle="tab">Recent Activity</a></li>
                            <li><a href="#messages" data-toggle="tab">Unreleased Orders</a></li>
                            <li><a href="#settings" data-toggle="tab">Notifications</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active well" id="profile">
                                <h4><i class="glyphicon glyphicon-user"></i></h4> Lorem profile dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                                <p>Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis dolor, in sagittis nisi.</p>
                            </div>
                            <div class="tab-pane well" id="messages">
                                <h4><i class="glyphicon glyphicon-comment"></i></h4> Message ipsum dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                                <p>Quisque mauris augu.</p>
                            </div>
                            <div class="tab-pane well" id="settings">
                                <h4><i class="glyphicon glyphicon-cog"></i></h4> Lorem settings dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.
                                <p>Quisque mauris augue, molestie.</p>
                            </div>
                        </div>

                    </div>
                    <!--/tabs-->

                </div>
                <!--/col-->

                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4>Notices</h4></div>
                        <div class="panel-body">
                           <!-- <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                This is a dismissable alert.. just sayin'.
                            </div>-->
                            <p>Lorem profile dolor sit amet, consectetur adipiscing elit. Duis pharetra varius quam sit amet vulputate.</p>
                            <p>Quisque mauris augue, molestie tincidunt condimentum vitae, gravida a libero. Aenean sit amet felis dolor, in sagittis nisi.</p>
                        </div>
                    </div>

                </div>
                <!--/col-span-6-->

            </div>
            <!--/row-->


        </div>
        <!--/col-span-9-->
    </div>
</div>
<!-- /Main -->

<?php include 'footer.php'; ?>