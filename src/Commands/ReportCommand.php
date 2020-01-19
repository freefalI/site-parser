<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 15:52
 */

namespace SiteParser\Commands;

class ReportCommand extends Command
{
    const reportsFolder = 'reports/';
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
        $this->execute();
    }

    function execute()
    {
        $fileName = self::reportsFolder . $this->domain;
        if (file_exists($fileName)) {
            echo file_get_contents($fileName);

        } else {
            echo 'There is no report for this domain';
        }
    }
}