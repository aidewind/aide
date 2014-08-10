<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Sector Information</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <label for="display_name">Sector Name</label>
          <input type="text" name="name" required maxlength="63" value="<?php echo $model['name']; ?>" />
          <label for="email">Email</label>
          <input type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
          <label for="display_name">Sector Initial</label>
          <input type="text" name="initial" required maxlength="63" value="<?php echo $model['initial']; ?>" />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Sector Information</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  