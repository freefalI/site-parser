#!/usr/bin/env php
<?php

use SiteParser\Commands\HelpCommand;

$command = new HelpCommand();
echo $command->execute();