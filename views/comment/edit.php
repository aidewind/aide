<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Comment Edit</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <label for="body">ToDo</label>
          <textarea name="body" rows="8"><?php echo $model['body']; ?></textarea>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Comment</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  