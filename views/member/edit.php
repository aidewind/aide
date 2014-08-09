<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Member Information</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <label for="display_name">Your Complete Member Name</label>
          <input type="text" name="complete_name" required maxlength="63" value="<?php echo $model['complete_name']; ?>" />
          <label for="email">Email</label>
          <input type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Member Information</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  