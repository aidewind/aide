<?php 
  $settings = $this->get_settings(); 
  $session =  $this->get_session();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->request->lang; ?>">
  <head>
    <title><?php echo $this->meta->title; ?></title>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta name="generator" content="Bootply" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="description" content="<?php echo $this->meta->description; ?>">
    <meta name="keywords" content="<?php echo $this->meta->keywords; ?>">
    <meta name="author" content="<?php echo $this->meta->author; ?>">
    <link rel="image_src" href="<?php echo $this->meta->image; ?>"/>
    <meta property="og:title" content="<?php echo $this->meta->title; ?>" />
    <meta property="og:image" content="<?php echo $this->meta->image; ?>" />
    <meta name="twitter:title" content="<?php echo $this->meta->title; ?>">
    <meta name="twitter:image" content="<?php echo $this->meta->image; ?>">  
    <link href="http<?php if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') { echo 's'; }; ?>://fonts.googleapis.com/css?family=Roboto:300,400,700" rel="stylesheet" type="text/css">
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <link rel="stylesheet" type="text/css" href="/css/theme.css" />
    <link rel="stylesheet" type="text/css" href="/css/site.css" />
  </head>
  <body >
    <div class="navbar navbar-fixed-top header">
      <div class="col-md-12">
      <div class="navbar-header">
        <a href="<?php echo $this->route_url(NULL, 'home'); ?>" class="navbar-brand"><?php echo @$settings->blog_name; ?></a>
        <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse1"> 
        <i class="glyphicon glyphicon-search"></i>
        </button> -->
      </div>
  <!--    <div class="collapse navbar-collapse" id="navbar-collapse1">
        <form class="navbar-form pull-right">
        <div class="input-group" style="max-width:470px;">
          <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
          <div class="input-group-btn">
          <button class="btn btn-default btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
          </div>
        </div>
        </form>
      </div>  -->
      </div> 
    </div>

    <?php $this->render_body(); ?>

    <div class="row">
      <br>
      <div class="clearfix"></div>
      <hr>
      <div class="col-md-12 text-center"><p>
        Powered by <a href="https://github.com/aidewind/aide" target="_blank">aide</a> 
        | <a href="<?php echo $this->route_url(NULL, 'admin'); ?>">Admin</a>
        <?php if ($session !== NULL ) { ?>| <a href="<?php echo $this->route_url('logoff', 'admin'); ?>">Logoff</a><?php }?>
        | <?php
        echo gethostname();
        echo " ";
        echo php_uname('n'); // // Or, an option that also works before PHP 5.3
        echo " ";
        echo $_SERVER['REMOTE_ADDR'];
        echo " ";
        echo $_SERVER['HTTP_X_FORWARDED_FOR'];
        ?>
      </div>
      <hr>
    </div>
  </body>

  <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script type='text/javascript' src="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/js/bootstrap.min.js"></script>
  <!-- JavaScript jQuery code from Bootply.com editor -->
  <script type='text/javascript'>
    $(document).ready(function() {
    /* toggle layout */
    $('#btnToggle').click(function(){
      if ($(this).hasClass('on')) {
      $('#main .col-md-6').addClass('col-md-4').removeClass('col-md-6');
      $(this).removeClass('on');
      }
      else {
      $('#main .col-md-4').addClass('col-md-6').removeClass('col-md-4');
      $(this).addClass('on');
      }
    });
    });
  </script>

</html>