<?php 

error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();

require 'WebSocketServer.php';
require 'database.php';

$server = new WebSocketServer('127.0.0.1', 9999);
$server->settings(36000, true, true);
$server->handler = function($connect, $data) {
    $db = new MyDB();

    if (str_contains($data, "message")) {
        $data = str_replace("message: ", '', $data);
        $sql =<<<EOF
            INSERT INTO messages (text) VALUES ('$data');
        EOF;
    } elseif (str_contains($data, "command")) {
        $data = str_replace("command: ", '', $data);

        $sql =<<<EOF
            INSERT INTO commands (command) VALUES ('$data');
        EOF;
    } elseif (str_contains($data, "command-remove")) {
        $data = str_replace("command-remove: ", '', $data);

        $sql =<<<EOF
            DELETE FROM commands WHERE command = '$data';
        EOF;
    } elseif (str_contains($data, "permission")) {
        $data = str_replace("permission: ", '', $data);

        $sql =<<<EOF
            INSERT INTO permissions (permission) VALUES ('$data');
        EOF;
    } elseif (str_contains($data, "permission-remove")) {
        $data = str_replace("permission-remove: ", '', $data);

        $sql =<<<EOF
            DELETE FROM permissions WHERE permission = '$data';
        EOF;
    } else {
        $sql = '';
    }

    $db->querySingle($sql);
    $db->close();

    WebSocketServer::response($connect, $data);
};
$server->startServer();