<?php 
$redirect = isset($this->accounts_redirect) ? $this->accounts_redirect : NULL;
$accounts = $this->get_accounts($redirect); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <title>aide</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
  <!--[if lt IE 9]>
  <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
  <link rel="stylesheet" type="text/css" href="/css/theme.css" />
  </head>
  <body 
>  <div class="navbar navbar-fixed-top header">
    <div class="col-md-12">
    <div class="navbar-header">
      <a href="<?php echo $this->route_url(NULL, 'home'); ?>" class="navbar-brand">aide</a>
    </div>
    </div> 
  </div>
  <!--main-->
  <div class="container" id="main">
    <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
      <form class="form-horizontal" role="form" method="post">
        <h4>Account Creation</h4>
        <?php
        $accounts = $this->get_accounts(FALSE);
        if($accounts === NULL) {
        ?>
        <p>Hi! Lets create your account</p>
        <p class="error"><?php echo $model['error']; ?></p>
        <div class="form-group" style="padding:14px;">
        <label for="display_name">Your User Name</label>
        <input class="form-control" placeholder="Your Name" type="text" name="display_name" required maxlength="63" value="<?php echo $model['display_name']; ?>" />
        <label for="email">Email</label>
        <input class="form-control" placeholder="Email" type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
        <label for="password">Password</label>
        <input class="form-control" placeholder="Password" type="password" name="password" required />
        </div>
        <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Create</button></span>
        <?php } else { ?>
        <p>Your account was created.</p>
        <?php } ?>
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
      </div>
    <hr>
    </div><!--row--> 
  </div><!--/main-->
  </body>
</html>
