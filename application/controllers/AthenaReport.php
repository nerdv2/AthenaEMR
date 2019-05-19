<?php
defined('BASEPATH') or exit('No direct script access allowed');
 
/**
 * AthenaReport Controller Class
 *
 * control reporting management, QRCode and export data(excel, pdf)
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 */

class AthenaReport extends CI_Controller
{
    public function __Construct()
    {
        parent::__Construct();
        $this->load->library('pdf');
        $this->load->library("PHPExcel");
        $this->load->model('UsersModel');
        $this->load->model('DoctorModel');
        $this->load->model('PaymentModel');
        $this->load->model('PatientModel');
        $this->load->model('LabResultModel');
        $this->load->model('RegistrationModel');
        $this->load->model('EMRModel');
        $this->load->model('SettingsModel');
        $this->load->model('ReportModel');
    }

    public function index()
    {
        redirect('/');
    }

    public function getPDF()
    {
        $this->pdf->load_view('common/template');
        $this->pdf->Output();
    }

    public function getregistration()
    {
        $data['query'] = $this->RegistrationModel->getData();
        $data['setting'] = $this->SettingsModel->getData()->row();
        $this->pdf->load_view('common/report_template', $data);
        $this->pdf->Output();
    }

    public function export_visitmonth($start, $end, $doctor_id)
    {
        $data['query'] = $this->RegistrationModel->getvisit_month($start, $end, $doctor_id);
        $data['doctor'] = $this->DoctorModel->Read_doctorname($doctor_id);
        $data['setting'] = $this->SettingsModel->getData()->row();
        $this->pdf->load_view('common/visit_template', $data);
        $this->pdf->Output();
    }

    public function export_medicalrecord($start, $end, $patient_id)
    {
        $data['query'] = $this->EMRModel->getrecord_report($patient_id, $start, $end);
        $data['patientid'] = $patient_id;
        $data['patientname'] = $this->PatientModel->Read_patientname($patient_id);
        $data['setting'] = $this->SettingsModel->getData()->row();
        //$this->load->view('common/medical_record_template', $data);
        $this->pdf->load_view_landscape('common/medical_record_template', $data);
        $this->pdf->Output();
    }

    public function get_invoice($invoice_id)
    {
        $data['query'] = $this->PaymentModel->getInvoiceData($invoice_id)->row();
        $data['setting'] = $this->SettingsModel->getData()->row();
        $this->pdf->load_view('common/invoice_template', $data);
        $this->pdf->Output();
    }

    public function get_labresult($result_id)
    {
        $data['query'] = $this->LabResultModel->getLabResultData($result_id)->row();
        $data['setting'] = $this->SettingsModel->getData()->row();
        $this->pdf->load_view('common/labresult_template', $data);
        $this->pdf->Output();
    }

    public function get_id($patient_id)
    {
        $data['query'] = $this->PatientModel->Read_specific($patient_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('common/card_template', $data);
        $this->load->view('footer/qrcode_footer');
    }

    public function get_entry($payment_id)
    {
        $data['query'] = $this->PaymentModel->Read_specific($payment_id)->row();
        $this->load->view('header');
        $this->load->view('sidebar/management_active');
        $this->load->view('navbar');
        $this->load->view('common/entry_template', $data);
        $this->load->view('footer/entry_footer');
    }

    public function registration_view()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            // set validation rules
            $this->form_validation->set_rules('start', 'Start Month', 'trim|required', array('is_unique' => 'This id already exists. Please choose another one.'));
            $this->form_validation->set_rules('end', 'End Month', 'trim|required');
            if ($this->form_validation->run() === false) {
            
                // validation not ok, send validation errors to the view
                $this->load->view('header');
                $this->load->view('sidebar/report_active');
                $this->load->view('navbar');
                $this->load->view('report/registration_month_view');
                $this->load->view('footer/footer');
            } else {
                // set variables from the form
                $start  = $this->input->post('start');
                $end    = $this->input->post('end');

                if ($this->export_registrationmonth($start, $end)) {

                    // user creation ok
                } else {
                
                    // user creation failed, this should never happen
                    $data['error'] = 'There was a problem creating your new account. Please try again.';
                    
                    // send error to the view
                    $this->load->view('header');
                    $this->load->view('sidebar/report_active');
                    $this->load->view('navbar');
                    $this->load->view('report/registration_month_view', $data);
                    $this->load->view('footer/footer');
                }
            }
        } else {
            redirect('/');
        }
    }

    public function visit_view()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            // set validation rules
            $this->form_validation->set_rules('start', 'Start Month', 'trim|required', array('is_unique' => 'This id already exists. Please choose another one.'));
            $this->form_validation->set_rules('end', 'End Month', 'trim|required');
            $this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required');
            if ($this->form_validation->run() === false) {
            
                // validation not ok, send validation errors to the view
                $this->load->view('header');
                $this->load->view('sidebar/report_active');
                $this->load->view('navbar');
                $this->load->view('report/patient_visit_month');
                $this->load->view('footer/footer');
            } else {
                // set variables from the form
                $start = $this->input->post('start');
                $end    = $this->input->post('end');
                $doctor_id    = $this->input->post('doctor_id');

                try {
                    $this->export_visitmonth($start, $end, $doctor_id);
                } catch (Exception $ex) {
                    redirect('/');
                }
            }
        } else {
            redirect('/');
        }
    }

    public function medical_report_view()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

            // set validation rules
            $this->form_validation->set_rules('start', 'Start Month', 'trim|required', array('is_unique' => 'This id already exists. Please choose another one.'));
            $this->form_validation->set_rules('end', 'End Month', 'trim|required');
            $this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required');
            if ($this->form_validation->run() === false) {
            
                // validation not ok, send validation errors to the view
                $this->load->view('header');
                $this->load->view('sidebar/report_active');
                $this->load->view('navbar');
                $this->load->view('report/patient_record_month');
                $this->load->view('footer/footer');
            } else {
                // set variables from the form
                $start = $this->input->post('start');
                $end    = $this->input->post('end');
                $patient_id    = $this->input->post('patient_id');

                try {
                    $this->export_medicalrecord($start, $end, $patient_id);
                } catch (Exception $ex) {
                    redirect('/');
                }
            }
        } else {
            redirect('/');
        }
    }

    public function export_registrationmonth($start, $end)
    {
        $objPHPExcel = new PHPExcel();
        $query = $this->RegistrationModel->getmonth_report($start, $end);

        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach ($query->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RegistrationReport_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
    }

    public function export_visitmonth_excel($start, $end, $doctor_id)
    {
        $objPHPExcel = new PHPExcel();
        $query = $this->RegistrationModel->getvisit_month_excel($start, $end, $doctor_id);

        $objPHPExcel->getProperties()->setTitle("export")->setDescription("none");
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        // Field names in the first row
        $fields = $query->list_fields();
        $col = 0;
        foreach ($fields as $field) {
            $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, 1, $field);
            $col++;
        }
 
        // Fetching the table data
        $row = 2;
        foreach ($query->result() as $data) {
            $col = 0;
            foreach ($fields as $field) {
                $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $data->$field);
                $col++;
            }
 
            $row++;
        }
 
        $objPHPExcel->setActiveSheetIndex(0);
 
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
 
        // Sending headers to force the user to download the file
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="VisitReport_'.date('dMy').'.xls"');
        header('Cache-Control: max-age=0');
 
        $objWriter->save('php://output');
    }

    public function export_completedata()
    {
        $allowed_table = array('user', 'doctor', 'worker', 'medicine');
        $type = $this->input->get('type');

        if (in_array($type, $allowed_table)) {
            $this->ReportModel->export_excel($type);
        }
    }
}
