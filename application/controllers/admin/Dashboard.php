<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Home_Controller {

	public function __construct()
    {
        parent::__construct();
    }

    
    public function index()
    {

        if (!is_admin()) {
            redirect(base_url());
        }

        $data = array();
        $data['page'] = 'Dashboard';
        $data['page_title'] = 'Dashboard';
        $data['currency'] = settings()->currency_symbol;
        for ($i = 1; $i <= 13; $i++) {
            $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
        }

        for ($i = 0; $i <= 11; $i++) {
            $income = $this->admin_model->get_admin_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
            $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
            $incomes[] = array("total" => $income);
        }



        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $income_data = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $income_data = str_replace('null', '0', $income_data);
        $data['income_data'] = $income_data;
        $data['net_income'] = $this->admin_model->get_admin_income_by_year();
        $data['users'] = $this->admin_model->get_latest_users();
        $data['main_content'] = $this->load->view('admin/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function user()
    { 

        

        if(date("Y-m-d") != user()->attendence_date){
            $data = array(
                'total_attendence' => user()->total_attendence + 1,
                'attendence_date' => date("Y-m-d"),
            );
            $this->admin_model->edit_option($data,  user()->id, 'users');
        }

        

        $data = array();
        $data['page'] = 'Dashboard';
        $data['page_title'] = 'User Dashboard';
        if (is_user()) {
            $data['currency'] = settings()->currency_symbol;
            for ($i = 1; $i <= 13; $i++) {
                $months[] = date("Y-m", strtotime( date('Y-m-01')." -$i months"));
            }

            for ($i = 0; $i <= 11; $i++) {
                $income = $this->admin_model->get_user_income_by_date(date("Y-m", strtotime( date('Y-m-01')." -$i months")));
                $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
                $incomes[] = array("total" => $income);
            }
        }
        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $income_data = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $income_data = str_replace('null', '0', $income_data);
        $data['income_data'] = $income_data;
        $data['net_income'] = $this->admin_model->get_user_income_by_year();
        $data['total_net_income'] = get_pres_values();
        $data['user_mentees'] = $this->common_model->get_all_user_mentees(user()->id);
        $data['bookings'] = $this->admin_model->get_latest_bookings();
        //echo "<pre>"; print_r($data['bookings']); exit();
        $data['appointments'] = FALSE;
        $data['main_content'] = $this->load->view('admin/user/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function mentee()
    { 
        $data = array();
        $data['page'] = 'Dashboard';
        $data['page_title'] = 'Mentee Dashboard';
        $data['bookings'] = $this->admin_model->get_latest_bookings();
        $data['mentee_mentors'] = $this->common_model->get_all_mentee_mentors(user()->id);
        $data['main_content'] = $this->load->view('admin/user/dash', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function app_info()
    {
        $data = array();
        $data['page_title'] = 'App Info';
        $data['main_content'] = $this->load->view('admin/about_info', $data, TRUE);
        $this->load->view('admin/index', $data);
    }

    public function rating()
    {
        $data = array();
        $data['page_title'] = 'Ratings';
        $data['ratings'] = $this->admin_model->get_all_ratings();
        $data['rating'] = $this->admin_model->get_ratings_info();
        $data['report'] = $this->admin_model->get_single_ratings();
        $data['main_content'] = $this->load->view('admin/user/rating_report', $data, TRUE);
        $this->load->view('admin/index', $data);
    }


    public function rating_update($status)
    {
        $data = array(
            'enable_rating' => $status
        );
        $this->admin_model->edit_option($data, user()->id, 'users');
        echo json_encode(array('st'=>1));
    }

    public function update_settings()
    {
        if (settings()->country != $this->business->country) {
            $data = array(
                'country' => settings()->country
            );
            $this->admin_model->edit_option($data,  $this->business->id, 'business');
        }
    }


}