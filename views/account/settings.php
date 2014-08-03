<h1>site Information</h1>
<p class="error"><?php echo $model['error']; ?></p>
<form method="post">
  <label for="site_name">site Name</label>
  <input type="text" name="site_name" required maxlength="63" value="<?php echo $model['site_name']; ?>" />
  <label for="display_name">Your Name</label>
  <input type="text" name="display_name" required maxlength="63" value="<?php echo $model['display_name']; ?>" />
  <label for="email">Email</label>
  <input type="email" name="email" required maxlength="250" value="<?php echo $model['email']; ?>" />
  <input type="submit" name="submit" value="Save site Information" />
</form>