<?php
class MY_Controller extends CI_Controller {

  // protected $data;

  public function __construct()
  {
    parent::__construct();
  }

  protected function _init($themes  = null){
    switch ($themes){
    case 'dmc':
      $this->output->set_template('dmc');
      break;
    case 'bap':
      $this->output->set_template('default');
      break;
    case 'nttyg':
      $this->output->set_template('default');
      break;
    default :
      $this->output->set_template('default');
      break;
    }

    // $this->only_auth_completed();
    // $this->output->set_output_data('user', $this->auth_ldap->row());

    $this->_init_assets( array('jquery', 'bootstrap', 'font-awesome', 'fastclick', 'nprogress', 'custom') );
    // $this->load->css('assets/css/core.css');
  }

  protected function _init_assets($name = array())
  {
    if(is_array($name)){
      foreach ($name as $value) :
        $this->_init_assets($value);
      endforeach;
    }else{
      switch ($name) {

        case 'jquery':
          $this->load->js('assets/bower_components/jquery/dist/jquery.min.js');
          break;

        case 'bootstrap':
          $this->load->css('assets/bower_components/bootstrap/dist/css/bootstrap.min.css');
          $this->load->js('assets/bower_components/bootstrap/dist/js/bootstrap.min.js');
          break;

        case 'font-awesome':
          $this->load->css('assets/bower_components/font-awesome/css/font-awesome.min.css');
          break;

        case 'fastclick':
          $this->load->js('assets/bower_components/fastclick/lib/fastclick.js');
          break;

        case 'nprogress':
          $this->load->css('assets/bower_components/nprogress/nprogress.css');
          $this->load->js('assets/bower_components/nprogress/nprogress.js');
          break;
        
        case 'custom':
          $this->load->css('assets/css/custom.min.css');
          // $this->load->js('assets/js/custom.min.js');
          break;


        // case 'jquery_ui':
        //   $this->load->css('assets/bower_components/jquery-ui/themes/base/jquery-ui.min.css');
        //   $this->load->js('assets/bower_components/jquery-ui/jquery-ui.min.js');
        //   break;

        // case 'bootstrap_select':
        //   $this->load->css('assets/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css');
        //   $this->load->js('assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js');
        //   $this->load->js('assets/bower_components/bootstrap-select/dist/js/i18n/defaults-en_US.min.js');
        //   break;

        // case 'bootstrap_select_ajax':
        //   $this->load->css('assets/bower_components/ajax-bootstrap-select/dist/css/ajax-bootstrap-select.min.css');
        //   $this->load->js('assets/bower_components/ajax-bootstrap-select/dist/js/ajax-bootstrap-select.min.js');
        //   break;

        // case 'bootstrap_switch':
        //   $this->load->css('assets/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css');
        //   $this->load->js('assets/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js');
        //   break;

        // case 'bootstrap_validator':
        //   $this->load->js('assets/bower_components/bootstrap-validator/dist/validator.js');
        //   break;

        // case 'flatpickr':
        //   $this->load->css('assets/bower_components/flatpickr/dist/flatpickr.min.css');
        //   $this->load->js('assets/bower_components/flatpickr/dist/flatpickr.min.js');
        //   break;

        // case 'datetimepicker':
        //   $this->load->js('assets/bower_components/moment/min/moment.min.js');
        //   $this->load->css('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css');
        //   $this->load->js('assets/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js');
        //   break;



        // case 'datatable':
        //   // #############  main datatable  #############
        //   $this->load->js('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');
        //   // #############  bootstarp datatable  #############
        //   $this->load->css('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
        //   $this->load->js('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');
        //   // #############  fixedHeader  #############
        //   $this->load->css('assets/bower_components/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css');
        //   $this->load->js('assets/bower_components/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');
        //   // #############  select  #############
        //   $this->load->css('assets/bower_components/datatables.net-select-dt/css/select.dataTables.min.css');
        //   $this->load->js('assets/bower_components/datatables.net-select/js/dataTables.select.min.js');
        //   break;

        default:
          break;
      }
    }
  }            

}
?>