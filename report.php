#!/usr/bin/env php
<?php

use SiteParser\Commands\ReportCommand;

$domain = getopt();
$command = new ReportCommand($domain);
$command->execute();