<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Site Information</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <label for="site_name">Site Name</label>
          <input type="text" name="site_name" required maxlength="63" value="<?php echo $model['site_name']; ?>" />
          <label for="display_name">Your Admin User Name</label>
          <input type="text" name="display_name" required maxlength="63" value="<?php echo $model['display_name']; ?>" />
          <label for="email">Email</label>
          <input type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Site Information</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  