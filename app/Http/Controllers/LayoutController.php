<?php

namespace App\Http\Controllers;
use App\Models\LopHocPhan;
use Illuminate\Http\Request;

class LayoutController extends Controller
{
    protected $_data = array();

    public function _initialize_global($configs)
    {
        // $parse = parse_url(base_url());
        // $this->_data['host'] = $parse['host'];

        // $this->_data['site_name'] = $configs['site_name'];
        // $this->_data['title'] = $configs['site_name'];
    }
    // public function _initialize_user()
    // {
    //     $this->_data['logged_in'] = FALSE;
    //     if ($this->session->has_userdata('logged_in')) {
    //         $this->_data['logged_in'] = TRUE;
    //         $session_data = $this->session->userdata('logged_in');
    //         $this->_data['ma_tk'] = $session_data['ma_tk'];
    //         $this->_data['username'] = $session_data['username'];
    //         $this->_data['ho_ten'] = $session_data['ho_ten'];
    //         $this->_data['hinh_anh'] = $session_data['hinh_anh'];
    //         $this->_data['vai_tro'] = isset($session_data['vai_tro']) ? $session_data['vai_tro'] : '';
    //         $this->_data['ngay_tao'] = isset($session_data['ngay_tao']) ? $session_data['ngay_tao'] : '';
    //     }
    //     if ($this->session->has_userdata('logged_in_by')) {
    //         $this->_data['logged_in'] = TRUE;
    //         $session_data = $this->session->userdata('logged_in_by');
    //         $this->_data['ma_tk'] = $session_data['ma_tk'];
    //         $this->_data['username'] = $session_data['username'];
    //         $this->_data['ho_ten'] = $session_data['ho_ten'];
    //         $this->_data['hinh_anh'] = $session_data['hinh_anh'];
    //         $this->_data['vai_tro'] = isset($session_data['vai_tro']) ? $session_data['vai_tro'] : '';
    //         $this->_data['ngay_tao'] = isset($session_data['ngay_tao']) ? $session_data['ngay_tao'] : '';
    //     }
    // }

    public function _initialize()
    {

        // $this->_initialize_global($configs);

        // $this->_data['postcat_list'] = modules::run('posts/postcat/get_menu_list');
        // $this->_data['postcat_data'] = modules::run('posts/postcat/get_data');
        // $this->_data['postcat_input'] = modules::run('posts/postcat/get_input');

        // $this->_load_menu_main();

        //search
        // $this->_data['q'] = $this->input->get('q');

        // $info_hotline_none = modules::run('info/get_by_type', 'hotline', TRUE);
        // $this->_data['info_hotline_none'] = $info_hotline_none;
    }

    public function _initialize_admin()
    {
        // $configs = $this->get_configs();
        // $this->_initialize_global($configs);
        // $this->_initialize_user();

        // $this->_data['num_rows_contact'] = modules::run('contact/num_rows_new');
        // $this->_data['num_rows_order'] = modules::run('shops/orders/counts', array('viewed' => 0));
    }
    function index()
    {
        $this->_initialize();
        $args = array();
        $section_class_none = (new LopHocPhan())->gets($args);
        $this->_data['section_class_none'] = $section_class_none;
        
        $this->_data['type_side_none'] = 'home';
        $this->_data['left_side_none'] = $section_class_none;

       $this->_data['load_section_class'] = $section_class_none; 

        // $posts_news = modules::run('posts/get_items_cat_type', 'news', 0);
        // $partial = array();
        // $partial['data'] = $posts_news;
        // $this->_data['posts_news'] = $this->load->view('layout/site/partial/post_news', $partial, true);
        
        return view(config('asset.view_page')('main'), $this->_data);
    }
    function gets()
    {
        $args = '';
        $class = (new LopHocPhan)->gets($args);
        return $class;
    }
}
