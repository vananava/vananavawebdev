<?php
echo '<h2>wp-config</h2>';


echo '<br>debug status '.WP_DEBUG;
echo '<br>CENTAMAN_GOLIVE stutus '.CENTAMAN_GOLIVE;
echo '<br>CENTAMAN_URL status '.CENTAMAN_URL;
echo '<br>TWOC2P_GOLIVE status '.TWOC2P_GOLIVE;
echo '<br>CENTAMAN_URL status '.CENTAMAN_URL;
echo '<br>CENTAMAN_URL status '.CENTAMAN_URL;
echo '<br>CENTAMAN_URL status '.CENTAMAN_URL;
echo '<br>CENTAMAN_URL status '.CENTAMAN_URL;
//echo '<br>ip status '.$checkip;

    $listTable = new Ticket_Item_List_Table();
    $listTable->prepare_items();
    $listTable->display();