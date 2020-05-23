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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class AthenaReport extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->authentication->sessionCheck();

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
        $pdf = new \Mpdf\Mpdf(['tempDir' => APPPATH . 'cache/mpdf']);
        $html = $this->load->view('common/template', array(), TRUE);

		$pdf->WriteHtml($html);
        $pdf->Output('export.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function getregistration()
    {
        $pdf = new \Mpdf\Mpdf(['tempDir' => APPPATH . 'cache/mpdf']);
        $data['query'] = $this->RegistrationModel->getData();
        $data['setting'] = $this->SettingsModel->getData()->row();

        $html = $this->load->view('common/report_template', $data, TRUE);
		$pdf->WriteHtml($html);
        $pdf->Output('export.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function export_visitmonth($start, $end, $doctor_id)
    {
        $pdf = new \Mpdf\Mpdf(['tempDir' => APPPATH . 'cache/mpdf']);

        $data['query'] = $this->RegistrationModel->getvisit_month($start, $end, $doctor_id);
        $data['doctor'] = $this->DoctorModel->Read_doctorname($doctor_id);
        $data['setting'] = $this->SettingsModel->getData()->row();
        
        $html = $this->load->view('common/visit_template', $data, TRUE);
		$pdf->WriteHtml($html);
        $pdf->Output('export.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function export_medicalrecord($start, $end, $patient_id)
    {
        $pdf = new \Mpdf\Mpdf(['tempDir' => APPPATH . 'cache/mpdf', 'orientation' => 'L']);

        $data['query'] = $this->EMRModel->getrecord_report($patient_id, $start, $end);
        $data['patientid'] = $patient_id;
        $data['patientname'] = $this->PatientModel->Read_patientname($patient_id);
        $data['setting'] = $this->SettingsModel->getData()->row();

        $html = $this->load->view('common/medical_record_template', $data, TRUE);
		$pdf->WriteHtml($html);
        $pdf->Output('export.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function get_invoice($invoice_id)
    {
        $pdf = new \Mpdf\Mpdf(['tempDir' => APPPATH . 'cache/mpdf']);
        $data['query'] = $this->PaymentModel->getInvoiceData($invoice_id)->row();
        $data['setting'] = $this->SettingsModel->getData()->row();

        $html = $this->load->view('common/invoice_template', $data, TRUE);
        $pdf->WriteHtml($html);
        $pdf->Output('export.pdf', \Mpdf\Output\Destination::INLINE);
    }

    public function get_labresult($result_id)
    {
        $pdf = new \Mpdf\Mpdf(['tempDir' => APPPATH . 'cache/mpdf']);
        $data['query'] = $this->LabResultModel->getLabResultData($result_id)->row();
        $data['setting'] = $this->SettingsModel->getData()->row();

        $html = $this->load->view('common/labresult_template', $data, TRUE);
        $pdf->WriteHtml($html);
        $pdf->Output('export.pdf', \Mpdf\Output\Destination::INLINE);
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
        $this->form_validation->set_rules('start', 'Start Month', 'trim|required', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('end', 'End Month', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/report_active');
            $this->load->view('navbar');
            $this->load->view('report/registration_month_view');
            $this->load->view('footer/footer');
        } else {
            $start  = $this->input->post('start');
            $end    = $this->input->post('end');

            if ($this->export_registrationmonth($start, $end)) {
            } else {
                $data['error'] = 'There was a problem creating your new account. Please try again.';
                
                $this->load->view('header');
                $this->load->view('sidebar/report_active');
                $this->load->view('navbar');
                $this->load->view('report/registration_month_view', $data);
                $this->load->view('footer/footer');
            }
        }
    }

    public function visit_view()
    {
        $this->form_validation->set_rules('start', 'Start Month', 'trim|required', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('end', 'End Month', 'trim|required');
        $this->form_validation->set_rules('doctor_id', 'DoctorID', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/report_active');
            $this->load->view('navbar');
            $this->load->view('report/patient_visit_month');
            $this->load->view('footer/footer');
        } else {
            $start = $this->input->post('start');
            $end    = $this->input->post('end');
            $doctor_id    = $this->input->post('doctor_id');

            try {
                $this->export_visitmonth($start, $end, $doctor_id);
            } catch (Exception $ex) {
                redirect('/');
            }
        }
    }

    public function medical_report_view()
    {
        $this->form_validation->set_rules('start', 'Start Month', 'trim|required', array('is_unique' => 'This id already exists. Please choose another one.'));
        $this->form_validation->set_rules('end', 'End Month', 'trim|required');
        $this->form_validation->set_rules('patient_id', 'PatientID', 'trim|required');
        if ($this->form_validation->run() === false) {
            $this->load->view('header');
            $this->load->view('sidebar/report_active');
            $this->load->view('navbar');
            $this->load->view('report/patient_record_month');
            $this->load->view('footer/footer');
        } else {
            $start          = $this->input->post('start');
            $end            = $this->input->post('end');
            $patient_id     = $this->input->post('patient_id');

            try {
                $this->export_medicalrecord($start, $end, $patient_id);
            } catch (Exception $ex) {
                redirect('/');
            }
        }
    }

    public function export_registrationmonth($start, $end)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        $query = $this->RegistrationModel->getmonth_report($start, $end);

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
        header('Content-Disposition: attachment;filename="RegistrationReport_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function export_visitmonth_excel($start, $end, $doctor_id)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $query = $this->RegistrationModel->getvisit_month_excel($start, $end, $doctor_id);
 
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
        header('Content-Disposition: attachment;filename="VisitReport_'.date('dMy').'.xlsx"');
        header('Cache-Control: max-age=0');
        $writer->save('php://output');
    }

    public function export_completedata()
    {
        $allowed_table = array('user', 'doctor', 'worker', 'medicine', 'patient');
        $type = $this->input->get('type');

        if (in_array($type, $allowed_table)) {
            $this->ReportModel->export_excel($type);
        }
    }
}
