<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $this->all_users('all');
    }

    public function all_users($type)
    {

        $data = array();
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/users/all_users/'.$type);
        $total_row = $this->admin_model->get_all_users(1 , 0, 0, $type);
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

        $data['page_title'] = 'Users';
        $data['countries'] = $this->admin_model->select('country');
        $data['categories'] = $this->admin_model->select('categories');
        $data['users'] = $this->admin_model->get_all_users(0 , $config['per_page'], $page * $config['per_page'], $type);
        //echo '<pre>'; print_r($data['users']); exit();
        $data['main_content'] = $this->load->view('admin/users', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function mentor_details($id)
    {
        $data = array();
        $data['page'] = 'Users';   
        $data['page_title'] = 'Mentor Details';   
        $data['mentor'] = $this->admin_model->get_by_id($id, 'users');
        $data['sessions'] = $this->admin_model->get_mentor_sessions($data['mentor']->id);
        //echo '<pre>'; print_r($data['sessions']); exit();
        $data['main_content'] = $this->load->view('admin/user/mentor_details',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    public function mentees()
    {
        $data = array();
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/users/mentee');
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


    public function status_action($type, $id) 
    {

        $user = $this->admin_model->get_by_id($id, 'users');

        if ($user->role == 'user') {
            $url = base_url('admin/users');
        }else{
            $url = base_url('admin/mentee/all');
        }

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

        redirect($url);
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
        $data['categories'] = $this->admin_model->get_site_categories('categories');
        $data['skills'] = $this->admin_model->get_site_skills('skills');
        $data['user'] = $this->admin_model->get_by_id($id,'users');
        $data['user_skills'] = $this->admin_model->get_skill_by_user($id);
        $data['countries'] = $this->admin_model->select_asc('country');
        $data['time_zones'] = $this->admin_model->select_asc('time_zone');
        $data['main_content'] = $this->load->view('admin/edit_mentor', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function update_mentor(){
        check_status();

        $id = $this->input->post('id');

        $skills = $this->input->post('skill');


        $this->admin_model->skill_delete($id,'users_skill');

        foreach ($skills as $skill) {
            $udata = array(
                'user_id' => $id,
                'skill_id' => $skill,
            );
      
            $udata = $this->security->xss_clean($udata);
            $this->admin_model->insert($udata, 'users_skill');
        }


        $data = array(
            'name' => $this->input->post('name', true),
            'email' => $this->input->post('email', true),
            'phone' => $this->input->post('phone', true),
            'gender' => $this->input->post('gender', true),
            'language' => $this->input->post('language', true),
            'country' => $this->input->post('country', true),
            'time_zone' => $this->input->post('time_zone', true),
            'respond_in' => $this->input->post('respond_in', true),
            'respond_time' => $this->input->post('respond_time', true),
            'level' => $this->input->post('level', true),
            'experience_year' => $this->input->post('experience_year', true),
            'company' => $this->input->post('company', true),
            'category' => $this->input->post('category', true),
            'designation' => $this->input->post('designation', true),
        );
  
        $data = $this->security->xss_clean($data);
        $this->admin_model->edit_option($data, $id, 'users');
        $this->session->set_flashdata('msg', trans('updated-successfully'));

        redirect(base_url('admin/mentors'));
    }


    public function reset($id)
    {
        
        $data=array(
            'password' => hash_password('1234')
        );
        $data = $this->security->xss_clean($data);
        //$this->admin_model->edit_option($data, $id, 'users');
        echo json_encode(array('st'=> 1));
        
    }


    public function delete($user_id)
    {
        check_status();
        $this->admin_model->delete($user_id,'users'); 
        echo json_encode(array('st' => 1));
        
    }


}