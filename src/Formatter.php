<?php

namespace UKLFR\Json2Xlsx;

use OzdemirBurak\Iris\Color\Hex;

class Formatter
{
    static $colors = [
        '#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce',
        '#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a'
    ];

    static $alternatingColorDistanceRow = 3;

    // in percentage
    static $alternatingColorMinBrightnessPercent = 20;

    /**
     * @param $array
     * @param $sheet
     */
    static function arrayToXls($array, &$sheet)
    {
        foreach ($array as $row_index => $row) {
            foreach ($row as $column_index => $value) {
                $sheet->setCellValueByColumnAndRow($column_index + 1, $row_index + 1, $value);
            }
        }
    }

    /**
     * @param $titles
     * @param array $funcIsHeadline
     * @return array
     */
    static function titleToRows($titles, $funcIsHeadline = ['UKLFR\Json2Xlsx\Formatter', 'isHeadline'])
    {
        $result = [0 => []];

        $row = 0;
        $col = 0;

        // call recursive function
        self::titleToRowsHelp($result, $titles, $col, $row, 0, $funcIsHeadline);

        return $result;
    }

    /**
     * @param $array
     * @param $titles
     * @param $col
     * @param $row
     * @param int $depth
     * @param $funcIsHeadline
     */
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

    /**
     * @param $key
     * @return bool
     */
    static function isHeadline($key)
    {
        return str_replace('headline', '', $key) !== $key;
    }

    /**
     * @param array $array
     * @return int
     */
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

    /**
     * @param $entity
     * @param $cols
     * @param $freezeCols
     * @param array $funcIsHeadline
     * @return array
     */
    private static function entitiyToRow($entity, $cols, $freezeCols, $funcIsHeadline = ['UKLFR\Json2Xlsx\Formatter', 'isHeadline'])
    {
        $maxEntriesPerCol = 1;
        foreach ($entity as $field) {
            if (is_array($field)) {
                $maxEntriesPerCol = max($maxEntriesPerCol, sizeof($field));
            }
        }

        // create array
        $result = array_fill(0, $maxEntriesPerCol, array_fill(0, $cols, NULL));

//        $patientNumeric = array_values($entity);

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

        // fill freezeCols fields respectevily
        // i.e. fill empty rows
        for ($i = 1; $i < sizeof($result); ++$i) {
            for ($j = 0; $j < $freezeCols; ++$j) {
                $result[$i][$j] = $result[$i - 1][$j];
            }
        }

        return $result;
    }


    /**
     * @return string
     */
    private function randomColorPart() {
        return str_pad( dechex( mt_rand( 0, 255 ) ), 2, '0', STR_PAD_LEFT);
    }


    /**
     * @return Hex
     * @throws \OzdemirBurak\Iris\Exceptions\InvalidColorException
     */
    private function randomColor() {
        return new Hex('#' . self::randomColorPart() . self::randomColorPart() . self::randomColorPart());
    }


    /**
     * @param $i
     * @return Hex
     * @throws \OzdemirBurak\Iris\Exceptions\InvalidColorException
     */
    private static function getColor($i)
    {
        return ($i >= count(self::$colors)) ? self::randomColor() : new Hex(self::$colors[$i]);
    }

    /**
     * @param $row
     * @param $col
     * @return string
     */
    private static function rowColToString($row, $col)
    {
        return \PhpOffice\PhpSpreadsheet\Cell\Coordinate::stringFromColumnIndex($col) . $row;
    }

    /**
     * @param Hex $hex
     * @param string $alpha
     * @return string
     */
    private static function toARGB(Hex $hex, $alpha = 'FF')
    {
        return strtoupper($alpha . str_replace('#', '', $hex));
    }

    /**
     * @param Hex $hex
     * @return float
     * @throws \OzdemirBurak\Iris\Exceptions\InvalidColorException
     */
    static function preceivedBrightness(Hex $hex)
    {
        $rgb = $hex->toRgb();

        // http://www.nbdtech.com/Blog/archive/2008/04/27/Calculating-the-Perceived-Brightness-of-a-Color.aspx
        $R = $rgb->red() * $rgb->red() * .241;
        $B = $rgb->green() * $rgb->green() * .691;
        $G = $rgb->blue() * $rgb->blue() * .068;

        return sqrt($R + $B + $G);
    }


    /**
     * @param $titles
     * @param $objSheet
     * @param $depth
     * @throws \OzdemirBurak\Iris\Exceptions\InvalidColorException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
    static function applyColors($titles, $objSheet, $depth)
    {
        $nRows = $objSheet->getHighestRow();
        $nCols = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($objSheet->getHighestColumn());

        $titlesByCol = [];
        foreach ($titles as $row => $subtitles) {
            foreach ($subtitles as $col => $title) {
                // create array if not existent
                if (!key_exists($col, $titlesByCol) || !is_array($titlesByCol[$col])) $titlesByCol[$col] = [];

                $titlesByCol[$col][$row] = $title;
            }
        }

        // sort the cols
        ksort($titlesByCol);

        // initialize some variables
        $i = 0;
        $groupColor = self::getColor($i);
        $groupCol = 0;
        $keys = array_keys($titles[0]);

        $getDistance = function($nCols, $col, $groupCol, $titles, $keys) {
            $result = array_search($groupCol, $keys);

            return (count($keys) < $result+1) ?
                $keys[$result+1] : $nCols - $groupCol;
        };

        // color brightness enhancement normalization
        $getFactor = function($col, $groupCol, $groupSize) {
            $a = 0;
            $b = (100-self::$alternatingColorMinBrightnessPercent)/100;
            return ($b - $a) * (($col - $groupCol) / $groupSize) + $a;
        };

        // initialize some more values
        $groupSize = $getDistance($nCols, 0, $groupCol, $titles, $keys);
        $factor = $getFactor(0, $groupCol, $groupSize);

        foreach ($titlesByCol as $col => $subtitles) {
            foreach ($subtitles as $row => $title) {
                // neglect very first cell
                if (!($col == 0 && $row == 0) && ($row == 0 && $title)) {
                    $groupColor = self::getColor(++$i);
                    $groupCol = $col;
                    $groupSize = $getDistance($nCols, $col, $groupCol, $titles, $keys);
                }

                // only if title and not the very first col, recompute factor
                if($title && $col !== 0) {
                    $factor = $getFactor($col, $groupCol, $groupSize);
                }

                // estimate color
                $color = $groupColor->lighten($factor * 100);
                $styleArray = [
                    'font' => [
                        'color' => [
                            'argb' => self::preceivedBrightness($color) < 130 ? 'FFFFFFFF' : 'FF000000'
                        ]
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => [
                            'argb' => self::toARGB($color)
                        ],
                    ],
                ];

                $objSheet->getStyle(self::rowColToString($row + 1, $col + 1) . ':' . self::rowColToString($nRows, $col + 1))->applyFromArray($styleArray);
                $objSheet->getStyle(self::rowColToString($row + 1, $col + 1) . ':' . self::rowColToString($row + 1, $nCols))->applyFromArray($styleArray);
            }
        }

        // alternating coloring of rows
        $tmp = $objSheet->getCellByColumnAndRow(1, $depth + 1)->getValue();
        $skip = false;
        for ($row = $depth + 2; $row <= $nRows; ++$row) {

            // count how many rows are in one group
            $i = 0;
            while ($tmp == $objSheet->getCellByColumnAndRow(1, $row)->getValue()) {
                ++$i;
                ++$row;
            }

            // get next tmp
            $tmp = $objSheet->getCellByColumnAndRow(1, $row + 1)->getValue();

            if (!$skip) {
                for ($col = 1; $col <= $nCols; ++$col) {

                    $objStyle = $objSheet->getStyle(self::rowColToString($row - $i - 1, $col) . ':' . self::rowColToString($row - 1, $col));

                    $color = new Hex('#' . $objStyle->getFill()->getStartColor()->getRGB());

                    $styleArray = [
                        'fill' => [
                            'startColor' => [
                                'argb' => self::toARGB($color->lighten(self::$alternatingColorDistanceRow))
                            ],
                        ],
                    ];

                    $objStyle->applyFromArray($styleArray);
                }
            }

            // alternation switch
            $skip = !$skip;
        }
    }


    /**
     * @param $objSheet
     * @param $sheetName
     * @param $entities
     * @param int $freezeCols
     * @param array $funcIsHeadline
     * @throws \OzdemirBurak\Iris\Exceptions\InvalidColorException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     */
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

        $titleGrid = self::titleToRows($titles);
        $grid = $titleGrid;

        $depth = self::array_depth($titles) + ($headlines !== []);

        // freeze rows
        $objSheet->freezePaneByColumnAndRow($freezeCols + 1, $depth + 1);

        // if there are headlines, add it to the top of the grid
        if (count($headlines) > 0) {
            array_unshift($grid, $headlines);
            array_unshift($titleGrid, $headlines);
        }
        // count the cols (without headlines)
        $nCols = sizeof($grid[0]);


        //    println('xml 2 array');
        foreach ($entities as $entity) {
            $rows = self::entitiyToRow($entity, $nCols, $freezeCols);

            foreach ($rows as $row) {
                array_push($grid, $row);
            }
        }

        // save it to xls
        self::arrayToXls($grid, $objSheet);

        // apply coloring and format header
        self::applyColors($titleGrid, $objSheet, $depth);
        self::formatHeader($depth, $objSheet);
    }

    /**
     * @param $depth
     * @param $sheet
     */
    static function formatHeader($depth, &$sheet)
    {
        // set headline rows bold and italic
        $range = self::rowColToString(1, 1) . ':' . $sheet->getHighestColumn() . $depth;
        $sheet
            ->getStyle($range)
            ->getFont()
            ->setBold(true)
            ->setItalic(true);
    }


    /**
     * @param $data
     * @param $filename
     * @param int $freezeCols
     * @throws \OzdemirBurak\Iris\Exceptions\InvalidColorException
     * @throws \PhpOffice\PhpSpreadsheet\Exception
     * @throws \PhpOffice\PhpSpreadsheet\Writer\Exception
     */
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

        // save file
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($obj, 'Xlsx');
        $objWriter->save($filename);
    }
}