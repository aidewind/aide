<?php 
$redirect = isset($this->settings_redirect) ? $this->settings_redirect : NULL;
$settings = $this->get_settings($redirect); ?>
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
  </head>
  <body >
    <div class="container" id="main">
      <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="well"> 
        <form class="form-horizontal" role="form" method="post">
          <h4>Setup</h4>
          <?php
          $settings = $this->get_settings(FALSE);
          if($settings === NULL) {
          ?>
          <p>Congratulations! It appears the webserver is configured correctly to handle requests. We are almost done setting up and just need a few more details about your site.</p>
          <p class="error"><?php echo $model['error']; ?></p>
          <div class="form-group" style="padding:14px;">
          <label for="site_name">Site Name</label>
          <input class="form-control" placeholder="Site Name" type="text" name="site_name" required maxlength="63" value="<?php echo $model['site_name']; ?>" />
          <label for="display_name">Your Admin User Name</label>
          <input class="form-control" placeholder="Your Admin User Name" type="text" name="display_name" required maxlength="63" value="<?php echo $model['display_name']; ?>" />
          <label for="email">Email</label>
          <input class="form-control" placeholder="Email" type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
          <label for="password">Password</label>
          <input class="form-control" placeholder="Password" type="password" name="password" required />
          </div>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Setup</button></span>
          <?php } else { ?>
          <p>Site has already been set up. If you need to administer, please visit the admin <a href="<?php echo $this->route_url('login', 'admin'); ?>">login link</a>. If you need to setup the site again, you will need to delete the records in the <code>setting</code> database table to allow the setup to continue.</p>
          <?php } ?>
        </form>
        </div>
      </div>
      </div>
    </div>
  </body>
</html>