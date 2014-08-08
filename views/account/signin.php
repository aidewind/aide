<?php 
  $settings = $this->get_settings(); 
?>

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Sign In</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form class="form-horizontal" role="form" method="post">
          <label for="email">Email</label>
          <input type="email" name="email" required value="<?php echo $model['email']; ?>" />
          <label for="password">Password</label>
          <input type="password" name="password" required />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Sign in</button></span>
        </form>
      </div>
    </div>
  </div>
</div>