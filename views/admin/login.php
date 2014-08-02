<div class="navbar navbar-default" id="subnav">
  <div class="col-md-12">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse2">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $this->route_url(NULL, 'home'); ?>">~public</a></li>
      </ul>   
    </div>  
  </div> 
</div> 

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Admin Login</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <label for="email">Email</label>
          <input type="email" name="email" required value="<?php echo $model['email']; ?>" />
          <label for="password">Password</label>
          <input type="password" name="password" required />
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Login</button></span>
        </form>
      </div>
    </div>
  </div>
</div>