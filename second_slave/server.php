<?php

require 'database.php';
require_once "router.php";

route('/', function() {
    $db = new MyDB();

    $sql =<<<EOF
        SELECT * FROM messages;
    EOF;

    $query = $db->query($sql);
    $response = [];

    while ($row = $query->fetchArray()) {
        array_push($response, $row);
    }

    $db->close();
   
    return json_encode(["result" => $response]);
});

route('/commands', function() {
    $db = new MyDB();

    $sql =<<<EOF
        SELECT * FROM commands;
    EOF;

    $query = $db->query($sql);
    $response = [];

    while ($row = $query->fetchArray()) {
        array_push($response, $row);
    }

    $db->close();
   
    return json_encode(["available commands" => $response]);
});

route('/permissions', function() {
    $db = new MyDB();

    $sql =<<<EOF
        SELECT * FROM permissions;
    EOF;

    $query = $db->query($sql);
    $response = [];

    while ($row = $query->fetchArray()) {
        array_push($response, $row);
    }

    $db->close();
   
    return json_encode(["permissions" => $response]);
});

$action = $_SERVER['REQUEST_URI'];
dispatch($action);