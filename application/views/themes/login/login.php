<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><? echo $title; ?> </title>

    <!-- Load assets -->
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

      if(!empty($css)){
        echo "<!-- Load stylesheet -->";
        foreach($css as $file){
          echo "\n\t\t";
          echo "<link rel='stylesheet' href='".$file."' type='text/css' />\n";
        }
        echo "<!-- /Load stylesheet -->"; 
      }

      if(!empty($js)){
        echo "<!-- Load script -->";
        foreach($js as $file){
          echo "\n\t\t";
          echo "<script src='".$file."' /></script>";
        }
        echo "<!-- /Load script -->"; 
      }
    
    ?>
    <!-- /Load assets -->

  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">

        <!-- page content --> 
        <? echo $output;?>
        <!-- /page content -->

      </div>

    </div>

    <?
      // if(!empty($js)){
      //   echo "<!-- Load script -->";
      //   foreach($js as $file){
      //     echo "\n\t\t";
      //     echo "<script src='".$file."' /></script>";
      //   }
      //   echo "<!-- /Load script -->"; 
      // }
    ?>

  </body>
</html>
