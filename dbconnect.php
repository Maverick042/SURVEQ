<?php
include 'plugins/zebradatabase/Zebra_Database.php';
$db = new Zebra_Database();
$db->connect('localhost', 'root', '', 'final');
$db2 = new Zebra_Database();
$db2->connect('localhost', 'root', '', 'final');
include 'plugins/zebrasession/Zebra_Session.php';
$link = $db->get_link();
$session = new Zebra_Session($link, 'sEcUr1tY_c0dE');
?>