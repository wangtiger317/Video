<?php
defined('BASEPATH') OR exit('No direct script access allowed ');
//require_once __DIR__ . "../../../../vendor/autoload.php";
use telesign\sdk\messaging\MessagingClient;

class User extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model('User_model');
        $this->load->model('Movie_model');
        $this->load->model('Review_model');
        $this->load->library('session');
        $this->load->library('email');
        $this->user_id = isset($this->session->get_userdata()['user_details'][0]->id) ? $this->session->get_userdata()['user_details'][0]->users_id : '1';
    }

    /**
     * This function is redirect to users profile page
     * @return Void
     */
//    public function index()
//    {
//        if (is_login()) {
//            redirect(base_url() . 'user/profile', 'refresh');
//        }
//    }


    public function index()
    {
        redirect(base_url() . 'user/profile', 'refresh');
    }
    /**
     * This function is used to load login view page
     * @return Void
     */
    public function login()
    {
        if (isset($_SESSION['user_details'])) {
            redirect(base_url() . 'user/profile', 'refresh');
        }
        $this->load->view('include/script');
        $this->load->view('login');
    }

    /**
     * This function is used to logout user
     * @return Void
     */
    public function logout()
    {
        is_login();
        $this->session->unset_userdata('user_details');
        redirect(base_url() . 'login', 'refresh');
    }

    /**
     * This function is used to registr user
     * @return Void
     */
    public function registration()
    {
        if (isset($_SESSION['user_details'])) {
            redirect(base_url() . 'user/profile', 'refresh');
        }
        //Check if admin allow to registration for user
        if (setting_all('register_allowed') == 1) {
            if ($this->input->post()) {
//                $this->add_edit();
                if ($this->input->post('password') == $this->input->post('confirmpassword')) {
                    $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                }
                $data = array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'password'=>$password,
                    'status'=>'active'
                );
                $id = $this->User_model->insertRow('users', $data);
                $this->session->set_flashdata('messagePr', 'Successfully Registered..');
                redirect(base_url() . 'login', 'refresh');
            } else {
                $this->load->view('include/script');
                $this->load->view('register');
            }
        } else {
            $this->session->set_flashdata('messagePr', 'Registration Not allowed..');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    public function saveprofile()
    {
        if ( $_FILES['profile_pic']['error'] > 0 ){
            echo 'Error: ' . $_FILES['profile_pic']['error'] . '<br>';
        }
        else {
            if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], 'assets/images/demo/' . $_FILES['profile_pic']['name'])) {}
        }
//        redirect(base_url() . 'user/profile', 'refresh');
        if ($this->input->post()) {
//                $this->add_edit();
            if ($this->input->post('password') == $this->input->post('confirmpassword')) {
                $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
            }
            $profile_pic = 'download.png';
            if (!empty($_FILES['profile_pic']['name'])) {
                $newname = $_FILES['profile_pic']['name'];
                $profile_pic = $newname;
            } else {
                if ($this->input->post('fileOld')) {
                    $newname = $this->input->post('fileOld');
                    $profile_pic = $newname;
                } else {
                    $profile_pic = 'download.png';
                }
            }
            if($this->input->post('password')){
                $data = array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'phone_number'=>$this->input->post('phone'),
                    'country'=>$this->input->post('country'),
                    'password'=>$password,
                    'profile_pic'=>$profile_pic,
                    'status'=>'active'
                );
            } else {
                $data = array(
                    'name'=>$this->input->post('name'),
                    'email'=>$this->input->post('email'),
                    'phone_number'=>$this->input->post('phone'),
                    'country'=>$this->input->post('country'),
//                'password'=>$password,
                    'profile_pic'=>$profile_pic,
                    'status'=>'active'
                );
            }
            $users_id = $this->session->userdata('user_details')[0]->users_id;
            $id = $this->User_model->updateRow('users', 'users_id', $users_id, $data);
            redirect(base_url() . 'user/profile', 'refresh');
        }
    }


    /**
     * This function is used for user authentication ( Working in login process )
     * @return Void
     */
    public function auth_user($page = '')
    {
        $return = $this->User_model->auth_user();
        if (empty($return)) {
            $this->session->set_flashdata('messagePr', 'Invalid details');
            redirect(base_url() . 'login', 'refresh');
        } else {
            if ($return == 'not_varified') {
                $this->session->set_flashdata('messagePr', 'This accout is not varified. Please contact to your admin..');
                redirect(base_url() . 'login', 'refresh');
            } else {
                $this->session->set_userdata('user_details', $return);
            }
            if($this->session->userdata('user_details')[0]->user_type=="admin")
                redirect(base_url() . 'user/adminprofile', 'refresh');
            elseif($this->session->userdata('user_details')[0]->user_type=="Member")
                redirect(base_url() . 'user/profile', 'refresh');
        }
    }

    /**
     * This function is Showing users profile
     * @return Void
     */
    public function profile($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['movies'] = $this->Movie_model->get_all_movies();
        $this->load->view('include/header');
        $this->load->view('profile', $data);
        $this->load->view('include/footer');
    }

    public function userprofile($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $this->load->view('include/header');
        $this->load->view('userprofile');
        $this->load->view('include/footer');
    }

    public function landingpage($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $this->load->view('include/header');
        $this->load->view('landingpage');
        $this->load->view('include/footer');
    }

    public function tvseries($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['movies'] = $this->Movie_model->get_all_movies();
        $this->load->view('include/header');
        $this->load->view('tvseries', $data);
        $this->load->view('include/footer');
    }

    public function movies($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['movies'] = $this->Movie_model->get_all_movies();
        $this->load->view('include/header');
        $this->load->view('movies', $data);
        $this->load->view('include/footer');
    }

    public function movieprofile($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $movie_id =  $_GET['id'];
        $data['movies'] = $this->Movie_model->get_all_movies();
        $data['movie_one'] = $this->Movie_model->get_movie_by_id($movie_id);
        $data['reviews'] = $this->Review_model->get_reviews($movie_id);
        $this->load->view('include/header');
        $this->load->view('movieprofile', $data);
        $this->load->view('include/footer');
    }

    public function add_review($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $movie_id =  $this->input->post('id');
        echo $movie_id;
        echo $this->input->post('comment');
        $data = array(
            'movie_id'=>$movie_id,
            'comments'=>$this->input->post('comment'),
            'author'=>$this->session->get_userdata()['user_details'][0]->name,
            'created_at'=>date("Y-m-d")
        );
        $result = $this->Review_model->insertRow('reviews', $data);
        redirect(base_url() . 'user/movieprofile?id=' . $movie_id, 'refresh');
    }

    public function playlists($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['movies'] = $this->Movie_model->get_all_movies();
        $this->load->view('include/header');
        $this->load->view('playlists', $data);
        $this->load->view('include/footer');
    }

    public function newarrivals($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['movies'] = $this->Movie_model->get_all_movies();
        $this->load->view('include/header');
        $this->load->view('newarrivals', $data);
        $this->load->view('include/footer');
    }

    public function comingsoon($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['movies'] = $this->Movie_model->get_all_movies();
        $this->load->view('include/header');
        $this->load->view('comingsoon', $data);
        $this->load->view('include/footer');
    }

    public function termsofuse()
    {
        $this->load->view('termsofuse');
    }

    public function privacypolicy()
    {
        $this->load->view('privacypolicy');
    }

    /**
     * This function is used send mail in forget password
     * @return Void
     */
    public function forgetpassword()
    {
        $page['title'] = 'Forgot Password';
        if ($this->input->post()) {
            $setting = settings();
            $res = $this->User_model->get_data_by('users', $this->input->post('email'), 'email', 1);
            if (isset($res[0]->users_id) && $res[0]->users_id != '') {
                $var_key = $this->getVarificationCode();
                $this->User_model->updateRow('users', 'users_id', $res[0]->users_id, array('var_key' => $var_key));
                $sub = "Reset password";
                $email = $this->input->post('email');
                $data = array(
                    'user_name' => $res[0]->name,
                    'action_url' => base_url(),
                    'sender_name' => $setting['company_name'],
                    'website_name' => $setting['website'],
                    'varification_link' => base_url() . 'user/mail_varify?code=' . $var_key,
                    'url_link' => base_url() . 'user/mail_varify?code=' . $var_key,
                );
                $body = $this->User_model->get_template('forgot_password');
                $body = $body->html;
                foreach ($data as $key => $value) {
                    $body = str_replace('{var_' . $key . '}', $value, $body);
                }
                if ($setting['mail_setting'] == 'php_mailer') {
                    $this->load->library("send_mail");
                    $emm = $this->send_mail->email($sub, $body, $email, $setting);
                } else {
                    // content-type is required when sending HTML email
                    $headers = "MIME-Version: 1.0" . "\r\n";
                    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers .= 'From: ' . $setting['EMAIL'] . "\r\n";
                    $emm = mail($email, $sub, $body, $headers);
                }
                if ($emm) {
                    $this->session->set_flashdata('messagePr', 'To reset your password, link has been sent to your email');
                    redirect(base_url() . 'login', 'refresh');
                }
            } else {
                $this->session->set_flashdata('forgotpassword', 'This account does not exist');//die;
                redirect(base_url() . "user/forgetpassword");
            }
        } else {
            $this->load->view('include/script');
            $this->load->view('forget_password');
        }
    }

    /**
     * This function is used to load view of reset password and varify user too
     * @return : void
     */
    public function mail_varify()
    {
        $return = $this->User_model->mail_varify();
        $this->load->view('include/script');
        if ($return) {
            $data['email'] = $return;
            $this->load->view('set_password', $data);
        } else {
            $data['email'] = 'allredyUsed';
            $this->load->view('set_password', $data);
        }
    }

    /**
     * This function is used to reset password in forget password process
     * @return : void
     */
    public function reset_password()
    {
        $return = $this->User_model->ResetPpassword();
        if ($return) {
            $this->session->set_flashdata('messagePr', 'Password Changed Successfully..');
            redirect(base_url() . 'login', 'refresh');
        } else {
            $this->session->set_flashdata('messagePr', 'Unable to update password');
            redirect(base_url() . 'login', 'refresh');
        }
    }

    /**
     * This function is generate hash code for random string
     * @return string
     */
    public function getVarificationCode()
    {
        $pw = $this->randomString();
        return $varificat_key = password_hash($pw, PASSWORD_DEFAULT);
    }

    public function adminuserTable()
    {
        is_login();
//        $this->load->view('include/script');
        $this->load->view('admin_user_table');

    }

    public function adminmoviesTable()
    {
        is_login();
//        $this->load->view('include/script');
        $this->load->view('admin_movies_table');

    }

    public function admincoverVideo()
    {
        is_login();
        $data['cover_video'] = $this->Movie_model->get_cover_video()[0]->video;
        $this->load->view('admin_cover_video', $data);

    }

    public function admincoverimages()
    {
        is_login();
        $data['logo_image'] = $this->Movie_model->get_logo()[0]->logoimage;
        $data['banner_image'] = $this->Movie_model->get_banner()[0]->image;
        $this->load->view('admin_cover_images', $data);

    }

    public function adminprofile($id = '')
    {
        is_login();
        if (!isset($id) || $id == '') {
            $id = $this->session->userdata('user_details')[0]->users_id;
        }
        $data['user_data'] = $this->User_model->get_users($id);
//        $this->load->view('include/header');
        $this->load->view('adminprofile', $data);
//        $this->load->view('include/footer');
    }
    /**
     * This function is used to create datatable in users list page
     * @return Void
     */
    public function dataTable()
    {
        is_login();
        $table = 'users';
        $primaryKey = 'users_id';
        $columns = array(
            array('db' => 'users_id', 'dt' => 0),
            array('db' => 'status', 'dt' => 1),
            array('db' => 'name', 'dt' => 2),
            array('db' => 'email', 'dt' => 3),
            array('db' => 'phone_number', 'dt' => 4),
            array('db' => 'users_id', 'dt' => 5)
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
        $where = array("user_type != 'admin'");
//        $output_arr = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where);

        $output_arr = array();
        $data = $this->User_model->get_members("member");
        $output_arr["draw"] = 0;
        $output_arr["recordsTotal"] = count($data);
        $output_arr["recordsFiltered"] = count($data);
        $new_data = [];
        $i = 0;
        foreach ($data as $row){
            $cur_row = array();
            $cur_row[0] = $row->users_id;
            $cur_row[1] = $row->status;
            $cur_row[2] = $row->name;
            $cur_row[3] = $row->email;
            $cur_row[4] = $row->phone_number;
            $cur_row[5] = $row->users_id;
            $new_data[$i++] = $cur_row;
        }
        $output_arr["data"] = $new_data;


        foreach ($output_arr['data'] as $key => $value) {
            $id = $output_arr['data'][$key][count($output_arr['data'][$key]) - 1];
            $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] = '';


            if (CheckPermission('user', "all_update")) {
                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a id="btnEditRow" class="modalButtonUser mClass btn btn-warning"  href="javascript:;" type="button" data-src="' . $id . '" title="Edit" style="padding:7px; color:white"><i class="fa fa-edit" data-id=""></i></a>';
            } else if (CheckPermission('user', "own_update") && (CheckPermission('user', "all_update") != true)) {
                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
                if ($user_id == $this->user_id) {
                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a id="btnEditRow" class="modalButtonUser mClass btn btn-warning"  href="javascript:;" type="button" data-src="' . $id . '" title="Edit" style="padding:7px; color:white"><i class="fa fa-edit" data-id=""></i></a>';
                }
            }

            if (CheckPermission('user', "all_delete")) {
                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;padding:7px 8px 7px 8px; color:white; margin-left:5px;" data-toggle="modal" class="mClass btn btn-danger" onclick="setId(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash" ></i></a>';
            } else if (CheckPermission('user', "own_delete") && (CheckPermission('user', "all_delete") != true)) {
                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
                if ($user_id == $this->user_id) {
                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;padding:7px 8px 7px 8px; color:white; margin-left:5px;" data-toggle="modal" class="mClass btn btn-danger" onclick="setId(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash" ></i></a>';
                }
            }
//            if (CheckPermission('user', "all_delete")) {
//                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendSMS(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send SMS"><i class="fa fa-send-o" ></i></a>';
//            } else if (CheckPermission('user', "own_delete") && (CheckPermission('user', "all_delete") != true)) {
//                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
//                if ($user_id == $this->user_id) {
//                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendSMS(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send SMS"><i class="fa fa-send-o" ></i></a>';
//                }
//            }
//
//            if (CheckPermission('user', "all_delete")) {
//                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendEmail(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send Email"><i class="fa fa-mail-forward" ></i></a>';
//            } else if (CheckPermission('user', "own_delete") && (CheckPermission('user', "all_delete") != true)) {
//                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
//                if ($user_id == $this->user_id) {
//                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendEmail(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send Email"><i class="fa fa-mail-forward" ></i></a>';
//                }
//            }
            $output_arr['data'][$key][0] = '<input type="checkbox" name="selData" value="' . $output_arr['data'][$key][0] . '">';
        }
        echo json_encode($output_arr);
    }



    public function moviedataTable()
    {
        is_login();
        $table = 'movies';
        $primaryKey = 'id';
        $columns = array(
            array('db' => 'id', 'dt' => 0),
            array('db' => 'id', 'dt' => 1),
            array('db' => 'title', 'dt' => 2),
            array('db' => 'image', 'dt' => 3),
            array('db' => 'rating', 'dt' => 4),
            array('db' => 'id', 'dt' => 5)
        );

        $sql_details = array(
            'user' => $this->db->username,
            'pass' => $this->db->password,
            'db' => $this->db->database,
            'host' => $this->db->hostname
        );
        $where = array("user_type != 'admin'");
//        $output_arr = SSP::complex($_GET, $sql_details, $table, $primaryKey, $columns, $where);

        $output_arr = array();
        $data = $this->Movie_model->get_all_movies();
        $output_arr["draw"] = 0;
        $output_arr["recordsTotal"] = count($data);
        $output_arr["recordsFiltered"] = count($data);
        $new_data = [];
        $i = 0;
        foreach ($data as $row){
            $cur_row = array();
            $cur_row[0] = $row->id;
            $cur_row[1] = $row->id;
            $cur_row[2] = $row->title;
            $cur_row[3] = $row->image;
            $cur_row[4] = $row->rating;
            $cur_row[5] = $row->id;
            $new_data[$i++] = $cur_row;
        }
        $output_arr["data"] = $new_data;


        foreach ($output_arr['data'] as $key => $value) {
            $id = $output_arr['data'][$key][count($output_arr['data'][$key]) - 1];
            $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] = '';


            if (CheckPermission('user', "all_update")) {
                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a id="btnEditRow" class="modalButtonMovie mClass btn btn-warning"  href="javascript:;" type="button" data-src="' . $id . '" title="Edit" style="padding:7px; color:white"><i class="fa fa-edit" data-id=""></i></a>';
            } else if (CheckPermission('user', "own_update") && (CheckPermission('user', "all_update") != true)) {
                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
                if ($user_id == $this->user_id) {
                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a id="btnEditRow" class="modalButtonMovie mClass btn btn-warning"  href="javascript:;" type="button" data-src="' . $id . '" title="Edit" style="padding:7px; color:white"><i class="fa fa-edit" data-id=""></i></a>';
                }
            }

            if (CheckPermission('user', "all_delete")) {
                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;padding:7px 8px 7px 8px; color:white; margin-left:5px;" data-toggle="modal" class="mClass btn btn-danger" onclick="setmovieId(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash" ></i></a>';
            } else if (CheckPermission('user', "own_delete") && (CheckPermission('user', "all_delete") != true)) {
                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
                if ($user_id == $this->user_id) {
                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;padding:7px 8px 7px 8px; color:white; margin-left:5px;" data-toggle="modal" class="mClass btn btn-danger" onclick="setmovieId(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="delete"><i class="fa fa-trash" ></i></a>';
                }
            }
//            if (CheckPermission('user', "all_delete")) {
//                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendSMS(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send SMS"><i class="fa fa-send-o" ></i></a>';
//            } else if (CheckPermission('user', "own_delete") && (CheckPermission('user', "all_delete") != true)) {
//                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
//                if ($user_id == $this->user_id) {
//                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendSMS(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send SMS"><i class="fa fa-send-o" ></i></a>';
//                }
//            }
//
//            if (CheckPermission('user', "all_delete")) {
//                $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendEmail(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send Email"><i class="fa fa-mail-forward" ></i></a>';
//            } else if (CheckPermission('user', "own_delete") && (CheckPermission('user', "all_delete") != true)) {
//                $user_id = getRowByTableColomId($table, $id, 'users_id', 'user_id');
//                if ($user_id == $this->user_id) {
//                    $output_arr['data'][$key][count($output_arr['data'][$key]) - 1] .= '<a style="cursor:pointer;" class="mClass" onclick="sendEmail(' . $id . ', \'user\')" data-target="#cnfrm_delete" title="Send Email"><i class="fa fa-mail-forward" ></i></a>';
//                }
//            }
            $output_arr['data'][$key][0] = '<input type="checkbox" name="selData" value="' . $output_arr['data'][$key][0] . '">';
        }
        echo json_encode($output_arr);
    }

    /**
     * This function is used to show popup of user to add and update
     * @return Void
     */



    public function get_modal()
    {
        is_login();
        if ($this->input->post('id')) {
            $data['userData'] = getDataByid('users', $this->input->post('id'), 'users_id');
            echo $this->load->view('add_user', $data, true);
        } else {
            echo $this->load->view('add_user', '', true);
        }
        exit;
    }


    public function get_modal_movie()
    {
        is_login();
        if ($this->input->post('id')) {
            $data['userData'] = getDataByid('movies', $this->input->post('id'), 'id');
            echo $this->load->view('add_movie', $data, true);
        } else {
            echo $this->load->view('add_movie', '', true);
        }
        exit;
    }


    /**
     * This function is used to upload file
     * @return Void
     */
    function upload()
    {
        foreach ($_FILES as $name => $fileInfo) {
            $filename = $_FILES[$name]['name'];
            $tmpname = $_FILES[$name]['tmp_name'];
            $exp = explode('.', $filename);
            $ext = end($exp);
            $newname = $exp[0] . '_' . time() . "." . $ext;
            $config['upload_path'] = 'assets/images/demo/';
            $config['upload_url'] = base_url() . 'assets/images/demo/';
            $config['allowed_types'] = "gif|jpg|jpeg|png|iso|dmg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|csv|ods|odt|odp|pdf|rtf|sxc|sxi|txt|exe|avi|mpeg|mp3|mp4|3gp";
            $config['max_size'] = '2000000';
            $config['file_name'] = $newname;
            $this->load->library('upload', $config);
            move_uploaded_file($tmpname, "assets/images/demo/" . $newname);
            return $newname;
        }
    }

    /**
     * This function is used to add and update users
     * @return Void
     */
    public function send_sms(){
//        $api_client = new Client();
//        $current_customer_id = $this->input->post('customer_id');
//        $current_users = $this->User_model->get_users($current_customer_id);
//        $phone_number = $current_users[0]->phone_number;
//        $res = $api_client->request('GET', 'http://localhost/cms/send_sms.php?current_customer_id='.$current_customer_id.'&phone_number='.$phone_number);
//        echo $res->getBody();

        $customer_id = "AF45FEC9-6B78-4264-A104-3EECA13E558C";
        $api_key = "NZXA/cNbHBa0NVM/fpfQ56ls+xQ79i0B0Sq0vRc3tRNXR09Zk95Xr+sAPTnbGFjQ6XgzcjFx42lLZ+GC9zD8Ng==";
        $current_customer_id = $this->input->post('customer_id');
        $current_users = $this->User_model->get_users($current_customer_id);
        $phone_number = $current_users[0]->phone_number;
        $message = "Tell us what you think.\nThanks for your business!\nHow would you rate your experiences?\nIf you want to remain a reviewModel, please click here: http://3a3537d8.ngrok.io/customermanagementsystem/about/customer_reviews/".$current_customer_id;
        $message_type = "ARN";
        $messaging = new MessagingClient($customer_id, $api_key);
        $response = $messaging->message($phone_number, $message, $message_type);
        //echo $response;
        print_r($response->json);
        //echo $message;
    }

    /**
    *This function is used to send Email to the clients.
     **/

    public function send_email(){
        $current_customer_id = $this->input->post('customer_id');
        $sendgrid_api_key = "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";
        $email = new \SendGrid\Mail\Mail();
        $email->setFrom("info.advanceddentistry@gmail.com", "Liverpool");
        $email->setSubject("Sending with SendGrid is Fun");
        $email->addTo("ptfe0310g@gmail.com", "Example User");
        //$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
        $email_content = "Tell us what you think.\nThanks for your business!\nHow would you rate your experiences?\nIf you want to remain a reviewModel, please click here: http://63615acf.ngrok.io/customermanagementsystem/about/customer_reviews/".$current_customer_id;
        //$email_content = "Hello I have implemented email function as you can see. I hope we can contact as soon as possible. Thank you!";
        $email->addContent(
            "text/html", $email_content
        );
        $sendgrid = new \SendGrid($sendgrid_api_key);
        try {
            $response = $sendgrid->send($email);
            print $response->statusCode() . "\n";
            print_r($response->headers());
            print $response->body() . "\n";
        } catch (Exception $e) {
            echo 'Caught exception: '. $e->getMessage() ."\n";
        }
    }
    public function add_edit($id = '')
    {
        $data = $this->input->post();
        $profile_pic = 'user.png';
        if ($this->input->post('users_id')) {
            $id = $this->input->post('users_id');
        }
        if (isset($this->session->userdata('user_details')[0]->users_id)) {
            if ($this->input->post('users_id') == $this->session->userdata('user_details')[0]->users_id) {
                $redirect = 'adminprofile';
            } else {
                $redirect = 'adminuserTable';
            }
        } else {
            $redirect = 'login';
        }
        if ($this->input->post('fileOld')) {
            $newname = $this->input->post('fileOld');
            $profile_pic = $newname;
        } else {
            $data['name'] = '';
            $profile_pic = 'user.png';
        }
        foreach ($_FILES as $name => $fileInfo) {
            if (!empty($_FILES[$name]['name'])) {
                $newname = $this->upload();
                $data[$name] = $newname;
                $profile_pic = $newname;
            } else {
                if ($this->input->post('fileOld')) {
                    $newname = $this->input->post('fileOld');
                    $data[$name] = $newname;
                    $profile_pic = $newname;
                } else {
                    $data[$name] = '';
                    $profile_pic = 'user.png';
                }
            }
        }
        if ($id != '') {
            $data = $this->input->post();
            if ($this->input->post('status') != '') {
                $data['status'] = $this->input->post('status');
            }
            if ($this->input->post('users_id') == 1) {
                $data['user_type'] = 'admin';
            }
            if ($this->input->post('password') != '') {
                if ($this->input->post('currentpassword') != '') {
                    $old_row = getDataByid('users', $this->input->post('users_id'), 'users_id');
                    if (password_verify($this->input->post('currentpassword'), $old_row->password)) {
                        if ($this->input->post('password') == $this->input->post('confirmPassword')) {
                            $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                            $data['password'] = $password;
                        } else {
                            $this->session->set_flashdata('messagePr', 'Password and confirm password should be same...');
                            redirect(base_url() . 'user/' . $redirect, 'refresh');
                        }
                    } else {
                        $this->session->set_flashdata('messagePr', 'Enter Valid Current Password...');
                        redirect(base_url() . 'user/' . $redirect, 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('messagePr', 'Current password is required');
                    redirect(base_url() . 'user/' . $redirect, 'refresh');
                }
            }
            $id = $this->input->post('users_id');
            unset($data['fileOld']);
            unset($data['currentpassword']);
            unset($data['confirmPassword']);
            unset($data['users_id']);
            unset($data['user_type']);
            if (isset($data['edit'])) {
                unset($data['edit']);
            }
            if ($data['password'] == '') {
                unset($data['password']);
            }
            $data['profile_pic'] = $profile_pic;
            $this->User_model->updateRow('users', 'users_id', $id, $data);
            $this->session->set_flashdata('messagePr', 'Your data updated Successfully..');
            redirect(base_url() . 'user/' . $redirect, 'refresh');
        } else {
            if ($this->input->post('user_type') != 'admin') {
                $data = $this->input->post();
                //$password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
                $checkValue = $this->User_model->check_exists('users', 'email', $this->input->post('email'));
                if ($checkValue == false) {
                    $this->session->set_flashdata('messagePr', 'This Email Already Registered with us..');
                    redirect(base_url() . 'user/adminuserTable', 'refresh');
                }
                $checkValue1 = $this->User_model->check_exists('users', 'name', $this->input->post('name'));
                if ($checkValue1 == false) {
                    $this->session->set_flashdata('messagePr', 'Username Already Registered with us..');
                    redirect(base_url() . 'user/adminuserTable', 'refresh');
                }
                $data['status'] = 'active';
                if (setting_all('admin_approval') == 1) {
                    $data['status'] = 'deleted';
                }

                if ($this->input->post('status') != '') {
                    $data['status'] = $this->input->post('status');
                }
                //$data['token'] = $this->generate_token();
                $data['user_id'] = $this->user_id;
                //$data['password'] = $password;
                $data['profile_pic'] = $profile_pic;
                $data['is_deleted'] = 0;
//                if(isset($data['password_confirmation'])){
//                    unset($data['password_confirmation']);
//                }
                if (isset($data['call_from'])) {
                    unset($data['call_from']);
                }
                unset($data['submit']);
                $this->User_model->insertRow('users', $data);
                redirect(base_url() . 'user/' . $redirect, 'refresh');
            } else {
                $this->session->set_flashdata('messagePr', 'You Don\'t have this autherity ');
                redirect(base_url() . 'user/registration', 'refresh');
            }
        }

    }


    public function add_edit_movie($id = '')
    {
//        $data = $this->input->post();
        $image = $this->input->post('image_name');
        $title = $this->input->post('title');
        $rating = $this->input->post('rating');
        if ($this->input->post('id')) {
            $id = $this->input->post('id');
        }
        if (isset($this->session->userdata('user_details')[0]->users_id)) {
            $redirect = 'adminmoviesTable';
        } else {
            $redirect = 'login';
        }

        if ($id != '') {
            $data['title'] = $title;
            $data['rating'] = $rating;
            $data['image'] = $image;
            $result = $this->Movie_model->updateRow("movies", "id", $id, $data);
            redirect(base_url() . 'user/adminmoviesTable', 'refresh');
        } else {
            $data['title'] = $title;
            $data['rating'] = $rating;
            $data['image'] = $image;
            $result = $this->Movie_model->insertRow("movies", $data);
            redirect(base_url() . 'user/adminmoviesTable', 'refresh');
        }

    }

    /**
     * This function is used to delete users
     * @return Void
     */
    public function delete($id)
    {
        is_login();
        $ids = explode('-', $id);
        foreach ($ids as $id) {
            $this->User_model->delete($id);
        }
        redirect(base_url() . 'user/adminuserTable', 'refresh');
    }

    public function delete_movie($id)
    {
        is_login();
        $ids = explode('-', $id);
        foreach ($ids as $id) {
            $this->Movie_model->delete($id);
        }
        redirect(base_url() . 'user/adminmoviesTable', 'refresh');
    }

    /**
     * This function is used to send invitation mail to users for registration
     * @return Void
     */
    public function InvitePeople()
    {
        is_login();
        if ($this->input->post('emails')) {
            $setting = settings();
            $var_key = $this->randomString();
            $emailArray = explode(',', $this->input->post('emails'));
            $emailArray = array_map('trim', $emailArray);
            $body = $this->User_model->get_template('invitation');
            $result['existCount'] = 0;
            $result['seccessCount'] = 0;
            $result['invalidEmailCount'] = 0;
            $result['noTemplate'] = 0;
            if (isset($body->html) && $body->html != '') {
                $body = $body->html;
                foreach ($emailArray as $mailKey => $mailValue) {
                    if (filter_var($mailValue, FILTER_VALIDATE_EMAIL)) {
                        $res = $this->User_model->get_data_by('users', $mailValue, 'email');
                        if (is_array($res) && empty($res)) {
                            $link = (string)'<a href="' . base_url() . 'user/registration?invited=' . $var_key . '">Click here</a>';
                            $data = array('var_user_email' => $mailValue, 'var_inviation_link' => $link);
                            foreach ($data as $key => $value) {
                                $body = str_replace('{' . $key . '}', $value, $body);
                            }
                            if ($setting['mail_setting'] == 'php_mailer') {
                                $this->load->library("send_mail");
                                $emm = $this->send_mail->email('Invitation for registration', $body, $mailValue, $setting);
                            } else {
                                // content-type is required when sending HTML email
                                $headers = "MIME-Version: 1.0" . "\r\n";
                                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                                $headers .= 'From: ' . $setting['EMAIL'] . "\r\n";
                                $emm = mail($mailValue, 'Invitation for registration', $body, $headers);
                            }
                            if ($emm) {
                                $darr = array('email' => $mailValue, 'var_key' => $var_key);
                                $this->User_model->insertRow('users', $darr);
                                $result['seccessCount'] += 1;;
                            }
                        } else {
                            $result['existCount'] += 1;
                        }
                    } else {
                        $result['invalidEmailCount'] += 1;
                    }
                }
            } else {
                $result['noTemplate'] = 'No Email Template Availabale.';
            }
        }
        echo json_encode($result);
        exit;
    }

    /**
     * This function is used to Check invitation code for user registration
     * @return TRUE/FALSE
     */
    public function chekInvitation()
    {
        if ($this->input->post('code') && $this->input->post('code') != '') {
            $res = $this->User_model->get_data_by('users', $this->input->post('code'), 'var_key');
            $result = array();
            if (is_array($res) && !empty($res)) {
                $result['email'] = $res[0]->email;
                $result['users_id'] = $res[0]->users_id;
                $result['result'] = 'success';
            } else {
                $this->session->set_flashdata('messagePr', 'This code is not valid..');
                $result['result'] = 'error';
            }
        }
        echo json_encode($result);
        exit;
    }

    /**
     * This function is used to registr invited user
     * @return Void
     */
    public function register_invited($id)
    {
        $data = $this->input->post();
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $data['password'] = $password;
        $data['var_key'] = NULL;
        $data['is_deleted'] = 0;
        $data['status'] = 'active';
        $data['user_id'] = 1;
        if (isset($data['password_confirmation'])) {
            unset($data['password_confirmation']);
        }
        if (isset($data['call_from'])) {
            unset($data['call_from']);
        }
        if (isset($data['submit'])) {
            unset($data['submit']);
        }
        $this->User_model->updateRow('users', 'users_id', $id, $data);
        $this->session->set_flashdata('messagePr', 'Successfully Registered..');
        redirect(base_url() . 'login', 'refresh');
    }

    /**
     * This function is used to check email is alredy exist or not
     * @return TRUE/FALSE
     */
    public function checEmailExist()
    {
        $result = 1;
        $res = $this->User_model->get_data_by('users', $this->input->post('email'), 'email');
        if (!empty($res)) {
            if ($res[0]->users_id != $this->input->post('uId')) {
                $result = 0;
            }
        }
        echo $result;
        exit;
    }

    /**
     * This function is used to Generate a token for varification
     * @return String
     */
    public function generate_token()
    {
        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha);
        $numeric = "0123456789";
        $special = ".-+=_,!@$#*%<>[]{}";
        $chars = $alpha . $alpha_upper . $numeric;
        $token = '';
        $up_lp_char = $alpha . $alpha_upper . $special;
        $chars = str_shuffle($chars);
        $token = substr($chars, 10, 10) . strtotime("now") . substr($up_lp_char, 8, 8);
        return $token;
    }

    /**
     * This function is used to Generate a random string
     * @return String
     */
    public function randomString()
    {
        $alpha = "abcdefghijklmnopqrstuvwxyz";
        $alpha_upper = strtoupper($alpha);
        $numeric = "0123456789";
        $special = ".-+=_,!@$#*%<>[]{}";
        $chars = $alpha . $alpha_upper . $numeric;
        $pw = '';
        $chars = str_shuffle($chars);
        $pw = substr($chars, 8, 8);
        return $pw;
    }


    public function removerow(){
        $id = $_GET['id'];
        $this->Movie_model->delete($id);
        echo true;
    }

    public function updaterow(){
        $id = $_GET['id'];
        $values = $_GET['values'];
        $th_names = $_GET['th_names'];
        $table = $_GET['table'];
        for ($i = 1; $i < count($th_names); $i++){
            $data = array($th_names[$i]=>$values[$i]);
            $this->Movie_model->updateRow($table, 'id', $id, $data);
        }
    }

    public function insertRow(){
        $values = $_GET['values'];
        $th_names = $_GET['th_names'];
        $table = $_GET['table'];
        $data = array();
        for ($i = 1; $i < count($th_names); $i++){
            $data[$th_names[$i]] = $values[$i];
        }
        $this->Movie_model->insertRow($table, $data);
        echo $data['name'];

    }

    public function imgupload() {
        is_login();
        if ( $_FILES['file']['error'] > 0 ){
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'assets/images/movies/' . $_FILES['file']['name']))
            {
                echo 'assets/images/movies/' . $_FILES['file']['name'];
            }
        }
    }

    public function covervideoupload() {
        is_login();
        if ( $_FILES['file']['error'] > 0 ){
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'assets/' . $_FILES['file']['name']))
            {
                $data['video'] = $_FILES['file']['name'];
                $this->Movie_model->update_cover_video($data);
                echo $_FILES['file']['name'];
            }
        }

    }

    public function logoupload() {
        is_login();
        if ( $_FILES['file']['error'] > 0 ){
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'assets/images/' . $_FILES['file']['name']))
            {
                $data['logoimage'] = $_FILES['file']['name'];
                $this->Movie_model->update_logo($data);
                echo $_FILES['file']['name'];
            }
        }

    }

    public function bannerupload() {
        is_login();
        if ( $_FILES['file']['error'] > 0 ){
            echo 'Error: ' . $_FILES['file']['error'] . '<br>';
        }
        else {
            if(move_uploaded_file($_FILES['file']['tmp_name'], 'assets/images/banners/' . $_FILES['file']['name']))
            {
                $data['image'] = $_FILES['file']['name'];
                $this->Movie_model->update_banner($data);
                echo $_FILES['file']['name'];
            }
        }

    }
}
