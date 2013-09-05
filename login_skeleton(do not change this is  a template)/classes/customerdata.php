<?php
require("../common.php");
$user_name = $_SESSION['user']['username'];
$user_id = $_SESSION['user']['id'];
$user_balance = $_SESSION['user']['balance'];
$data = array('username' => $user_name, 'userid' => $user_id, 'userbalance' => $user_balance);
header('Content-Type: application/json; charset=utf-8');
echo json_encode($data);
?>