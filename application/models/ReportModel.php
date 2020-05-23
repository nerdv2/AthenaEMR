<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * ReportModel class
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class ReportModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function export_excel($table)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $query = $this->db->get($table);

        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field) {
            $sheet->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }

        // Fetching the table data
        $row = 2;
        foreach ($query->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $sheet->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }

            $row++;
        }

        $writer = new Xlsx($spreadsheet);
        
        // force download
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment;filename="'.$table.'Data_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }
}
