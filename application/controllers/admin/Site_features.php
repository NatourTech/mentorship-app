<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Site_features extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_admin() && !is_user()) {
            redirect(base_url());
        }
    }


    public function index()
    {
        $data = array();
        $data['page_title'] = 'Features';     
        $data['page'] = 'Site_features';   
        $data['service'] = FALSE;
        $data['services'] = $this->admin_model->select('product_services');
        $data['languages'] = $this->admin_model->select('language');
        $data['main_content'] = $this->load->view('admin/site_features',$data,TRUE);
        $this->load->view('admin/index',$data);
    }


    public function add()
    {	
        check_status();
        
        if($_POST)
        {   
            $id = $this->input->post('id', true);

            //validate inputs
            $this->form_validation->set_rules('name', trans('name'), 'required');
            
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error', validation_errors());
                redirect(base_url('admin/site_features'));
            } else {

                if (empty($this->input->post('orders', true))) {
                    $orders = 0;
                }else{
                    $orders = $this->input->post('orders', true);
                }

                $data=array(
                    'lang_id' => $this->input->post('language', true),
                    'name' => $this->input->post('name', true),
                    'orders' => $orders,
                    'details' => $this->input->post('details', true)
                );
                $data = $this->security->xss_clean($data);
                
                //if id available info will be edited
                if ($id != '') {
                    $this->admin_model->edit_option($data, $id, 'product_services');
                    $this->session->set_flashdata('msg', trans('updated-successfully')); 
                } else {
                    $id = $this->admin_model->insert($data, 'product_services');
                    $this->session->set_flashdata('msg', trans('inserted-successfully')); 
                }

                // insert photos
                if($_FILES['photo']['name'] != ''){
                    ini_set("memory_limit","512M");
                    $up_load = $this->admin_model->upload_image('600');
                    $data_img = array(
                        'image' => $up_load['images'],
                        'thumb' => $up_load['thumb']
                    );
                    $this->admin_model->edit_option($data_img, $id, 'product_services');   
                }
                redirect(base_url('admin/site_features'));

            }
        }      
        
    }

    public function edit($id)
    {  
        $data = array();
        $data['page_title'] = 'Edit';   
        $data['service'] = $this->admin_model->select_option($id, 'product_services');
        $data['languages'] = $this->admin_model->select('language');
        $data['main_content'] = $this->load->view('admin/site_features',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

    
    public function active($id) 
    {
        $data = array(
            'status' => 1
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'product_services');
        $this->session->set_flashdata('msg', trans('activate-successfully')); 
        redirect(base_url('admin/site_features'));
    }

    public function deactive($id) 
    {
        $data = array(
            'status' => 0
        );
        $data = $this->security->xss_clean($data);
        $this->admin_model->update($data, $id,'product_services');
        $this->session->set_flashdata('msg', trans('deactivate-successfully')); 
        redirect(base_url('admin/site_features'));
    }

    public function delete($id)
    {
        $this->admin_model->delete($id,'product_services'); 
        echo json_encode(array('st' => 1));
    }

}
	

