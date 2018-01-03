<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User class.
 * 
 * @extends CI_Controller
 */
class User extends MY_Controller {
	/**
	 * __construct function.
	 * 
	 * @access public
	 * @return void
	 */
	public function __construct() {
		
        parent::__construct();
        // $this->_only_authen_success();
		$this->load->library(array('session'));
		$this->load->helper(array('url'));
        $this->load->model('user_model');
		$this->output->set_title('ระบบตรวจงานออนไลน์');
		$this->data['permission'] = $this->get_permission();
	}
	
	
	public function index() {
		
		
	}
	
	/**
	 * register function.
	 * 
	 * @access public
	 * @return void
	 */
	public function register() {
		$this->_only_authen_success();
        $this->_init('login');
        $this->_init_assets( array('icheck','bootstrap_validator') );
        
		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_numeric|min_length[4]|is_unique[users.username]', array('is_unique' => 'This username already exists. Please choose another one.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirm', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		
		if ($this->form_validation->run() === false) {
			
			// validation not ok, send validation errors to the view
            // $this->load->view('header');

			$this->load->view('user/register/register', $data);
			// $this->load->view('footer');
			
		} else {
			
			// set variables from the form
			$name = $this->input->post('name');
			$surname = $this->input->post('surname');
			$username = $this->input->post('username');
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
            $role = $this->input->post('role[0]');
            // echo $this->input->post('role[0]');
			// echo "<pre>"; print_r($_POST); echo "</pre>";
            
            if ($this->user_model->create_user($name, $surname, $role, $username, $email, $password)) {
				
				// user creation ok
				// $this->load->view('header');
				$this->load->view('user/register/register_success', $data);
				// $this->load->view('footer');
				
			} else {
				
				// user creation failed, this should never happen
				$data->error = 'There was a problem creating your new account. Please try again.';
				
				// send error to the view
				// $this->load->view('header');
				$this->load->view('user/register/register', $data);
				// $this->load->view('footer');
				
			}
			
		}
		
	}
		
	/**
	 * login function.
	 * 
	 * @access public
	 * @return void
	 */
	public function login() {

        $this->_init('login');
        $this->_init_assets( array('animate') );

		// create the data object
		$data = new stdClass();
		
		// load form helper and validation library
		$this->load->helper('form');
		$this->load->library( array('form_validation') );
		
		// set validation rules
		$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == false) {
			
			// validation not ok, send validation errors to the view
			$this->load->view('user/login/login');
			
		} else {
			
			// set variables from the form
			$username = $this->input->post('username');
			$password = $this->input->post('password');
			
			if ($this->user_model->resolve_user_login($username, $password)) {
				
				$user_id = $this->user_model->get_user_id_from_username($username);
				$user    = $this->user_model->get_user($user_id);
				
				// // set session user datas
				// $_SESSION['user_id']      = (int)$user->id;
				// $_SESSION['username']     = (string)$user->username;
				// $_SESSION['logged_in']    = (bool)true;
				// $_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
				// $_SESSION['is_admin']     = (bool)$user->is_admin;
                
                // set session user datas
                $customdata = array(
                    'username' => (string)$user->username
                    ,'name' => (string)$user->name
                    ,'surname' => (string)$user->surname
                    ,'role' => (string)$user->role
                    ,'logged_in' => (bool)true
                );                            
                $this->session->set_userdata($customdata);
				// user login ok
                redirect( site_url('/schedule/index/'));
				
			} else {
				
				// login failed
				$data->error = 'Wrong username or password.';
				
				// send error to the view
				$this->load->view('user/login/login', $data);
				
			}
			
		}
		
	}
	
	//--Authen with AD--//
	// public function login_ad() {

    //     $this->_init('login');
    //     $this->_init_assets( array('animate') );

	// 	// create the data object
	// 	$data = new stdClass();
		
	// 	// load form helper and validation library
	// 	$this->load->helper('form');
	// 	$this->load->library( array('form_validation') );
		
	// 	// set validation rules
	// 	$this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
	// 	$this->form_validation->set_rules('password', 'Password', 'required');
		
	// 	if ($this->form_validation->run() == false) {
			
	// 		// validation not ok, send validation errors to the view
	// 		$this->load->view('user/login/login');
			
	// 	} else {
			
	// 		// set variables from the form
	// 		$username = $this->input->post('username');
	// 		$password = $this->input->post('password');
			
	// 		if ($this->user_model->resolve_user_login($username, $password)) {
				
	// 			$user_id = $this->user_model->get_user_id_from_username($username);
	// 			$user    = $this->user_model->get_user($user_id);
				
	// 			// // set session user datas
	// 			// $_SESSION['user_id']      = (int)$user->id;
	// 			// $_SESSION['username']     = (string)$user->username;
	// 			// $_SESSION['logged_in']    = (bool)true;
	// 			// $_SESSION['is_confirmed'] = (bool)$user->is_confirmed;
	// 			// $_SESSION['is_admin']     = (bool)$user->is_admin;
                
    //             // set session user datas
    //             $customdata = array(
    //                 'username' => (string)$user->username
    //                 ,'name' => (string)$user->name
    //                 ,'surname' => (string)$user->surname
    //                 ,'role' => (string)$user->role
    //                 ,'logged_in' => (bool)true
    //             );                            
    //             $this->session->set_userdata($customdata);
	// 			// user login ok
    //             redirect( site_url('/schedule/index/'));
				
	// 		} else {
				
	// 			// login failed
	// 			$data->error = 'Wrong username or password.';
				
	// 			// send error to the view
	// 			$this->load->view('user/login/login', $data);
				
	// 		}
			
	// 	}
		
	// }
	//--/Authen with AD--//	

	/**
	 * logout function.
	 * 
	 * @access public
	 * @return void
	 */
	public function logout() {
		$this->_only_authen_success();
		// create the data object
		$data = new stdClass();
		
		if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

			// remove session datas
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
            }

			// user logout ok then redirect him to site root
			// $this->load->view('user/logout/logout_success', $data);
			redirect('/');
		} else {
			
			// there user was not logged in, we cannot logged him out,
			// redirect him to site root
			redirect('/');
			
		}
		
	}
	
}