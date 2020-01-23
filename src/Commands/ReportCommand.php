<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 15:52
 */

namespace SiteParser\Commands;

use SiteParser\GlobalConfig;

class ReportCommand extends Command
{
    /**
     * @var string
     */
    private $domain;

    /**
     * ReportCommand constructor.
     * @param string $domain
     */
    public function __construct($domain)
    {
        $this->domain = $domain;
    }

    function execute()
    {
        $reportsFolder = GlobalConfig::get('reportsFolder');
        $fileName = $reportsFolder . $this->domain . '.csv';
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);

        } else {
            echo 'There is no report for this domain';
        }
    }
}