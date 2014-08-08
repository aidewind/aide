<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Update Password</h4>
        <p class="error"><?php echo $model['error'];?></p>
        <form method="post">
          <label for="password">Password</label>
          <input type="password" name="password" required />
          <label for="confirm">Confirm Password</label>
          <input type="password" name="confirm" required />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Update Password</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  