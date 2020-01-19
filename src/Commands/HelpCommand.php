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
        $text = 'parse [url]   -  parse this url\n';
        $text .= 'report [domain]  - get info about parsed domain\n';
        $text .= 'help  - list of available commands';

        echo $text;
    }
}