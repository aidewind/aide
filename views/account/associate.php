<?php
  $members = $model['members'];
  $account = $model['account'];
  $model = $model['model']; 
  $session = $this->get_session(); 
?>
<!--main-->
<div class="container" id="main">
  <div class="row">
    <div class="col-md-4 col-sm-6">
      <div class="well"> 
        <h4>Account Member Associate</h4>
        <p class="error"><?php echo $model['error']; ?></p>

        <form method="post">
          <div class="input-group">
            <input type="hidden" name="account" value="<?php echo $session->account; ?>" />
            <input type="hidden" name="associate-account" value="<?php echo $account->id; ?>" />
            <label for="associate-account-email">Account Email</label>
            <input type="text" name="associate-account-email" required maxlength="63" value="<?php echo $account->email; ?>" disabled/>
            <label for="member-complete-name">Member Complete Name</label>
            <select name='member'>
              <?php foreach($members as $member) { ?>
              <option value="<?php echo $member->id; ?>"><?php echo $member->complete_name; ?></option>
              <?php } ?>
            </select>
          </div>
          <span class="input-group-btn"><button class="btn btn-success pull-right" type="submit" name="submit">Associate</button></span>
        </form>

      </div>
    </div>
  </div>
</div>  
