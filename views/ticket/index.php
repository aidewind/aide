<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $ticket = $model['ticket'];
  $sectors = $model['sectors'];
  $session =  $this->get_session();
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4 class="title"><div class="markdown"><?php echo $parsedown->text($ticket->body);?></div></h4>
        <p class="info"><?php echo $this->get_age_string($ticket->created), ' by ', $settings->display_name;?></p>

        <ul class="list-group">
          <li class="list-group-item">
            members
          </li>
          <li class="list-group-item">
            sectors
            <?php foreach ($sectors as $sector) { ?>
            <a href="<?php echo $this->route_url(NULL, 'sector', $sector); ?>"><span class="label label-warning"><?php echo $sector?></span></a>
            <?php } ?>          
          </li>
          <li class="list-group-item">
            itens
          </li>
          <li class="list-group-item">
            sets
          </li>
        </ul> 
      </div>
    </div>

    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Comment Edit</h4>
        <p class="error"><?php echo $model['error']; ?></p>
        <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>">
          <input type="hidden" name="id" value="<?php echo $model['id']; ?>" />
          <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
          <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
          <label for="body">Comment</label>
          <textarea name="body" rows="8"><?php echo $model['body']; ?></textarea>
          <span class="input-group-btn"><button class="btn btn-lg btn-primary" type="submit" name="submit">Save Comment</button></span>
        </form>
      </div>
    </div>

    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <ul class="list-group">
          <li class="list-group-item">
            comment 4
          </li>
          <li class="list-group-item">
            comment 3
          </li>
          <li class="list-group-item">
            comment 2
          </li>
          <li class="list-group-item">
            comment 1
          </li>
        </ul>
      </div>
    </div>

  </div>
</div>  