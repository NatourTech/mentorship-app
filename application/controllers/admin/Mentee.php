<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mentee extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user() && !is_admin()) {
            redirect(base_url());
        }
    }


    public function all()
    {
        $data = array();
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/mentee/all');
        $total_row = $this->admin_model->get_all_mentees(1 , 0, 0);
        $config['total_rows'] = $total_row;
        $config['per_page'] = 15;
        $this->pagination->initialize($config);
        
        $page = $this->security->xss_clean($this->input->get('page'));
        if (empty($page)) {
            $page = 0;
        }
        if ($page != 0) {
            $page = $page - 1;
        }

        $data['page_title'] = 'Mentee';
        $data['packages'] = $this->admin_model->select('package');
        $data['users'] = $this->admin_model->get_all_mentees(0 , $config['per_page'], $page * $config['per_page']);
        $data['main_content'] = $this->load->view('admin/mentees', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function index()
    {   

        if(!empty($_GET['ref'])){
           $this->session->set_userdata('ref',$_GET['ref']); 
        }
        
        $data = array();
        $data['page_title'] = 'Mentee';
        $data['menu'] = TRUE;

        $data['mentees'] = $this->admin_model->get_mentor_mentees();
        $data['countries'] = $this->admin_model->select('country');
        $data['main_content'] = $this->load->view('admin/user/mentee', $data, TRUE);
        $this->load->view('admin/index', $data);
    }



    public function status_action($type, $id) 
    {

        $user = $this->admin_model->get_by_id($id, 'users');
        $url = base_url('admin/mentee/all');

        $data = array(
            'status' => $type
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'users');

        if($type == 1):

            if ($user->role == 'user') {
                $data = array();
                $data['name'] = $user->name;
                $message = $this->load->view('email_template/approved', $data, true);
                $this->email_model->send_email($user->email, $data['name'], $message);
            }

            $this->session->set_flashdata('msg', trans('activate-successfully')); 
        else:
            $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        endif;

        redirect(base_url('admin/mentees'));
    }

    public function change_account($id) 
    {
        $data = array(
            'account_type' => $this->input->post('type', false)
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'users');
        $this->session->set_flashdata('msg', trans('updated-successfully')); 
        redirect(base_url('admin/users'));
    }


    public function edit($id)
    {

        $data = array();

        $data['page_title'] = 'Users';
        $data['user'] = $this->admin_model->get_by_id($id,'users');
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['time_zones'] = $this->admin_model->select_asc('time_zone');
        //echo '<pre>'; print_r($data['user']); exit();
        $data['main_content'] = $this->load->view('admin/edit_mentee', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update_mentee(){
        check_status();

        $id = $this->input->post('id');


        $data = array(
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'phone' => $this->input->post('phone', true),
            'gender' => $this->input->post('gender', true),
            'country' => $this->input->post('country', true),
            'time_zone' => $this->input->post('time_zone', true),
        );
  
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'users');
        $this->session->set_flashdata('msg', trans('updated-successfully'));

        redirect(base_url('admin/mentees'));
    }


    public function delete($user_id)
    {
        check_status();
        $this->admin_model->delete($user_id,'users');
        echo json_encode(array('st' => 1));
        
    }


    

}
    

