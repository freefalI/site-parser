#!/usr/bin/env php
<?php

use SiteParser\Commands\ParseCommand;

$url = getopt();

$command = new ParseCommand($url);
$command->execute();