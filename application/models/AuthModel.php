<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * AuthModel class
 *
 * @package    AthenaEMR
 * @license    https://opensource.org/licenses/MIT  MIT License
 * @author     Gema Aji Wardian <gema_wardian@hotmail.com>
 * @link	   https://github.com/nerdv2/AthenaEMR
 * @extends    CI_Model
 */
class AuthModel extends CI_Model
{

    /**
     * __construct function.
     *
     * @access public
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * resolve_user_login function.
     *
     * @access public
     * @param mixed $username
     * @param mixed $password
     * @return bool true on success, false on failure
     */
    public function resolve_user_login($username, $password)
    {
        $this->db->select('password_hash');
        $this->db->from('user');
        $this->db->where('username', $username);
        $hash = $this->db->get()->row('password_hash');
        
        return $this->verify_password_hash($password, $hash);
    }
    
    /**
     * get_user_id_from_username function.
     *
     * @access public
     * @param mixed $username
     * @return int the user id
     */
    public function get_user_id_from_username($username)
    {
        $this->db->select('id_user');
        $this->db->from('user');
        $this->db->where('username', $username);

        return $this->db->get()->row('id_user');
    }
    
    /**
     * get_user function.
     *
     * @access public
     * @param mixed $user_id
     * @return object the user object
     */
    public function get_user($user_id)
    {
        $this->db->from('user');
        $this->db->where('id_user', $user_id);
        return $this->db->get()->row();
    }
    
    /**
     * hash_password function.
     *
     * @access private
     * @param mixed $password
     * @return string|bool could be a string on success, or bool false on failure
     */
    private function hash_password($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
    
    /**
     * verify_password_hash function.
     *
     * @access private
     * @param mixed $password
     * @param mixed $hash
     * @return bool
     */
    private function verify_password_hash($password, $hash)
    {
        return password_verify($password, $hash);
    }

    public function sessionCheck($rolecheck='', $redirect = '/')
    {
        if ($this->session->userdata('logged_in')) {
            if (!empty($rolecheck)) {
                $roledata = explode(",", $rolecheck);

                if (!in_array($this->session->userdata('role'), $roledata)) {
                    redirect($redirect);
                }
            }
        } else {
            redirect($redirect);
        }
    }
}
