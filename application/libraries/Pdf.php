<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends \Mpdf\Mpdf
{
	/**
	 * Get an instance of CodeIgniter
	 *
	 * @access	protected
	 * @return	void
	 */
	protected function ci()
	{
		return get_instance();
	}
	/**
	 * Load a CodeIgniter view into domPDF
	 *
	 * @access	public
	 * @param	string	$view The view to load
	 * @param	array	$data The view data
	 * @return	void
	 */
	public function load_view($view, $data = array())
	{
		$html = $this->ci()->load->view($view, $data, TRUE);
		$this->WriteHtml($html);
	}

	public function load_view_landscape($view, $data = array())
	{
		$this->AddPage('L', // L - landscape, P - portrait
            '', '', '', '',
            10, // margin_left
            10, // margin right
            4, // margin top
            10, // margin bottom
            2, // margin header
            4); // margin footer
		$html = $this->ci()->load->view($view, $data, TRUE);
		$this->WriteHtml($html);
	}
}