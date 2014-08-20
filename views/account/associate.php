<?php
  $members = $model['members'];
  $member_member = $model['member_member'];
  $model = $model['model']; 
  
  $selected = array();
  $selected = array_fill(0, count($members), false);
  foreach ($member_member as $s_m){
    $selected[$s_m->id]=true;
  }
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Account Edit</h4>
        <p class="error"><?php echo $model['error']; ?></p>

        <form method="post">
          <div class="input-group">
            <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
            <input type="hidden" name="ticket" value="<?php echo $ticket->id; ?>" />
            <select name='member'>
              <?php foreach($members as $member) { ?>
              <option value="<?php echo $member->id; ?>"><?php echo $member->name; ?></option>
              <?php } ?>
            </select>
          </div>
          <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Add Member</button></span>
        </form>

      </div>
    </div>
  </div>
</div>  
