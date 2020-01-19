#!/usr/bin/env php
<?php

use SiteParser\Commands\ParseCommand;

$link = getopt();

$command = new ParseCommand($link);
$command->execute();