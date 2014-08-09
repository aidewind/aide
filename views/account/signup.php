<?php 
$settings = $this->get_settings(); 
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <form class="form-horizontal" role="form" method="post">
          <h4>Sign Up</h4>
          <p class="error"><?php echo $model['error']; ?></p>
          <div class="form-group" style="padding:14px;">
            <label for="display_name">Your Account Name</label>
            <input class="form-control" placeholder="Your Account Name" type="text" name="display_name" required maxlength="63" value="<?php echo $model['display_name']; ?>" />
            <label for="email">Email</label>
            <input class="form-control" placeholder="Email" type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
            <label for="password">Password</label>
            <input class="form-control" placeholder="Password" type="password" name="password" required />
          </div>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Sign Up</button></span>
        </form>
      </div>
    </div>
  </div>
</div>