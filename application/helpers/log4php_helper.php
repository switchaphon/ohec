<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// if ( ! function_exists('log_error') ) {
// 	function log_error($message) {
// 		static $_log;
// 		if (config_item('log_threshold') == 0) return;
// 		$_log =& load_class('Log');
// 		$_log->write_log('error', $message, false);
// 	}
// }

// if ( ! function_exists('log_info') ) {
// 	function log_info($message) {
// 		static $_log;
// 		if (config_item('log_threshold') == 0) return;
// 		$_log =& load_class('Log');
// 		$_log->write_log('info', $message, false);
// 	}
// }

// if ( ! function_exists('log_debug') ) {
// 	function log_debug($message) {
// 		static $_log;
// 		if (config_item('log_threshold') == 0) return;
// 		$_log =& load_class('Log');
// 		$_log->write_log('debug', $message, false);
// 	}
// }

if ( ! function_exists('log_error') ) {
	function log_error($message) {
		static $_log;
		// if (config_item('log_threshold') == 0) return;
		$_log =& load_class('Log');
		$_CI =& get_instance();
		$name = 'eform';
		$_log->setLogger($name);
		$_log->write_log('error', $message, false);
		$_log->setLogger();
	}
}

if ( ! function_exists('log_info') ) {
	function log_info($message) {
		static $_log;
		// if (config_item('log_threshold') == 0) return;
		$_log =& load_class('Log');
		$_CI =& get_instance();
		$name = 'eform';
		$_log->setLogger($name);
		$_log->write_log('info', $message, false);
		$_log->setLogger();
	}
}

if ( ! function_exists('log_debug') ) {
	function log_debug($message) {
		static $_log;
		// if (config_item('log_threshold') == 0) return;
		$_log =& load_class('Log');
		$_CI =& get_instance();
		if ($_CI->authen_ldap->is_authenticated())
		{
			$name = "eform.{$_CI->authen_ldap->row()->mail}";
		}
		else
		{
			$name = 'eform';
		}
		$_log->setLogger($name);
		$_log->write_log('debug', $message, false);
		$_log->setLogger();
	}
}

if ( ! function_exists('log_agent') ) {
	function log_agent($message='') {
		static $_log;
		if (config_item('log_threshold') == 0) return;
		$_log =& load_class('Log');
		$_CI =& get_instance();
		if ($_CI->authen_ldap->is_authenticated())
		{
			$name = "agents.{$_CI->authen_ldap->row()->mail}";
		}
		else
		{
			$name = 'agents';
		}
		if($message==='')
		{
			$_CI->load->library('user_agent');

			if ($_CI->agent->is_browser())
			{
        $agent = $_CI->agent->browser().' '.$_CI->agent->version();
			}
			elseif ($_CI->agent->is_robot())
			{
        $agent = $_CI->agent->robot();
			}
			elseif ($_CI->agent->is_mobile())
			{
        $agent = $_CI->agent->mobile();
			}
			else
			{
        $agent = 'Unidentified User Agent';
			}

			$message = "agent:{$agent} platform:{$_CI->agent->platform()}";
		}
		$_log->setLogger($name);
		$_log->write_log('debug', $message, false);
		$_log->setLogger();
	}
}
