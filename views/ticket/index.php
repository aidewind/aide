<?php
  include "includes/Parsedown.php";
  $settings = $this->get_settings();
  $parsedown = new Parsedown();
  $ticket = $model['ticket'];
  $members = $model['members'];
  $members_involved = $model['members_involved'];
  $sectors = $model['sectors'];
  $comments = $model['comments'];
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
            sectors
            <select>              
              <?php foreach ($sectors as $sector) { ?>
              <option value="<?php echo $sector->id;?>"><?php echo $sector->name; ?></option>
              <?php } ?>
            </select>
          </li>
          <!--
          <li class="list-group-item">
            itens
          </li>
          <li class="list-group-item">
            sets
          </li>
          -->
        </ul> 
      </div>
    </div>


      <div class="col-md-4 col-sm-6">

        <div class="well"> 
          <?php if($session != NULL) { ?>
          <h4>New Member</h4>
          <form method="post" action="<?php echo $this->route_url('involve', 'member'); ?>" class="form-horizontal" role="form">
            <div class="form-group" style="padding:14px;">
              <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
              <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
              <select name='member'>
                <?php foreach($members as $member) { ?>
                <option value="<?php echo $member->id; ?>"><?php echo $member->complete_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Add Member</button></span>
          </form>
          <?php } ?>

          <h4>Members</h4>
          <ul class="list-group">
            <li class="list-group-item">
            <?php foreach($members_involved as $member) { ?>            
              <span class="label label-default"><?php echo $member->member; ?></span>
            <?php } ?>
            </li>
          </ul>
        </div>

        <div class="well"> 
          <?php if($session != NULL) { ?>
          <h4>New Member</h4>
          <form method="post" action="<?php echo $this->route_url('involve', 'member'); ?>" class="form-horizontal" role="form">
            <div class="form-group" style="padding:14px;">
              <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
              <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
              <select name='member'>
                <?php foreach($members as $member) { ?>
                <option value="<?php echo $member->id; ?>"><?php echo $member->complete_name; ?></option>
                <?php } ?>
              </select>
            </div>
            <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Add Member</button></span>
          </form>
          <?php } ?>

          <h4>Members</h4>
          <ul class="list-group">
            <li class="list-group-item">
            <?php foreach($members_involved as $member) { ?>            
              <span class="label label-default"><?php echo $member->member; ?></span>
            <?php } ?>
            </li>
          </ul>
        </div>
        
      </div>
    
      <div class="col-md-4 col-sm-6">
        <div class="well"> 
          <?php if($session != NULL) { ?>
          <h4>New Comment</h4>
          <p class="error"><?php //echo $model['error']; ?></p>
          <form method="post" action="<?php echo $this->route_url('edit', 'comment'); ?>" class="form-horizontal" role="form">
            <div class="form-group" style="padding:14px;">
              <input type="hidden" name="id" value="<?php //echo $model['id']; ?>" />
              <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
              <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
              <textarea name="body" class="form-control" placeholder="Your Comment"><?php //echo $model['body']; ?></textarea>
            </div>
            <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Save Comment</button></span>
          </form>
          <?php } ?>

          <h4>Comments</h4>
          <ul class="list-group">
          <?php foreach ($comments as $comment) { ?>
            <li class="list-group-item">
              <?php echo $comment[account].": ".$comment[body]; ?>
            </li>
          <?php } ?>
          </ul>
        </div>
      </div>

  </div>
</div>  