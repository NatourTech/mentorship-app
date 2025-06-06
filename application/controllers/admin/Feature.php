<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feature extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if (!is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Feature';      
        $data['page'] = 'Feature';   
        $data['feature'] = FALSE;
        $data['features'] = $this->admin_model->select('features');
        $data['packages'] = $this->admin_model->select('package');
        $data['main_content'] = $this->load->view('admin/feature',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        if($_POST)
        {   
            check_status();
            
            $id = $this->input->post('id', true);

            $this->form_validation->set_rules('name', trans('name'), 'required');

            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/feature'));
            } else {
               
                $data=array(
                    'name' => $this->input->post('name', true),
                    'package_id' =>  $this->input->post('package_id', true),
                    'details' => $this->input->post('details', true)
                );
               
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'features');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'features');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                if($_FILES['photo']['name'] != ''){
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'features');   
                }
                redirect(base_url('admin/feature'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['packages'] = $this->admin_model->select('package');
        $data['feature'] = $this->admin_model->select_option($id, 'features');
        $data['main_content'] = $this->load->view('admin/feature',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'features');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/service'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'features');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/service'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'features'); 
        echo json_encode(array('st' => 1));
    }

}
	

