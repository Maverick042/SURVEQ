<?php
require 'plugins/zebradatabase/Zebra_Database.php';
require 'plugins/zebrasession/Zebra_Session.php';
$db = new Zebra_Database();
$db->connect('localhost', 'root', '', 'final');
$link = $db->get_link();
$session = new Zebra_Session($link, 'sEcUr1tY_c0dE');
$session->stop();
header('Location: index.php');
?>