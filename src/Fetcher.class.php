<?php

namespace UKLFR\Json2Xlsx;

class Fetcher {
    static function getPatientsFromDB($config, $schema, $view, $db_settings = false)
    {
        // setting up PDO
        $dbLocation = "{$config['type']}:dbname={$config['db']};host={$config['host']}";
        $db = new PDO($dbLocation, $config['user'], $config['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        if ($db_settings) {
            if (is_array($db_settings)) {
                foreach ($db_settings as $setting) {
                    $db->exec($setting);
                }
            } else {
                $db->exec($db_settings);
            }
        }


        $qry = $db->prepare("SELECT * FROM {$schema}.{$view}");
        $qry->execute();

        // since it is a 0..1 to 1 relation
        // if no data set (i.e. 0-relation) return empty array
        // the first tuple else (1-relation)
        $qryResult = $qry->fetch(PDO::FETCH_ASSOC);


        //Decode JSON
        $result = json_decode($qryResult['export'], true);

        // free memory
        unset($qryResult);

        $qry = null;
        $db = null;

        return $result;
    }

    static function getPatientsFromDBFunc($config, $schema, $function, $param, $db_settings = false)
    {
        // setting up PDO
        $dbLocation = "{$config['type']}:dbname={$config['db']};host={$config['host']}";
        $db = new PDO($dbLocation, $config['user'], $config['password'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

        if ($db_settings) {
            if (is_array($db_settings)) {
                foreach ($db_settings as $setting) {
                    $db->exec($setting);
                }
            } else {
                $db->exec($db_settings);
            }
        }

        $qry = $db->prepare("SELECT $schema.$function($param) as export;");
        $qry->execute();

        // since it is a 0..1 to 1 relation
        // if no data set (i.e. 0-relation) return empty array
        // the first tuple else (1-relation)
        $qryResult = $qry->fetch(PDO::FETCH_ASSOC);


        //Decode JSON
        $result = json_decode($qryResult['export'], true);

        // free memory
        unset($qryResult);

        $qry = null;
        $db = null;

        return $result;
    }
}