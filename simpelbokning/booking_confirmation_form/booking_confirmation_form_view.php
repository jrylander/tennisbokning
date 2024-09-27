<p>
<?=__('Booking for', 'simpelbokning')?>: <?=$slot_start->format('Y-m-d')?> <?=__('at', 'simpelbokning')?> <?=$slot_start->format('H:i')?>-<?=$slot_end->format('H:i')?>
</p>
<p>
<form method="post" action="<?php admin_url('admin-post.php');?>">
  <input type="hidden" name="action" value="process_form" />
  <p>
  <label for="name"><?=__('Name', 'simpelbokning')?>:</label> <input type="text" name="name" id="name" />
  <label for="email"><?=__('Email', 'simpelbokning')?>:</label><input type="email" name="email" id="email" />
  <input type="submit" name="submit" value="<?=__('Submit', 'simpelbokning')?>" />
</form>
</p>