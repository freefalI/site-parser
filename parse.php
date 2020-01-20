#!/usr/bin/env php
<?php
require 'vendor/autoload.php';

use SiteParser\Commands\ParseCommand;

if (!isset($argv[1])) {
    echo "Enter url";
    return -1;
}
//TODO validate url
$url = $argv[1];
$command = new ParseCommand($url);
$command->execute();