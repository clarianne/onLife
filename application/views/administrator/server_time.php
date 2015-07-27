            <div class="server_time">
                <?php
                date_default_timezone_set('Asia/Manila');
                $date = date("Y-m-d H:i:s");
                echo "<strong><i class='glyphicon glyphicon-time'></i> ";
                echo $date;
                echo "</strong></a>";
                ?>
            </div>