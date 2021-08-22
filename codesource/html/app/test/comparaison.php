<?php

// avec strtotime :-(
$date11= strtotime("29/03/2019");
$date22= date('Y-m-d',strtotime(date('Y-m-d') . "+3 days"));
$datee= strtotime("25/03/2019");
echo $date22;
if( $date11 >> $datee ){
    echo "plus petit";
}
// avec DateTime :-)
$date1 = new DateTime("14/02/2012");
$date2 = new DateTime("12/03/2013");
if( $date1 < $date2 ){
    echo $date2->format('d/m/Y');
}
