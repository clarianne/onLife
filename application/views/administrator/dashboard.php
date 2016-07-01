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
                            <li class="active"><a href="#released_orders" data-toggle="tab">Released Orders</a></li>
                            <li><a href="#unreleased_orders" data-toggle="tab">Unreleased Orders</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active well" id="released_orders">
                            <?php foreach ($r_5 as $q) {
                               echo "<p><b>Order #";
                               echo $q->order_id;
                               echo"</b> for ";
                               echo $q->fname . " " . $q->lname;
                               echo " (released last " . $q->release_date . ")</p>";
                            }?>
                            </div>
                            <div class="tab-pane well" id="unreleased_orders">
                                <?php foreach ($unr_5 as $q) {
                               echo "<p><b>Order #";
                               echo $q->order_id;
                               echo"</b> for ";
                               echo $q->fname . " " . $q->lname;
                               echo " (ordered last " . $q->order_date . ")</p>";
                            }?>
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
                           <p>Please advise all distributors to provide COMPLETE information in their distributor application form.</p>
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