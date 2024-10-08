<?php
namespace cc\rylander\simpelbokning;

use DateTime;
use function get_option;

require_once dirname(__FILE__) . '/../utils.php';

/**
 * @var integer $this_week
 * @var integer $first_slot_hour
 * @var integer $last_slot_hour
 * @var DateTime $now
 * @var integer $year
 * @var array $current_bookings
 */
?>

<div id="simpelbokning">
<?php for ($week = 0; $week <= get_option('simpelbokning_weeks_to_show'); $week++) {?>
    <table>
        <tr>
            <th><?=__('w', 'simpelbokning')?><?= $this_week + $week ?></th>
            <th style="width: 6em"><?=__('Monday', 'simpelbokning')?></th>
            <th style="width: 6em"><?=__('Tuesday', 'simpelbokning')?></th>
            <th style="width: 6em"><?=__('Wednesday', 'simpelbokning')?></th>
            <th style="width: 6em"><?=__('Thursday', 'simpelbokning')?></th>
            <th style="width: 6em"><?=__('Friday', 'simpelbokning')?></th>
            <th style="width: 6em"><?=__('Saturday', 'simpelbokning')?></th>
            <th style="width: 6em"><?=__('Sunday', 'simpelbokning')?></th>
        </tr>
        <?php for ($hour = $first_slot_hour; $hour <= $last_slot_hour; $hour++) {?>
        <tr>
            <td><?=$hour?></td>
            <?php
                for ($day = 1; $day <= 7; $day++) {
                    $this_hour = $now->setISODate($year, $this_week+$week, $day)->setTime($hour, 0);
                    $slot_start = $this_hour->getTimestamp();
                    $slot_end = $slot_start + get_option('simpelbokning_slot_length_minutes') * 60;
                ?>
                <td style="border: 1px solid black;">
                    <?php
                    if (!is_bookable($this_hour->getTimestamp())) {
                        echo '-';
                    } else {
                        // Get bookings for this slot
                        $bookings = array_filter($current_bookings, function ($booking) use ($slot_start, $slot_end) {
                            $booking_start = strtotime($booking->time);
                            $booking_end = strtotime($booking->time) + $booking->length_minutes * 60;
                            return ($booking_start >= $slot_start && $booking_start < $slot_end) ||
                                ($booking_end > $slot_start && $booking_end < $slot_end);
                        });
                        if (count($bookings) > 0) {
                            foreach ($bookings as $booking) {
                                echo $booking->name . ' ';
                            }
                        } else {
                            ?><a href="<?= get_option('simpelbokning_path_for_booking_form')?>?slot_start=<?=$slot_start?>"><?=__('book this', 'simpelbokning')?></a>'<?php
                        }
                    }
                    ?>
                </td>
            <?php } // day ?>
        </tr>
        <?php } // hour ?>
    </table>
<?php } // week ?>
</div>
