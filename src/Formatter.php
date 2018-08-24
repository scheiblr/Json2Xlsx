<?php

namespace UKLFR\Json2Xlsx;

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

    static function titleToRows($titles, $funcIsHeadline = ['UKLFR\Json2Xlsx\Formatter', 'isHeadline'])
    {
        $result = [0 => []];

        $row = 0;
        $col = 0;

        // call recursive function
        self::titleToRowsHelp($result, $titles, $col, $row, 0, $funcIsHeadline);

        return $result;
    }

    private static function titleToRowsHelp(&$array, $titles, &$col, $row, $depth = 0, $funcIsHeadline)
    {
        foreach ($titles as $key => $title) {
            if (empty($array[$row])) {
                $array[$row] = [];
            }

            // recursion call
            if (is_array($title)) {
                // regular step
                if (!is_numeric($key) && !call_user_func($funcIsHeadline, $key)) {
                    $array[$row][$col] = $key;
                }
                $row++;
                self::titleToRowsHelp($array, $title, $col, $row, $depth + 1, $funcIsHeadline);
                $row--;
            } else {
                // regular step
                if (!call_user_func($funcIsHeadline, $title)) {
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
                $depth = self::array_depth($value) + 1;

                if ($depth > $max_depth) {
                    $max_depth = $depth;
                }
            }
        }

        return $max_depth;
    }

    static function entitiyToRow($entity, $cols, $funcIsHeadline = ['UKLFR\Json2Xlsx\Formatter', 'isHeadline'])
    {
        $maxEntriesPerCol = 1;
        foreach ($entity as $field) {
            if (is_array($field)) {
                $maxEntriesPerCol = max($maxEntriesPerCol, sizeof($field));
            }
        }

        // create array
        $result = array_fill(0, $maxEntriesPerCol, array_fill(0, $cols, NULL));

        $patientNumeric = array_values($entity);

        // write data
        $col = 0;

        foreach ($entity as $key => $field) {
            $offsetRow = 0;
            // if is array, which means there are
            // several entries in that field
            if (is_array($field)) {
                // print all these entries inside the same col
                foreach ($field as $elem) {
                    // if element is an array
                    if (is_array($elem)) {
                        // each element results to be one row
                        $offsetCol = 0;
                        foreach ($elem as $value) {
                            // set value
                            if (!is_null($value)) {
                                $result[$offsetRow][$col + $offsetCol] = $value;
                            }

                            // increment offset col
                            ++$offsetCol;
                        }
                        // increment offset row
                        ++$offsetRow;
//                    $result[$offsetRow++][$col] = json_encode($elem);
                    } else {
                        $result[$offsetRow][$col++] = $elem;
                    }
                }

                // increment cols only one time
                $col += sizeof($field[0]);
            } else {
                if (!call_user_func($funcIsHeadline, $key)) {
                    $result[0][$col++] = $field;
                }
            }
        }

        // fill id fields respectevily
        for ($i = 1; $i < sizeof($result); ++$i) {
            $result[$i][0] = $result[$i - 1][0];
            $result[$i][1] = $result[$i - 1][1];
        }

        return $result;
    }
    
    static function fillSheet(&$objSheet, $sheetName, $entities, $freezeCols = 1, $funcIsHeadline = ['UKLFR\Json2Xlsx\Formatter', 'isHeadline'])
    {
        // get headlines
        $headlines = [];
        $i = 0;
        $titles = [];

        if (count($entities) > 0) {
            foreach ($entities[0] as $key => $value) {
                if (call_user_func($funcIsHeadline, $key)) {
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
            foreach ($entities[0] as $key => $field) {
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

        $grid = self::titleToRows($titles);

        $depth = self::array_depth($titles) + ($headlines !== []);

        // freeze rows
        $objSheet->freezePaneByColumnAndRow($freezeCols, $depth + 1);

        // if there are headlines, add it to the top of the grid
        if (count($headlines) > 0)
            array_unshift($grid, $headlines);

        // count the cols (without headlines)
        $cols = sizeof($grid[0]);


//    println('xml 2 array');
        foreach ($entities as $entity) {
            $rows = self::entitiyToRow($entity, $cols);

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