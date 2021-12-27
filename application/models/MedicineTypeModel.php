<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * MedicineTypeModel class
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
class MedicineTypeModel extends CI_Model
{
    public function redirect()
    {
        redirect(base_url("medicine_type"));
    }

    public function getData()
    {
        $this->db->select("*");
        $this->db->from('medicine_type');
        $query = $this->db->get();
        return $query->result();
    }

    public function create_medicine($type_id, $name)
    {
        $type_id    = $this->input->post('type_id');
        $name = $this->input->post('name');
        
        $data = array(
            'type_id'   => $type_id,
            'name'   => $name,
            'created_at' => date('Y-m-j H:i:s'),
        );
        
        return $this->db->insert('medicine_type', $data);
    }

    public function generate_id()
    {
        $getprefix = $this->db->get('app_settings')->row();
        $prefix = $getprefix->medicine_type_prefix;

        $iddata = bin2hex(random_bytes(6));
        
        $query = $prefix . "-". $iddata;

        return $query;
    }

    public function Read_specific($type_id)
    {
        $this->db->select('*');
        $this->db->from('medicine_type');
        $this->db->where('type_id', $type_id);
        return $this->db->get();
    }

    public function Update()
    {
        $type_id    = $this->input->post('type_id');
        $name = $this->input->post('name');
        
        $data = array(
            'type_id'   => $type_id,
            'name'   => $name,
            'updated_at' => date('Y-m-j H:i:s'),
        );

        $this->db->where("type_id", $type_id);
        $this->db->update("medicine_type", $data);
        $this->redirect();
    }

    public function Delete($data)
    {
        $this->db->where($data);
        $this->db->delete('medicine_type');
    }
}
