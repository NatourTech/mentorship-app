<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reports extends Home_Controller {

    public function __construct()
    {
        parent::__construct();
        //check auth
        if (!is_user() && !is_admin()) {
            redirect(base_url());
        }
    }


    public function index()
    {



        $data = array();
        $data['page_title'] = 'Reports'; 
        $data['page'] = 'Reports'; 

        if (is_user() || is_admin()) {
            $data['currency'] = settings()->currency_symbol;
            for ($i = 1; $i <= 13; $i++) {
                $months[] = '';
            }
            for ($i = 0; $i <= 11; $i++) {
                $income = '';
                $months[] = array("date" => month_show(date("Y-m", strtotime( date('Y-m-01')." -$i months"))));
                $incomes[] = array("total" => $income);
            }
        }
        $data['income_axis'] = json_encode(array_column($months, 'date'),JSON_NUMERIC_CHECK);
        $income_data = json_encode(array_column($incomes, 'total'),JSON_NUMERIC_CHECK);
        $income_data = str_replace('null', '0', $income_data);
        $data['income_data'] = $income_data;


        $data['sessions'] = $this->admin_model->get_top_booked_sessions();
        foreach ($data['sessions'] as $session) {
            $sessions[] = $session->name;
            $totals[] =  $session->total;
        }
        $data['session_axis'] = json_encode($sessions);
        $data['session_data'] = json_encode($totals);
        

        $data['mentees'] = $this->admin_model->get_top_mentees();

        if (is_admin()) {
            $data['mentors'] = $this->admin_model->get_top_mentors();
        }
        
        //echo "<pre>"; print_r($data['mentees']); exit();
        $data['countries'] = $this->admin_model->get_top_countries();
        $data['net_incomes'] = $this->admin_model->get_user_income_by_year();
        foreach ($data['net_incomes'] as $net_income) {
            $net_incomes[] = date("Y", strtotime($net_income->created_at));
            $total_net[] =  $net_income->total;
        }

        $data['net_axis'] = json_encode($net_incomes, JSON_NUMERIC_CHECK);
        $data['net_data'] = json_encode($total_net, JSON_NUMERIC_CHECK);
        //echo '<pre>'; print_r($data['countries']); exit();
        $data['main_content'] = $this->load->view('admin/user/reports',$data,TRUE);
        $this->load->view('admin/index',$data);
    }

}