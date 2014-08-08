<?php $ticket = $model['ticket']; ?>

<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Delete Ticket</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post">
          <p>Are you sure you want to delete the Ticket <?php echo $ticket->id; ?>?</p>
          <p>About: <?php echo $ticket->body; ?></p>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Delete Ticket</button></span>
        </form>
      </div>
    </div>
  </div>
</div>  