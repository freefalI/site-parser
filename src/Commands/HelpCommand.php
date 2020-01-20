<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 15:52
 */

namespace SiteParser\Commands;

class HelpCommand extends Command
{

    function execute()
    {
        //TODO form description dynamically

        $text = PHP_EOL . '-Parse url' . PHP_EOL;
        $text .= 'parse [url]' . PHP_EOL;
        $text .= '-Get info about parsed domain' . PHP_EOL;
        $text .= 'report [domain]' . PHP_EOL;
        $text .= '-List of available commands' . PHP_EOL;
        $text .= 'help ' . PHP_EOL;

        echo $text;
    }
}