<?php
class MY_Controller extends CI_Controller {

  // protected $data;

  public function __construct()
  {
    parent::__construct();
  }

  protected function _init($themes  = null){
    switch ($themes){
    case 'modal':
      $this->output->set_template('modal');
      break;
    // case 'bap':
    //   $this->output->set_template('default');
    //   break;
    // case 'nttyg':
    //   $this->output->set_template('default');
    //   break;
    default :
      $this->output->set_template('default');
      break;
    }

    // $this->only_auth_completed();
    // $this->output->set_output_data('user', $this->auth_ldap->row());

    $this->_init_assets( array('jquery', 'bootstrap', 'font-awesome', 'fastclick', 'nprogress','moment','custom',) );
    // $this->load->css('assets/css/custom.min.css');
    // $this->load->js('assets/js/custom.min.js');

  }

  protected function _init_assets($name = array())
  {
    if(is_array($name)){
      foreach ($name as $value) :
        $this->_init_assets($value);
      endforeach;
    }else{
      switch ($name) {

        case 'custom':
          $this->load->css('assets/css/custom.css');
          $this->load->js('assets/js/custom.js');
          break;

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
        
        case 'datatables':
          /*  */
          $this->load->js('assets/bower_components/datatables.net/js/jquery.dataTables.min.js');
        
          /*  */
          $this->load->css('assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css');
          $this->load->js('assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js');

          /*  */
          $this->load->css('assets/bower_components/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css');
          $this->load->js('assets/bower_components/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js');      
          
          /*  */
          $this->load->css('assets/bower_components/datatables.net-responsive-bs/css/responsive.bootstrap.min.css');
          $this->load->js('assets/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js');   
          $this->load->js('assets/bower_components/datatables.net-responsive-bs/js/responsive.bootstrap.js');   
          
          /*  */
          $this->load->css('assets/bower_components/datatables.net-scroller-bs/css/scroller.bootstrap.min.css');
          $this->load->js('assets/bower_components/datatables.net-scroller/js/dataTables.scroller.min.js');   
 
          /*  */
          $this->load->css('assets/bower_components/datatables.net-buttons-bs/css/buttons.bootstrap.min.css');
          $this->load->js('assets/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js');   
          $this->load->js('assets/bower_components/datatables.net-buttons-bs/js/buttons.bootstrap.min.js');   
          
          $this->load->js('assets/bower_components/datatables.net-buttons/js/buttons.flash.min.js');   
          $this->load->js('assets/bower_components/datatables.net-buttons/js/buttons.html5.min.js');   
          $this->load->js('assets/bower_components/datatables.net-buttons/js/buttons.print.min.js');   
          $this->load->js('assets/bower_components/datatables.net-keytable/js/dataTables.keyTable.min.js');                       
          break;

        case 'icheck':
          $this->load->css('assets/bower_components/iCheck/skins/flat/green.css');        
          $this->load->js('assets/bower_components/iCheck/icheck.min.js');
          break;     

        case 'jszip':
          $this->load->js('assets/bower_components/jszip/dist/jszip.min.js');
          break;         
          
        case 'pdfmake':
          $this->load->js('assets/bower_components/pdfmake/build/pdfmake.min.js');
          $this->load->js('assets/bower_components/pdfmake/build/vfs_fonts.js');
          break; 

        case 'smartwizard':
          $this->load->js('assets/bower_components/jQuery-Smart-Wizard/js/jquery.smartWizard.js');
          break;   

        case 'moment':
          $this->load->js('assets/bower_components/moment/moment.js');
          break;    


        case 'bootstrap_select':
          $this->load->css('assets/bower_components/bootstrap-select/dist/css/bootstrap-select.min.css');
          $this->load->js('assets/bower_components/bootstrap-select/dist/js/bootstrap-select.min.js');
          $this->load->js('assets/bower_components/bootstrap-select/dist/js/i18n/defaults-en_US.min.js');
          break;

        case 'bootstrap_select_ajax':
          $this->load->css('assets/bower_components/ajax-bootstrap-select/dist/css/ajax-bootstrap-select.min.css');
          $this->load->js('assets/bower_components/ajax-bootstrap-select/dist/js/ajax-bootstrap-select.min.js');
          break;

        case 'dropzone':
          $this->load->css('assets/bower_components/dropzone/dist/min/dropzone.min.css');
          $this->load->js('assets/bower_components/dropzone/dist/min/dropzone.min.js');
          break;          

        case 'validator':
          $this->load->js('assets/bower_components/validator/validator.js');
          // $this->load->js('assets/bower_components/dropzone/dist/min/dropzone.min.js');
          break;           

        case 'bootstrap-daterangepicker':
          $this->load->js('assets/bower_components/bootstrap-daterangepicker/daterangepicker.js');
          $this->load->css('assets/bower_components/bootstrap-daterangepicker/daterangepicker.css');
          break;    

        case 'bootstrap_validator':
          $this->load->js('assets/bower_components/bootstrap-validator/dist/validator.js');
          break;

        // case 'jquery_ui':
        //   $this->load->css('assets/bower_components/jquery-ui/themes/base/jquery-ui.min.css');
        //   $this->load->js('assets/bower_components/jquery-ui/jquery-ui.min.js');
        //   break;


        // case 'bootstrap_switch':
        //   $this->load->css('assets/bower_components/bootstrap-switch/dist/css/bootstrap3/bootstrap-switch.min.css');
        //   $this->load->js('assets/bower_components/bootstrap-switch/dist/js/bootstrap-switch.min.js');
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

        default:
          break;
      }
    }
  }            

}
?>