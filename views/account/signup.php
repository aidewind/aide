<?php 
  $settings = $this->get_settings(); 
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
        <a href="<?php echo $this->route_url(NULL, 'home'); ?>" class="navbar-brand"><?php echo @$settings->site_name; ?></a>
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

    <div class="navbar navbar-default" id="subnav">
      <div class="col-md-12">
        <div class="navbar-header">
          <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Home <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
          <ul class="nav dropdown-menu">
            <li><a href="<?php echo $this->route_url('signin', 'account'); ?>"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Sign In</a></li>
            <li><a href="<?php echo $this->route_url('create', 'account'); ?>"><i class="glyphicon glyphicon-plus"></i> Sign Up</a></li>
          </ul>
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse2">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $this->route_url(NULL, 'home'); ?>">~public</a></li>
          </ul>
        </div>  
      </div> 
    </div>  

  <!--main-->
  <div class="container" id="main">
    <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
      <form class="form-horizontal" role="form" method="post">
        <h4>Account Creation...</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <div class="form-group" style="padding:14px;">
        <label for="display_name">Your User Name</label>
        <input class="form-control" placeholder="Your User Name" type="text" name="display_name" required maxlength="63" value="<?php echo $model['display_name']; ?>" />
        <label for="email">Email</label>
        <input class="form-control" placeholder="Email" type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
        <label for="password">Password</label>
        <input class="form-control" placeholder="Password" type="password" name="password" required />
        </div>
        <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Create</button></span>
      </form>
      </div>
    </div>
    </div>


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
