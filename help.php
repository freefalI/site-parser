#!/usr/bin/env php
<?php

require 'vendor/autoload.php';

use SiteParser\Commands\HelpCommand;

$command = new HelpCommand();
$command->execute();