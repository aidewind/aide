<?php 
  $settings = $this->get_settings(); 
  $session =  $this->get_session();
  $options = $model['options'];
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
      <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown">
        <?php 
        if(!$session->account){
          echo '<i class="glyphicon glyphicon-home" style="color:#dd1111;"></i>';
        }else{
          echo $session->account;
        }?>
      <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
      <ul class="nav dropdown-menu">
        <?php 
        if(!$session->account){?>
        <li><a href="<?php echo $this->route_url('signin', 'account'); ?>"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Sign In</a></li>
        <li><a href="<?php echo $this->route_url('signup', 'account'); ?>"><i class="glyphicon glyphicon-plus"></i> Sign Up</a></li>
        <?php }else{ ?>
        <li><a href="<?php echo $this->route_url('signout', 'account'); ?>"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Sign Out</a></li>
        <li><a href="<?php echo $this->route_url(NULL, 'ticket'); ?>"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> My Tickets</a></li>
        <li><a href="<?php echo $this->route_url('password', 'account'); ?>"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> Update Password</a></li>
        <li><a href="<?php echo $this->route_url('settings', 'account'); ?>"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
        <?php } ?>
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
        <li ><a href="<?php echo $this->route_url(NULL, 'home'); ?>">~public</a></li>
        <li ><a href="<?php echo $this->route_url('search', 'member'); ?>">~member</a></li>
        <li ><a href="<?php echo $this->route_url('search', 'sector'); ?>">~sector</a></li>
        <li ><a href="<?php echo $this->route_url('search', 'ticket'); ?>">~ticket</a></li>
        <?php 
          foreach ($sectors as $key => $value) {
            echo '<li><a href="#">~'.$value.'</a></li>';
          }
        ?>
      </ul>
    </div>  
  </div> 
</div>  

    <?php $this->render_body(); ?>

    <div class="row">
      <br>
      <div class="clearfix"></div>
      <hr>
      <div class="col-md-12 text-center"><p>
        <?php $aide = time() - 1406211039; echo $aide.'s since <a href="https://github.com/aidewind/aide" target="_blank">aide</a>'?>
        <!-- First commit at Date:   Thu Jul 24 11:10:39 2014 -0300-->
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