<?php

namespace UKLFR\Json2Xlsx;

class Fetcher
{
    static function dbConnect($config, $db_settings = false) {
        try {
            $dbLocation = "{$config['type']}:dbname={$config['db']};host={$config['host']}";
            $conn = new \PDO($dbLocation, $config['user'], $config['password'], array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));

            self::applyDbSettings($conn, $db_settings);

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

    static function query($conn, $query, $fieldname = 'export') {
        $qry = $conn->prepare($query);
        $qry->execute();

        // since it is a 0..1 to 1 relation
        // if no data set (i.e. 0-relation) return empty array
        // the first tuple else (1-relation)
        $qryResult = $qry->fetch(\PDO::FETCH_ASSOC);

        //Decode JSON
        $result = json_decode($qryResult[$fieldname], true);

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

        // perform query
        return  self::query($conn, "SELECT $schema.$function($param) as export;");
    }

    static function getDataFromJsonFile($file, $key='export') {
        return [$key => json_decode(file_get_contents($file), true)];
    }
}