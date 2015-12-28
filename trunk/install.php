<?php

require 'phpDataMapper/Base.php';
require 'phpDataMapper/Adapter/Mysql.php';
require 'db.php';

try {
	$adapter = new phpDataMapper_Adapter_Mysql('localhost', 'fbpress', 'root', 'pass');
} catch(Exception $e) {
	echo $e->getMessage();
	exit();
}

$mapper = new MUsers($adapter);
$mapper->migrate();

$mapper = new MNotes($adapter);
$mapper->migrate();

$mapper = new MComments($adapter);
$mapper->migrate();

$mapper = new MLikes($adapter);
$mapper->migrate();

$mapper = new MKeywords($adapter);
$mapper->migrate();

$mapper = new MNotes_Keywords($adapter);
$mapper->migrate();

$mapper = new MSubscribes($adapter);
$mapper->migrate();
