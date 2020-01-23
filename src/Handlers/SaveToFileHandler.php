<?php
/**
 * Created by PhpStorm.
 * User: Andrew Shmatko
 * Date: 19.01.2020
 * Time: 21:26
 */

namespace SiteParser\Handlers;

use SiteParser\DTO\ScrapedData;
use SiteParser\GlobalConfig;

class SaveToFileHandler extends Handler
{
    /**
     * @param ScrapedData[] $dtos
     */
    public function handle($dtos)
    {
        $reportsFolder = GlobalConfig::get('reportsPath');
        $file = $reportsFolder . $this->getDomain() . '.csv';
        file_put_contents($file, '');
        foreach ($dtos as $dto) {
            $string = $dto->getScrapedUrl()->toString();
            $string .= ';';
            foreach ($dto->getFoundData() as $imageUrl) {
                $string .= $imageUrl->toString() . ',';
            }
            $string .= PHP_EOL;
            file_put_contents($file, $string, FILE_APPEND);
        }
    }
}