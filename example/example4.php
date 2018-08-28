<?php

// include code modules from parent directory
require_once '../vendor/autoload.php';
require_once '../src/Fetcher.php';
require_once '../src/Formatter.php';

use UKLFR\Json2Xlsx\Formatter;
use UKLFR\Json2Xlsx\Fetcher;

$export = Fetcher::getDataFromJsonFile('sample.json');

// format
Formatter::generateXLS([
    'patients' => $export
], 'example4.xlsx', 1);
