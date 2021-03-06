<?php

namespace UKLFR\Json2Xlsx;

class Fetcher
{
    static public $fieldName = 'export';

    static function dbConnect($config, $db_settings = false, $charset='utf8') {
        try {
            $dbLocation = "{$config['type']}:dbname={$config['db']};host={$config['host']}";

            if ($config['type'] == 'mysql') {
                $dbLocation .= ";charset={$charset}";
            }

            $conn = new \PDO($dbLocation, $config['user'], $config['password'], array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));

            self::applyDbSettings($conn, $db_settings);

            if ($config['type'] == 'pgsql') {
                $qry = $conn->prepare("SET CLIENT_ENCODING TO '$charset';");
                $qry->execute();
            }

            return $conn;
        } catch (\PDOException $e) {
            echo 'PDO Error: ' . $e->getMessage();
            return false;
        }
    }

    static function applyDbSettings($conn, $db_settings) {
        if ($db_settings) {
            if (is_array($db_settings)) {
                foreach ($db_settings as $setting) {
                    $conn->exec($setting);
                }
            } else {
                $conn->exec($db_settings);
            }
        }
    }

    static function query($conn, $query) {
        $qry = $conn->prepare($query);
        $qry->execute();

        // since it is a 0..1 to 1 relation
        // if no data set (i.e. 0-relation) return empty array
        // the first tuple else (1-relation)
        $qryResult = $qry->fetch(\PDO::FETCH_ASSOC);

        //Decode JSON
        $result = json_decode($qryResult[self::$fieldName], true);

        // free memory
        unset($qryResult);
        $qry = null;

        return $result;
    }

    static function getDataFromDB($conn, $schema, $view, $db_settings = false)
    {
        // apply query specific db_settings
        self::applyDbSettings($conn, $db_settings);

        // perform query
        return self::query($conn, "SELECT * FROM {$schema}.{$view}");
    }

    static function getDataFromDBFunc($conn, $schema, $function, $param, $db_settings = false)
    {
        // apply query specific db_settings
        self::applyDbSettings($conn, $db_settings);

        $fieldName = self::$fieldName;

        // perform query
        return  self::query($conn, "SELECT $schema.$function($param) as {$fieldName};");
    }

    static function getDataFromJsonFile($filename) {
        return json_decode(file_get_contents($filename), true);
    }
}