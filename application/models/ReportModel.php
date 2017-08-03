<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ReportModel class
 * 
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
    class ReportModel extends CI_Model {

        function __construct(){
            parent::__construct();
            $this->load->library("PHPExcel");
        }

        public function export_excel($table){
            $objPHPExcel = new PHPExcel();
            $query = $this->db->get($table);

            $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
    
            $objPHPExcel->setActiveSheetIndex(0);
    
            // Field names in the first row
            $fields = $query->list_fields();
            $col = 0;
            foreach ($fields as $field)
            {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
                $col++;
            }
    
            // Fetching the table data
            $row = 2;
            foreach($query->result() as $data)
            {
                $col = 0;
                foreach ($fields as $field)
                {
                    $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                    $col++;
                }
    
                $row++;
            }
    
            $objPHPExcel->setActiveSheetIndex(0);
    
            $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    
            // Sending headers to force the user to download the file
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="'.$table.'Data_'.date('dMy').'.xls"');
            header('Cache-Control: max-age=0');
    
            $objWriter->save('php://output');
        }
        
    }
?>