<?php 
include 'conn.php';

$ARRAY_INDEX = 0;

$qr = "SELECT * FROM destination LIMIT 5";
$res_obj = mysqli_query($con, $qr);
$d_name = array();
$d_desc = array();
$d_loc = array();
$d_bs = array();
$d_off = array();
$d_on = array();
$d_ticket = array();
while ($r = mysqli_fetch_assoc($res_obj)) {
    array_push($d_name, $r['dest_name']);
    array_push($d_desc, $r['dest_desc']);
    array_push($d_loc, $r['dest_addr']);
    array_push($d_bs, $r['dest_bus_stand']);
    array_push($d_off, $r['dest_offDay']);
    array_push($d_on, $r['dest_onDay']);
    array_push($d_ticket, $r['dest_ticket_price']);
}
// print_r($d_bs);
// echo $d_name[0];



?>