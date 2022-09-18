<?php

namespace App\Http\Controllers;

use App\Models\Deceased;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function deleted()
    {
        // Column names
        $fields = array('First Name', 'Middle Name', 'Last Name', 'Extension', 'Birth Date', 'Gender', 'Date Died',
        'Internment', 'Expiry', 'Cause of Death', 'Vicinity', 'Area', 'Location', 'Remarks');

        self::export($fields, 'deleted');
    }

    public function expired($year, $month)
    {
        // Column names
        $fields = array('First Name', 'Middle Name', 'Last Name', 'Extension', 'Birth Date', 'Gender', 'Date Died',
        'Internment', 'Expiry', 'Cause of Death', 'Vicinity', 'Area', 'Location', 'Remarks');

        self::export($fields, 'expired', $year, $month);
    }

    private static function export($fields, $recordToExtract, $year = null, $month)
    {
        // Excel file name for download
        $fileName = $recordToExtract."_deceased_data_" . strtoTime(now()) . ".xls";

        // Display column names as first row
        $excel = implode("\t", array_values($fields)) . "\n";

        if ($recordToExtract == 'deleted') {
            $records = Deceased::deletedR();
            foreach ($records as $record) {
                $lineData = array(
                    $record['person']['firstname'] ?? '',
                    $record['person']['middlename'] ?? '',
                    $record['person']['lastname'] ?? '',
                    $record['person']['extension'] ?? '',
                    $record['birthdate'] ?? '',
                    $record['gender'] ?? ($record['gender'] == 0 ? 'Male' : 'Female'),
                    $record['dateDied'] ?? '',
                    $record['internmentDate'] ?? ($record['internmentDate'].' '.$record['internmentTime']),
                    $record['expiryDate'] ?? '',
                    $record['causeOfDeath'] ?? '',
                    $record['vicinity'] ?? '',
                    $record['area'] ?? '',
                    $record['location'] ?? '',
                    $record['remarks'] ?? '',
                );

                array_walk($lineData, function ($str) {
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\r?\n/", "\\n", $str);
                    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
                });

                $excel .= implode("\t", array_values($lineData)) . "\n";
            }
        } else {
            $records = Deceased::expired($year, $month);
            foreach ($records as $record) {
                $lineData = array(
                    $record['person']['firstname'] ?? '',
                    $record['person']['middlename'] ?? '',
                    $record['person']['lastname'] ?? '',
                    $record['person']['extension'] ?? '',
                    $record['birthdate'] ?? '',
                    $record['gender'] ?? ($record['gender'] == 0 ? 'Male' : 'Female'),
                    $record['dateDied'] ?? '',
                    $record['internmentDate'] ?? ($record['internmentDate'].' '.$record['internmentTime']),
                    $record['expiryDate'] ?? '',
                    $record['causeOfDeath'] ?? '',
                    $record['vicinity'] ?? '',
                    $record['area'] ?? '',
                    $record['location'] ?? '',
                    $record['remarks'] ?? '',
                );

                array_walk($lineData, function ($str) {
                    $str = preg_replace("/\t/", "\\t", $str);
                    $str = preg_replace("/\r?\n/", "\\n", $str);
                    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
                });

                $excel .= implode("\t", array_values($lineData)) . "\n";
            }
        }

        // Headers for download
        header("Content-Type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=\"$fileName\"");

        // Render excel data
        echo $excel;

        exit;
    }

    /**
     * Filter the excel data
     */

}
