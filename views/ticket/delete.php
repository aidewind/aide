<?php $ticket = $model['ticket']; ?>
<h1>Delete Blog ticket</h1>
<p class="error"><?php echo $model['error']; ?></p>
<form method="post">
  <p>Are you sure you want to delete the Blog ticket: <?php echo $ticket->title; ?>?</p>
  <input type="submit" name="submit" value="Delete Blog ticket" />
</form>