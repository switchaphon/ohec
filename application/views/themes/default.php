<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><? echo $title; ?> </title>

    <!-- Load stylesheet and script -->
    <?  
      if(!empty($meta))
      foreach($meta as $name=>$content):
        echo "\n\t\t";
        echo "<meta name='".$name."' content='".$content."' />\n";
      endforeach;

      if(!empty($canonical)){
        echo "\n\t\t";
        echo "<link rel='canonical' href='".$canonical."' />\n";
      }
      // echo "\r\n\r\n";
      if(!empty($css)){
        echo "<!-- Stylesheet -->";
        foreach($css as $file){
          echo "\n\t\t";
          echo "<link rel='stylesheet' href='".$file."' type='text/css' />\n";
        } 
      }
      // echo "\r\n\r\n";
      if(!empty($js)){
        echo "<!-- Script -->";
        foreach($js as $file){
          echo "\n\t\t";
          echo "<script src='".$file."' /></script>";
        } 
      }
      // echo "\n\t";
    ?>
    <!-- /Load stylesheet and script -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- side bar -->
        <div class="col-md-3 left_col">
          <? $this->load->view('themes/_default_side'); ?>
        </div>
        <!-- /side bar -->

        <!-- top navigation -->
        <div class="top_nav">
          <? $this->load->view('themes/_default_top'); ?>
        </div>
        <!-- /top navigation -->

        <!-- page content --> 
        <? echo $output;?>
        <!-- /page content -->

        <!-- footer content --> 
        <? $this->load->view('themes/_default_footer'); ?>
        <!-- /footer content -->

      </div>

    </div>

    <!-- Custom Theme Scripts -->
    <script src="./assets/js/custom.min.js"></script>
  </body>
</html>
