<?php

require 'database.php';

$db = new MyDB();

$sql =<<<EOF
    CREATE TABLE IF NOT EXISTS messages (
        text TEXT NOT NULL
    );
    CREATE TABLE IF NOT EXISTS commands (
        command TEXT NOT NULL
    );
    CREATE TABLE IF NOT EXISTS permissions (
        permission TEXT NOT NULL
    );
EOF;

$db->query($sql);
$db->close();

echo 'Success!' . PHP_EOL;