<?php
/**
 * @var DateTime $slot_start
 * @var DateTime $slot_end
 * @var integer $slot_start_as_epoch
 */
?>

<p>
	<?=__('Booking for', 'simpelbokning')?>: <?= $slot_start->format('Y-m-d')?> <?=__('at', 'simpelbokning')?> <?=$slot_start->format('H:i')?>-<?=$slot_end->format('H:i')?>
</p>
<form method="post" action="">
    <p>
        <input type="hidden" name="slot_start" value="<?= $slot_start_as_epoch ?>"/>
        <label for="name"><?= __( 'Name', 'simpelbokning' ) ?>:</label> <input type="text" name="name" id="name"/>
        <label for="email"><?= __( 'Email', 'simpelbokning' ) ?>:</label><input type="email" name="email" id="email"/>
        <input type="submit" name="submit" value="<?= __( 'Submit', 'simpelbokning' ) ?>"/>
    </p>
</form>
