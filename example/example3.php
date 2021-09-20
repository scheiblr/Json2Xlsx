<?php

// include code modules from parent directory
require_once '../vendor/autoload.php';
require_once '../src/Fetcher.php';
require_once '../src/Formatter.php';

use UKLFR\Json2Xlsx\Formatter;
use UKLFR\Json2Xlsx\Fetcher;

// load .env file in order to get db information
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// database connection config
$config = [
    'type' => 'pgsql', // could also be e.g. mysql, this is a PDO setting
    'db' => $_ENV['POSTGRES_DB'],
    'host' => $_ENV['POSTGRES_HOST'],
    'user' => $_ENV['POSTGRES_USER'],
    'password' => $_ENV['POSTGRES_PASSWORD']
];

// establish db connection
$conn = Fetcher::dbConnect($config);

// perform export
$schema = 'public';
$function = 'f_export';

// some random ids
$ids = [3,8,10,20,35,80,13,29, 46];
$param = $param = 'ARRAY['.implode(',', $ids).'] :: INT[]';;

$export = Fetcher::getDataFromDBFunc($conn, $schema, $function, $param);

// set different colors.
Formatter::$colors=['#999000', '#333333'];

// set min color brightness to 35 percent (default is 20)
Formatter::$alternatingColorMinBrightnessPercent = 50;

// set the row alternating brightness distance to 5 (default is 3)
Formatter::$alternatingColorMinBrightnessPercent = 5;

// format
Formatter::generateXLS([
    'patients' => $export
], 'example3.xlsx', 1);
