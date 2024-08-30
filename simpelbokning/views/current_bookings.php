<?php

namespace cc\rylander\simpelbokning;

global $wpdb;

$table_name = $wpdb->prefix . 'simpelbokning_bookings';
$all_bookings = $wpdb->get_results("SELECT * FROM $table_name");
?>
<?php
$first_slot_hour = \get_option('simpelbokning_first_slot_hour');
$last_slot_hour = \get_option('simpelbokning_last_slot_hour');
// $now = new \DateTimeImmutable();
// $week = $now->format('W');
// $year = $now->format('Y');
// $week_start = $now->setISODate($year, $week)->setTime($first_slot_hour, 0, 0);
// echo $week_start->format('Y-m-d H:i:s');
?>
<div id="simpelbokning">Aktiva bokningar:
    <table>
        <tr>
            <th><?=__('Monday', 'simpelbokning')?></th>
            <th><?=__('Tuesday', 'simpelbokning')?></th>
            <th><?=__('Wednesday', 'simpelbokning')?></th>
            <th><?=__('Thursday', 'simpelbokning')?></th>
            <th><?=__('Friday', 'simpelbokning')?></th>
            <th><?=__('Saturday', 'simpelbokning')?></th>
            <th><?=__('Sunday', 'simpelbokning')?></th>
        </tr>
        <?php for ($hour = $first_slot_hour; $hour <= $last_slot_hour; $hour++) {?>
        <tr>
            <?php for ($weekday = 0; $weekday <= 6; $weekday++) {?>
                <td><?=$hour?></td>
            <?php }?>
        </tr>
        <?php }?>
    </table>
</div>
