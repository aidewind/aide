<div class="navbar navbar-default" id="subnav">
  <div class="col-md-12">
    <div class="navbar-header">
      <a href="#" style="margin-left:15px;" class="navbar-btn btn btn-default btn-plus dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-home" style="color:#dd1111;"></i> Home <small><i class="glyphicon glyphicon-chevron-down"></i></small></a>
      <ul class="nav dropdown-menu">
      <?php if(false) { ?>
        <li><a href="account/signin"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Sign In</a></li>
        <li><a href="account/create"><i class="glyphicon glyphicon-plus"></i> Sign Up</a></li>
      <?php } else { ?>
        <li><a href="#"><i class="glyphicon glyphicon-user" style="color:#1111dd;"></i> Sign Out</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-inbox" style="color:#11dd11;"></i> My Tickets</a></li>
        <li><a href="#"><i class="glyphicon glyphicon-cog" style="color:#dd1111;"></i> Settings</a></li>
      <?php }?>
      </ul>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse2">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">~public</a></li>
        <?php //$this->render_boards(); ?>
      </ul>
    </div>  
  </div> 
</div>  

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Account Created</h4>
        <p>Now, click on the verification link sent for your email.</p>
        <a href="#">Send again.</a>
      </div>
    </div>
  </div>
</div>
