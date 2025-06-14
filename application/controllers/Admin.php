<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 *     @author : Ali Reza Habibi
 *     shahreyarhabibi@gmail.com
 */

class Admin extends CI_Controller
{
    public $benchmark;
            public $hooks;
            public $config;
            public $log;
            public $utf8;
            public $uri;
            public $exceptions;
            public $router;
            public $output;

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('crud_model');
        $this->load->model('email_model');

        
        // cache control
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
    }
    
    // default function, redirects to login page if no admin logged in yet
    
    public function index()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url('login'), 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(site_url('admin/dashboard'), 'refresh');
    }
    
    // ADMIN DASHBOARD
    
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
    
        // Total patients (existing)
        $page_data['total_patients'] = $this->db->count_all('patient');
    
        // Total appointments
        $page_data['total_appointments'] = $this->db->count_all('appointment');
    
        // Total invoices
        $page_data['total_invoices'] = $this->db->count_all('invoice');
        $page_data['total_tests'] = $this->db->count_all('pathology_report');
    
        // Current day
        $current_day_start = date('Y-m-d 00:00:00');
        $current_day_end = date('Y-m-d 23:59:59');
    
        // Previous day
        $previous_day_start = date('Y-m-d 00:00:00', strtotime('-1 day'));
        $previous_day_end = date('Y-m-d 23:59:59', strtotime('-1 day'));
    
        // Patients in current day
        $page_data['current_day_count'] = $this->db
            ->where('created_at >=', $current_day_start)
            ->where('created_at <=', $current_day_end)
            ->count_all_results('patient');
    
        // Patients in previous day
        $page_data['previous_day_count'] = $this->db
            ->where('created_at >=', $previous_day_start)
            ->where('created_at <=', $previous_day_end)
            ->count_all_results('patient');
    
        // Calculate patient difference
        $page_data['patient_difference'] = $page_data['current_day_count'] - $page_data['previous_day_count'];
    
        // Calculate patient percentage change (with zero-division protection)
        $page_data['percentage_change'] = ($page_data['previous_day_count'] > 0)
            ? (round(($page_data['patient_difference'] / $page_data['previous_day_count']) * 100, 1))
            : ($page_data['current_day_count'] > 0 ? 100 : 0);
    
        // Appointments in current day
        $current_day_appointments = $this->db
            ->where('created_at >=', $current_day_start)
            ->where('created_at <=', $current_day_end)
            ->count_all_results('appointment');
    
        // Appointments in previous day
        $previous_day_appointments = $this->db
            ->where('created_at >=', $previous_day_start)
            ->where('created_at <=', $previous_day_end)
            ->count_all_results('appointment');
    
        // Calculate appointment difference
        $page_data['appointment_difference'] = $current_day_appointments - $previous_day_appointments;
    
        // Calculate appointment percentage change (with zero-division protection)
        $page_data['appointment_percentage_change'] = ($previous_day_appointments > 0)
            ? (round(($page_data['appointment_difference'] / $previous_day_appointments) * 100, 1))
            : ($current_day_appointments > 0 ? 100 : 0);
    
        // Pass appointment data to the view
        $page_data['current_day_appointments'] = $current_day_appointments;
        $page_data['previous_day_appointments'] = $previous_day_appointments;
    
        // Invoices in current day
$current_day_invoices = $this->db
->where('created_at >=', $current_day_start)
->where('created_at <=', $current_day_end)
->count_all_results('invoice');

// Invoices in previous day
$previous_day_invoices = $this->db
->where('created_at >=', $previous_day_start)
->where('created_at <=', $previous_day_end)
->count_all_results('invoice');

// Calculate invoice difference
$invoice_difference = $current_day_invoices - $previous_day_invoices;

// Calculate invoice percentage change (with zero-division protection)
$invoice_percentage_change = ($previous_day_invoices > 0)
? (round(($invoice_difference / $previous_day_invoices) * 100, 1))
: ($current_day_invoices > 0 ? 100 : 0);

// Pass invoices data to the view
$page_data['current_day_invoices'] = $current_day_invoices;
$page_data['previous_day_invoices'] = $previous_day_invoices;
$page_data['invoice_difference'] = $invoice_difference;
$page_data['invoice_percentage_change'] = $invoice_percentage_change;

        // Tests in current day
        $current_day_tests = $this->db
        ->where('created_at >=', $current_day_start)
        ->where('created_at <=', $current_day_end)
        ->count_all_results('pathology_report');
        
        // Tests in previous day
        $previous_day_tests = $this->db
        ->where('created_at >=', $previous_day_start)
        ->where('created_at <=', $previous_day_end)
        ->count_all_results('pathology_report');
        
        // Calculate invoice difference
        $test_difference = $current_day_tests - $previous_day_tests;
        
        // Calculate invoice percentage change (with zero-division protection)
        $test_percentage_change = ($previous_day_tests > 0)
        ? (round(($test_difference / $previous_day_tests) * 100, 1))
        : ($current_day_tests > 0 ? 100 : 0);
        
        // Pass invoice data to the view
        $page_data['current_day_tests'] = $current_day_tests;
        $page_data['previous_day_tests'] = $previous_day_tests;
        $page_data['test_difference'] = $test_difference;
        $page_data['test_percentage_change'] = $test_percentage_change;
        
        // Load helper in constructor if not loaded already
$this->load->helper('json');

// Initialize an array to hold daily income
$daily_income = [];

// Loop through the last 7 days
for ($i = 6; $i >= 0; $i--) {
    $date = date('Y-m-d', strtotime("-$i days")); // Get the date for the last 7 days
    $invoices = $this->db->where('DATE(created_at)', $date)->get('invoice')->result_array(); // Fetch invoices for that date

    $sum = 0; // Initialize sum for the day's income
    foreach ($invoices as $invoice) {
        $entries = json_decode($invoice['invoice_entries'], true); // Decode JSON

        $entries_total = 0;
        if (is_array($entries)) {
            foreach ($entries as $entry) {
                // Sum amount (convert string to float)
                $entries_total += floatval($entry['amount']);
            }
        }
        
        // Calculate total for this invoice: entries total - discount + VAT
        $discount = floatval($invoice['discount_amount']);
        $vat = floatval($invoice['vat_percentage']);
        $invoice_total = $entries_total - $discount + $vat;
        
        $sum += $invoice_total; // Add to the day's total
    }
    
    $daily_income[$date] = round($sum, 2); // Store the total income for that day
}

// Pass daily income to the view
$page_data['daily_income'] = $daily_income;

// Calculate total income (if still needed)
$total_income = array_sum($daily_income); // Sum of daily incomes
$page_data['total_income'] = $total_income;

// Define age groups
$age_groups = [
    '0-18' => 0,
    '19-35' => 0,
    '36-50' => 0,
    '51-65' => 0,
    '66+' => 0,
];

// Fetch all patients' ages
$patients = $this->db->select('age')->get('patient')->result_array();

foreach ($patients as $patient) {
    $age = intval($patient['age']);
    if ($age <= 18) {
        $age_groups['0-18']++;
    } elseif ($age <= 35) {
        $age_groups['19-35']++;
    } elseif ($age <= 50) {
        $age_groups['36-50']++;
    } elseif ($age <= 65) {
        $age_groups['51-65']++;
    } else {
        $age_groups['66+']++;
    }
}

// Pass to view
$page_data['age_distribution'] = $age_groups;

$page_data['page_name'] = 'dashboard';
$page_data['page_title'] = get_phrase('admin_dashboard');

$this->load->view('backend/index', $page_data);

    }
    
    // LANGUAGE SETTINGS
    
    function manage_language($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }

        if ($param1 == 'edit_phrase') {
            $page_data['edit_profile'] = $param2;
        }
    
        if ($param1 == 'do_update') {
            $language        = $this->input->post('language');
            $data[$language] = $this->input->post('phrase');
            $this->db->where('phrase_id', $param2);
            $this->db->update('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_phrase') {
            $data['phrase'] = $this->input->post('phrase');
            $this->db->insert('language', $data);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'add_language') {
            $language = $this->input->post('language');
            $this->load->dbforge();
            $fields = array(
                $language => array(
                    'type' => 'LONGTEXT'
                )
            );
            $this->dbforge->add_column('language', $fields);
            
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        if ($param1 == 'delete_language') {
            $language = $param2;
            $this->load->dbforge();
            $this->dbforge->drop_column('language', $language);
            $this->session->set_flashdata('message', get_phrase('settings_updated'));
            
            redirect(site_url('admin/manage_language'), 'refresh');
        }
        $page_data['page_name']  = 'manage_language';
        $page_data['page_title'] = get_phrase('manage_language');
        $this->load->view('backend/index', $page_data);
    }

    // Used to update the language directly from header
    public function set_language()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(site_url(), 'refresh');
    
        $language = $this->input->post('language');
    
        // Update language
        $this->db->where('type', 'language');
        $this->db->update('settings', ['description' => $language]);
    
        // Determine text_align based on language
        if (strtolower($language) == 'persian' || strtolower($language) == 'pashto') {
            $text_align = 'right-to-left';
        } else {
            $text_align = 'left-to-right';
        }
    
        // Update text_align
        $this->db->where('type', 'text_align');
        $this->db->update('settings', ['description' => $text_align]);
    
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function update_phrase_with_ajax() {
        $checker['phrase_id']                = $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')] = $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id']);
        $this->db->update('language', $updater);

        echo $checker['phrase_id'].' '.$this->input->post('currentEditingLanguage').' '.$this->input->post('updatedValue');
    }
    
    /*     * ****MANAGE OWN PROFILE AND CHANGE PASSWORD** */
    
    function manage_profile($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'update_profile_info') {
            $data['name']  = $this->input->post('name');
            $data['email'] = $this->input->post('email');
            $validation    = email_validation_on_edit($data['email'], $this->session->userdata('login_user_id'), 'admin');
            if ($validation == 1) {
                $returned_array = null_checking($data);
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', $returned_array);
                $this->session->set_flashdata('message', get_phrase('profile_info_updated_successfuly'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            } else {
                $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            }
            
        }
        if ($param1 == 'change_password') {
            $current_password_input = sha1($this->input->post('password'));
            $new_password           = sha1($this->input->post('new_password'));
            $confirm_new_password   = sha1($this->input->post('confirm_new_password'));
            
            $current_password_db = $this->db->get_where('admin', array(
                'admin_id' => $this->session->userdata('login_user_id')
            ))->row()->password;
            
            if ($current_password_db == $current_password_input && $new_password == $confirm_new_password) {
                $this->db->where('admin_id', $this->session->userdata('login_user_id'));
                $this->db->update('admin', array(
                    'password' => $new_password
                ));
                
                $this->session->set_flashdata('message', get_phrase('password_info_updated_successfuly'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            } else {
                $this->session->set_flashdata('message', get_phrase('password_update_failed'));
                redirect(site_url('admin/manage_profile'), 'refresh');
            }
        }
        $page_data['page_name']  = 'manage_profile';
        $page_data['page_title'] = get_phrase('manage_profile');
        $page_data['edit_data']  = $this->db->get_where('admin', array(
            'admin_id' => $this->session->userdata('login_user_id')
        ))->result_array();
        $this->load->view('backend/index', $page_data);
    }
    
    function department($task = "", $department_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_department_info();
            $this->session->set_flashdata('message', get_phrase('department_info_saved_successfuly'));
            redirect(site_url('admin/department'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_department_info($department_id);
            $this->session->set_flashdata('message', get_phrase('department_info_updated_successfuly'));
            redirect(site_url('admin/department'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_department_info($department_id);
            redirect(site_url('admin/department'), 'refresh');
        }
        
        $data['department_info'] = $this->crud_model->select_department_info();
        $data['page_name']       = 'manage_department';
        $data['page_title']      = get_phrase('department');
        $this->load->view('backend/index', $data);
    }
    
    function department_facilities($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'add') {
            $this->frontend_model->add_department_facility($param2);
            $this->session->set_flashdata('message', get_phrase('facility_saved_successfully'));
            redirect(site_url('admin/department_facilities/' . $param2), 'refresh');
        }
        
        if ($param1 == 'edit') {
            $this->frontend_model->edit_department_facility($param2);
            $this->session->set_flashdata('message', get_phrase('facility_updated_successfully'));
            redirect(site_url('admin/department_facilities/' . $param3), 'refresh');
        }
        
        if ($param1 == 'delete') {
            $this->frontend_model->delete_department_facility($param2);
            $this->session->set_flashdata('message', get_phrase('facility_deleted_successfully'));
            redirect(site_url('admin/department_facilities/' . $param3), 'refresh');
        }
        
        $data['department_info'] = $this->frontend_model->get_department_info($param1);
        $data['facilities']      = $this->frontend_model->get_department_facilities($param1);
        $data['page_name']       = 'department_facilities';
        $data['page_title']      = get_phrase('department_facilities') . ' | ' . $data['department_info']->name . ' ' . get_phrase('department');
        $this->load->view('backend/index', $data);
    }
    
    function doctor($task = "", $doctor_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        if ($task == "create") {
            $email      = $_POST['email'];
            $validation = email_validation_on_create($email);
            
            if ($validation == 1) {
                $this->crud_model->save_doctor_info();
                $this->session->set_flashdata('message', get_phrase('doctor_info_saved_successfuly'));
            } else {
                $this->session->set_flashdata('error_message', get_phrase('duplicate_email'));
            }
            redirect(site_url('admin/doctor'), 'refresh');
        }
        if ($task == "update") {
            $this->crud_model->update_doctor_info($doctor_id);
            redirect(site_url('admin/doctor'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_doctor_info($doctor_id);
            redirect(site_url('admin/doctor'), 'refresh');
        }
        $data['doctor_info'] = $this->crud_model->select_doctor_info();
        $data['page_name']   = 'manage_doctor';
        $data['page_title']  = get_phrase('doctor');
        $this->load->view('backend/index', $data);
    }
    
    function patient($task = "", $patient_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_patient_info();
            $this->session->set_flashdata('message', get_phrase('patient_info_saved_successfuly'));
            redirect(site_url('admin/patient'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_patient_info($patient_id);
            redirect(site_url('admin/patient'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_patient_info($patient_id);
            redirect(site_url('admin/patient'), 'refresh');
        }
        
        $data['patient_info'] = $this->crud_model->select_patient_info();
        $data['page_name']    = 'manage_patient';
        $data['page_title']   = get_phrase('patient');
        $this->load->view('backend/index', $data);
    }
    
    function nurse($task = "", $nurse_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_nurse_info();
            $this->session->set_flashdata('message', get_phrase('nurse_info_saved_successfuly'));
            redirect(site_url('admin/nurse'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_nurse_info($nurse_id);
            redirect(site_url('admin/nurse'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_nurse_info($nurse_id);
            redirect(site_url('admin/nurse'), 'refresh');
        }
        
        $data['nurse_info'] = $this->crud_model->select_nurse_info();
        $data['page_name']  = 'manage_nurse';
        $data['page_title'] = get_phrase('nurse');
        $this->load->view('backend/index', $data);
    }
    
    function pharmacist($task = "", $pharmacist_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_pharmacist_info();
            $this->session->set_flashdata('message', get_phrase('pharmacist_info_saved_successfuly'));
            redirect(site_url('admin/pharmacist'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_pharmacist_info($pharmacist_id);
            redirect(site_url('admin/pharmacist'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_pharmacist_info($pharmacist_id);
            redirect(site_url('admin/pharmacist'), 'refresh');
        }
        
        $data['pharmacist_info'] = $this->crud_model->select_pharmacist_info();
        $data['page_name']       = 'manage_pharmacist';
        $data['page_title']      = get_phrase('pharmacist');
        $this->load->view('backend/index', $data);
    }
    
    function laboratorist($task = "", $laboratorist_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_laboratorist_info();
            $this->session->set_flashdata('message', get_phrase('laboratorist_info_saved_successfuly'));
            redirect(site_url('admin/laboratorist'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_laboratorist_info($laboratorist_id);
            redirect(site_url('admin/laboratorist'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_laboratorist_info($laboratorist_id);
            redirect(site_url('admin/laboratorist'), 'refresh');
        }
        
        $data['laboratorist_info'] = $this->crud_model->select_laboratorist_info();
        $data['page_name']         = 'manage_laboratorist';
        $data['page_title']        = get_phrase('laboratorist');
        $this->load->view('backend/index', $data);
    }
    
    function accountant($task = "", $accountant_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_accountant_info();
            $this->session->set_flashdata('message', get_phrase('accountant_info_saved_successfuly'));
            redirect(site_url('admin/accountant'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_accountant_info($accountant_id);
            redirect(site_url('admin/accountant'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_accountant_info($accountant_id);
            redirect(site_url('admin/accountant'), 'refresh');
        }
        
        $data['accountant_info'] = $this->crud_model->select_accountant_info();
        $data['page_name']       = 'manage_accountant';
        $data['page_title']      = get_phrase('accountant');
        $this->load->view('backend/index', $data);
    }
    
    function receptionist($task = "", $receptionist_id = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($task == "create") {
            $this->crud_model->save_receptionist_info();
            $this->session->set_flashdata('message', get_phrase('receptionist_info_saved_successfuly'));
            redirect(site_url('admin/receptionist'), 'refresh');
        }
        
        if ($task == "update") {
            $this->crud_model->update_receptionist_info($receptionist_id);
            redirect(site_url('admin/receptionist'), 'refresh');
        }
        
        if ($task == "delete") {
            $this->crud_model->delete_receptionist_info($receptionist_id);
            redirect(site_url('admin/receptionist'), 'refresh');
        }
        
        $data['receptionist_info'] = $this->crud_model->select_receptionist_info();
        $data['page_name']         = 'manage_receptionist';
        $data['page_title']        = get_phrase('receptionist');
        $this->load->view('backend/index', $data);
    }
    
    function payment_history($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['invoice_info'] = $this->crud_model->select_invoice_info();
        $data['page_name']    = 'show_payment_history';
        $data['page_title']   = get_phrase('payment_history');
        $this->load->view('backend/index', $data);
    }
    
    function bed_allotment($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['bed_allotment_info'] = $this->crud_model->select_bed_allotment_info();
        $data['page_name']          = 'show_bed_allotment';
        $data['page_title']         = get_phrase('bed_allotment');
        $this->load->view('backend/index', $data);
    }
    
    function blood_bank($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['blood_bank_info'] = $this->crud_model->select_blood_bank_info();
        $data['page_name']       = 'show_blood_bank';
        $data['page_title']      = get_phrase('blood_bank');
        $this->load->view('backend/index', $data);
    }
    
    function blood_donor($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['blood_donor_info'] = $this->crud_model->select_blood_donor_info();
        $data['page_name']        = 'show_blood_donor';
        $data['page_title']       = get_phrase('blood_donor');
        $this->load->view('backend/index', $data);
    }
    
    function medicine($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['medicine_info'] = $this->crud_model->select_medicine_info();
        $data['page_name']     = 'show_medicine';
        $data['page_title']    = get_phrase('medicine');
        $this->load->view('backend/index', $data);
    }
    
    function operation_report($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'show_operation_report';
        $data['page_title'] = get_phrase('operation_report');
        $this->load->view('backend/index', $data);
    }
    
    function birth_report($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'show_birth_report';
        $data['page_title'] = get_phrase('birth_report');
        $this->load->view('backend/index', $data);
    }
    
    function death_report($task = "")
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $data['page_name']  = 'show_death_report';
        $data['page_title'] = get_phrase('death_report');
        $this->load->view('backend/index', $data);
    }

    
    // PAYROLL
    function payroll()
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        $page_data['page_name']  = 'payroll_add';
        $page_data['page_title'] = get_phrase('create_payroll');
        $this->load->view('backend/index', $page_data);
    }
    
    function payroll_selector()
    {
        $user        = explode('-', $this->input->post('employee_id'));
        $user_type   = $user[0];
        $employee_id = $user[1];
        $month       = $this->input->post('month');
        $year        = $this->input->post('year');
        
        redirect(site_url('admin/payroll_view/' . $user_type . '/' . $employee_id . '/' . $month . '/' . $year), 'refresh');
    }
    
    function payroll_view($user_type = '', $employee_id = '', $month = '', $year = '')
    {
        $page_data['user_type']   = $user_type;
        $page_data['employee_id'] = $employee_id;
        $page_data['month']       = $month;
        $page_data['year']        = $year;
        $page_data['page_name']   = 'payroll_add_view';
        $page_data['page_title']  = get_phrase('create_payroll');
        $this->load->view('backend/index', $page_data);
    }
    
    function create_payroll()
    {
        $data['payroll_code']   = substr(md5(rand(100000000, 20000000000)), 0, 7);
        $data['user_id']        = $this->input->post('user_id');
        $data['user_type']      = $this->input->post('user_type');
        $data['joining_salary'] = $this->input->post('joining_salary');
        
        $allowances        = array();
        $allowance_types   = $this->input->post('allowance_type');
        $allowance_amounts = $this->input->post('allowance_amount');
        $number_of_entries = sizeof($allowance_types);
        
        for ($i = 0; $i < $number_of_entries; $i++) {
            if ($allowance_types[$i] != "" && $allowance_amounts[$i] != "") {
                $new_entry = array(
                    'type' => $allowance_types[$i],
                    'amount' => $allowance_amounts[$i]
                );
                array_push($allowances, $new_entry);
            }
        }
        $data['allowances'] = json_encode($allowances);
        
        $deductions        = array();
        $deduction_types   = $this->input->post('deduction_type');
        $deduction_amounts = $this->input->post('deduction_amount');
        $number_of_entries = sizeof($deduction_types);
        
        for ($i = 0; $i < $number_of_entries; $i++) {
            if ($deduction_types[$i] != "" && $deduction_amounts[$i] != "") {
                $new_entry = array(
                    'type' => $deduction_types[$i],
                    'amount' => $deduction_amounts[$i]
                );
                array_push($deductions, $new_entry);
            }
        }
        $data['deductions'] = json_encode($deductions);
        $data['date']       = $this->input->post('month') . ',' . $this->input->post('year');
        $data['status']     = $this->input->post('status');
        
        $this->db->insert('payroll', $data);
        
        $this->session->set_flashdata('message', get_phrase('data_created_successfully'));
        redirect(site_url('admin/payroll_list'), 'refresh');
    }
    
    function payroll_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('admin_login') != 1) {
            $this->session->set_userdata('last_page', current_url());
            redirect(site_url(), 'refresh');
        }
        
        if ($param1 == 'mark_paid') {
            $data['status'] = 1;
            
            $this->db->update('payroll', $data, array(
                'payroll_id' => $param2
            ));
            
            $this->session->set_flashdata('message', get_phrase('data_updated_successfully'));
            redirect(site_url('admin/payroll_list'), 'refresh');
        }
        
        $page_data['page_name']  = 'payroll_list';
        $page_data['page_title'] = get_phrase('payroll_list');
        $this->load->view('backend/index', $page_data);
    }
}  