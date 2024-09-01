<?php

namespace cc\rylander\simpelbokning;

global $wpdb;

$table_name = $wpdb->prefix . 'simpelbokning_bookings';
$all_bookings = $wpdb->get_results("SELECT * FROM $table_name");
?>
<?php
$first_slot_hour = \get_option('simpelbokning_first_slot_hour');
$last_slot_hour = \get_option('simpelbokning_last_slot_hour');
$now = new \DateTimeImmutable();
$this_week = $now->format('W');
$year = $now->format('Y');
// echo $week_start->format('Y-m-d H:i:s');
?>
<div id="simpelbokning">Aktiva bokningar:
<?php for ($week = 0; $week <= \get_option('simpelbokning_weeks_to_show'); $week++) {?>
    <table>
        <tr>
            <th><?=__('w', 'simpelbokning')?><?= $this_week + $week ?></th>
            <th style="width: 6em";><?=__('Monday', 'simpelbokning')?></th>
            <th style="width: 6em";><?=__('Tuesday', 'simpelbokning')?></th>
            <th style="width: 6em";><?=__('Wednesday', 'simpelbokning')?></th>
            <th style="width: 6em";><?=__('Thursday', 'simpelbokning')?></th>
            <th style="width: 6em";><?=__('Friday', 'simpelbokning')?></th>
            <th style="width: 6em";><?=__('Saturday', 'simpelbokning')?></th>
            <th style="width: 6em";><?=__('Sunday', 'simpelbokning')?></th>
        </tr>
        <?php for ($hour = $first_slot_hour; $hour <= $last_slot_hour; $hour++) {?>
        <tr>
            <td><?=$hour?></td>
            <?php
                for ($day = 1; $day <= 7; $day++) {
                    $this_hour = $now->setISODate($year, $this_week+$week, $day)->setTime($hour, 0, 0);
            ?>
                <td style="border: 1px solid black;">
                    <?php
                    if ($this_hour->getTimestamp() < $now->getTimestamp()) {
                            echo '-';
                        }
                    ?>
                </td>
            <?php } // day ?>
        </tr>
        <?php } // hour ?>
    </table>
<?php } // week ?>
</div>
