<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*     
 *     @author : Ali Reza Habibi
 *     shahreyarhabibi@gmail.com
 */

class Login extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->model('email_model');

        $this->load->database();
        $this->load->library('session');
        /* cache control */
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 2010 05:00:00 GMT");
    }

    //Default function, redirects to logged in user area
    public function index()
    {

        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
        
        else if ($this->session->userdata('doctor_login') == 1)
            redirect(site_url('doctor'), 'refresh');
        
        else if ($this->session->userdata('patient_login') == 1)
            redirect(site_url('patient'), 'refresh');
        
        else if ($this->session->userdata('nurse_login') == 1)
            redirect(site_url('nurse'), 'refresh');
        
        else if ($this->session->userdata('pharmacist_login') == 1)
            redirect(site_url('pharmacist'), 'refresh');
        
        else if ($this->session->userdata('laboratorist_login') == 1)
            redirect(site_url('laboratorist'), 'refresh');
        
        else if ($this->session->userdata('accountant_login') == 1)
            redirect(site_url('accountant'), 'refresh');
        
        else if ($this->session->userdata('receptionist_login') == 1)
            redirect(site_url('receptionist'), 'refresh');
        
        $this->load->view('backend/login');
    }
    
    //Ajax login function 
    function do_login()
    {

        //Recieving post input of email, password from ajax request
        $email    = $_POST["email"];
        $password = $_POST["password"];

        //Validating login
        $login_status = $this->validate_login($email, $password);
        if ($login_status == 'success') {
            redirect(site_url('login'), 'refresh');
        } else {
            $this->session->set_flashdata('error_message', get_phrase('login_failed'));
            redirect(site_url('login'), 'refresh');
        }
    }

    //Validating login from ajax request
    function validate_login($email = '', $password = '')
    {
        $credential = array(
            'email' => $email,
            'password' => sha1($password)
        );
        
        // Checking login credential for admin
        $query = $this->db->get_where('admin', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('admin_login', '1');
            $this->session->set_userdata('login_user_id', $row->admin_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'admin');
            return 'success';
        }
        
        
        $query = $this->db->get_where('doctor', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('doctor_login', '1');
            $this->session->set_userdata('login_user_id', $row->doctor_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'doctor');
            return 'success';
        }
        
        $query = $this->db->get_where('patient', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('patient_login', '1');
            $this->session->set_userdata('login_user_id', $row->patient_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'patient');
            return 'success';
        }
        
        $query = $this->db->get_where('nurse', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('nurse_login', '1');
            $this->session->set_userdata('login_user_id', $row->nurse_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'nurse');
            return 'success';
        }
        
        $query = $this->db->get_where('pharmacist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('pharmacist_login', '1');
            $this->session->set_userdata('login_user_id', $row->pharmacist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'pharmacist');
            return 'success';
        }
        
        $query = $this->db->get_where('laboratorist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('laboratorist_login', '1');
            $this->session->set_userdata('login_user_id', $row->laboratorist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'laboratorist');
            return 'success';
        }
        
        $query = $this->db->get_where('accountant', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('accountant_login', '1');
            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'accountant');
            return 'success';
        }
        
        $query = $this->db->get_where('receptionist', $credential);
        if ($query->num_rows() > 0) {
            $row = $query->row();
            $this->session->set_userdata('receptionist_login', '1');
            $this->session->set_userdata('login_user_id', $row->receptionist_id);
            $this->session->set_userdata('name', $row->name);
            $this->session->set_userdata('login_type', 'receptionist');
            return 'success';
        }
        
        return 'invalid';
    }

     /*     * *RESET AND SEND PASSWORD TO REQUESTED EMAIL*** */
    
    function forgot_password()
    {
        $this->load->view('backend/forgot_password');
    }

    function reset_password() {
    $email = $this->input->post('email');
    $new_password = substr(md5(rand(100000000, 20000000000)), 0, 7);
    $reset_account_type = '';

    // Check all user tables (admin, doctor, patient, etc.)
    $tables = ['admin', 'doctor', 'patient', 'nurse', 'pharmacist', 'laboratorist', 'accountant', 'receptionist'];
    
    foreach ($tables as $table) {
        $query = $this->db->get_where($table, ['email' => $email]);
        if ($query->num_rows() > 0) {
            $reset_account_type = $table;
            $this->db->where('email', $email);
            $this->db->update($table, ['password' => sha1($new_password)]);
            break; // Exit loop once found
        }
    }

    if ($reset_account_type != '') {
        // Display password on the page instead of emailing
        $this->session->set_flashdata('success_message', 
            'Password reset! <strong>New Password: ' . $new_password . '</strong>');
        redirect(site_url('Login/forgot_password'), 'refresh');
    } else {
        // Show error on the same page without redirecting
        $this->session->set_flashdata('error_message', 'Email not found.');
        // Reload the current view with error
        $this->load->view('backend/login'); // Make sure this matches your view path
    }
}
    
    /*     * *****LOGOUT FUNCTION ****** */
    
    function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
        redirect(site_url('login'), 'refresh');
    }
}
