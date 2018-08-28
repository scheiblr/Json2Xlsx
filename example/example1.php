<?php

// include code modules from parent directory
require_once '../vendor/autoload.php';
require_once '../src/Fetcher.php';
require_once '../src/Formatter.php';

use UKLFR\Json2Xlsx\Formatter;
use UKLFR\Json2Xlsx\Fetcher;

// load .env file in order to get db information
$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

// database connection config
$config = [
    'type' => 'pgsql', // could also be e.g. mysql, this is a PDO setting
    'db' => getenv('POSTGRES_DB'),
    'host' => getenv('POSTGRES_HOST'),
    'user' => getenv('POSTGRES_USER'),
    'password' => getenv('POSTGRES_PASSWORD')
];

// establish db connection
$conn = Fetcher::dbConnect($config);

// perform export
$schema = 'public';
$view = 'v_export';
$export = Fetcher::getDataFromDB($conn, $schema, $view);

// format
Formatter::generateXLS([
    'patients' => $export
], 'example1.xlsx', 3);
