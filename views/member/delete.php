<?php $member = $model['member']; ?>

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Delete Member</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <p>Are you sure you want to delete the Member <?php echo $member->id; ?>?</p>
          <p>Complete Name: <?php echo $member->complete_name; ?></p>
          <p>Email: <?php echo $member->email; ?></p>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Delete Member</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  