#!/usr/bin/env php
<?php
require 'vendor/autoload.php';

use SiteParser\Commands\ReportCommand;

if (!isset($argv[1])) {
    echo "Enter domain";
    return -1;
}
//TODO validate domain
$domain = $argv[1];
$command = new ReportCommand($domain);
$command->execute();