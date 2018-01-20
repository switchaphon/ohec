<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
 * This file is part of Auth_Ldap.
    Auth_Ldap is free software: you can redistribute it and/or modify
    it under the terms of the GNU Lesser General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.
    Auth_Ldap is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.
    You should have received a copy of the GNU General Public License
    along with Auth_Ldap.  If not, see <http://www.gnu.org/licenses/>.
 * 
 */
/**
 * @author      Greg Wojtak <gwojtak@techrockdo.com>
 * @copyright   Copyright © 2010,2011 by Greg Wojtak <gwojtak@techrockdo.com>
 * @package     Auth_Ldap
 * @subpackage  auth demo
 * @license     GNU Lesser General Public License
 */
class Authen extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library(array('Form_validation','Authen_ldap','session','table'));
    }
    
    function index() {
        $this->session->keep_flashdata('tried_to');
        $this->login();
    }

    function login($errorMsg = NULL){
        $this->_init('login');
        $this->_init_assets( array('animate') );

        $this->session->keep_flashdata('tried_to');

        if(!$this->authen_ldap->is_authenticated()) {
            // Set up rules for form validation
            $rules = $this->form_validation;
            $rules->set_rules('username', 'Username', 'required');
            $rules->set_rules('password', 'Password', 'required');
            // Do the login...
            if($rules->run() && $this->authen_ldap->login(
                    $rules->set_value('username'),
                    $rules->set_value('password'))) {
                // Login WIN!
                if($this->session->flashdata('tried_to')) {
                    redirect($this->session->flashdata('tried_to'));
                }else {
                    redirect('/schedule/');
                }
            }else {
                // Login FAIL
                $this->load->view('auth/login', array('login_fail_msg'
                                        => 'Error with LDAP authen_ldap.'));
            }
        }else {
                // Already logged in...
                redirect('/schedule/');
        }
    }

    function logout() {
        if( $this->session->userdata('logged_in') ) {
            $data['name'] = $this->session->userdata('cn');
            $data['username'] = $this->session->userdata('username');
            $data['logged_in'] = TRUE;
            $this->authen_ldap->logout();
        } else {
            $data['logged_in'] = FALSE;
        }
            // redirect('/authen/login');
            redirect('/');
    }

/*
    function connect(){
        // using ldap bind
        $ldaprdn  = 'bi_mgmt@uni.net.th';     // ldap rdn or dn
        $ldappass = '[uwv@UniNet';  // associated password
        $ldapport = '389';
        $ldaphost = '202.28.197.36';

        // connect to ldap server
        $ldapconn = ldap_connect($ldaphost,$ldapport)
            or die("Could not connect to LDAP server.");

        if ($ldapconn) {
            // echo "\$ldapconn = ".$ldapconn." ".$ldaprdn." ".$ldappass;
            // binding to ldap server
            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);
            echo $ldapbind;
            // verify binding
            if ($ldapbind) {
                echo "LDAP bind successful...";
            } else {
                echo "LDAP bind failed...";
            }

        }
    }
*/

}
?>