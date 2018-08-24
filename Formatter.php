<?php

namespace Json2Xlsx;

class Formatter
{
    static function println($text)
    {
        print($text . "\n");
    }

    static function arrayToXls($array, &$sheet)
    {
        foreach ($array as $row_index => $row) {
            foreach ($row as $column_index => $value) {
                $sheet->setCellValueByColumnAndRow($column_index + 1, $row_index + 1, $value);
            }
        }
    }

    static function titleToRows($titles, $funcIsHeadline = self::isHeadline)
    {
        $result = [0 => []];

        $row = 0;
        $col = 0;

        // call recursive function
        self::titleToRowsHelp($result, $titles, $col, $row, 0, $funcIsHeadline);

        return $result;
    }

    private static function titleToRowsHelp(&$array, $titles, &$col, $row, $depth = 0, $funcIsHeadline = self::isHeadline)
    {
        foreach ($titles as $key => $title) {
            if (empty($array[$row])) {
                $array[$row] = [];
            }

            // recursion call
            if (is_array($title)) {
                // regular step
                if (!is_numeric($key) && !isHeadline($key)) {
                    $array[$row][$col] = $key;
                }
                $row++;
                self::titleToRowsHelp($array, $title, $col, $row, $depth + 1);
                $row--;
            } else {
                // regular step
                if (!$funcIsHeadline($title)) {
                    $array[$row][$col++] = $title;
                }
            }
        }
    }

    static function isHeadline($key)
    {
        return str_replace('headline', '', $key) !== $key;
    }

    static function array_depth(array $array)
    {
        $max_depth = 1;

        foreach ($array as $value) {
            if (is_array($value)) {
                $depth = array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        return $max_depth;
    }

    static function fillSheet(&$objSheet, $sheetName, $patients, $freezeCols = 1, $funcIsHeadline = self::isHeadline)
    {
        // get headlines
        $headlines = [];
        $i = 0;
        $titles = [];

        if (count($patients) > 0) {
            foreach ($patients[0] as $key => $value) {
                if ($funcIsHeadline($key)) {
                    $headlines[$i] = $value;
                } else {
                    if (is_array($value)) {
                        $i += max(1, sizeof($value[0]));
                    } else {
                        $i++;
                    }
                }
            }

            // estimate titles
            foreach ($patients[0] as $key => $field) {
                if (is_array($field)) {
                    $subtitles = [];
                    foreach ($field[0] as $subkey => $subfield) {
                        array_push($subtitles, $subkey);
                    }
                    $titles[$key] = $subtitles;
                } else {
                    array_push($titles, $key);
                }
            }
        }


        // setup excel sheet
        $objSheet->setTitle($sheetName);

        $grid = titleToRows($titles);

        $depth = array_depth($titles) + ($headlines !== []);

        // freeze rows
        $objSheet->freezePaneByColumnAndRow($freezeCols, $depth + 1);

        // if there are headlines, add it to the top of the grid
        if (count($headlines) > 0)
            array_unshift($grid, $headlines);

        // count the cols (without headlines)
        $cols = sizeof($grid[0]);


//    println('xml 2 array');
        foreach ($patients as $patient) {
            $rows = patientToRow($patient, $cols);

            foreach ($rows as $row) {
                array_push($grid, $row);
            }
        }

// save it to xls
        self::arrayToXls($grid, $objSheet);

// set first rows bold
        $objSheet
            ->getStyle("1:$depth")
            ->getFont()
            ->setBold(true)
            ->setItalic(true);
    }

    static function generateXLS($data, $filename, $freezeCols = 1)
    {

        $obj = new \PhpOffice\PhpSpreadsheet\Spreadsheet();

        $i = 0;
        foreach ($data as $key => $sheetData) {
            // if $i > 0 create new sheet
            $sheet = ($i == 0) ?
                $obj->getActiveSheet() : $obj->createSheet($i);
            self::fillSheet(
                $sheet, $key, $sheetData,
                is_array($freezeCols) ? $freezeCols[$i] : $freezeCols
            );

            // inc i
            ++$i;
        }

// TODO: apply alternating coloring
// self::applyStyle($headlines, $objSheet, $cols, $freezeCols);

        // save file
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($obj, 'Xlsx');
        $objWriter->save($filename);
    }
}