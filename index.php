<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/app.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
require_once 'vendor/autoload.php';

use Qtvhao\CalendarSchedule\DateTime as Carbon;
use Qtvhao\CalendarSchedule\Calendar;
use Qtvhao\CalendarSchedule\Event\LongEvent;

$calendar = Calendar::regular();
$start    = Carbon::now()->startOfWeek();
$end    = Carbon::now()->addDay(5);
$calendar->addEvent(new LongEvent(123, $start, $end));

$start    = Carbon::now()->subDay(1);
$end    = Carbon::now()->addDay(5);
$calendar->addEvent(new LongEvent(1232, $start, $end));

$start    = Carbon::now()->subDay(9);
$end    = Carbon::now()->subDay(6);
$calendar->addEvent(new LongEvent(1232, $start, $end));

$calendar->render();
?>
<script>
    jQuery(function () {
        var containerBoundingClientRectRight = document.getElementsByClassName('date-cells-container')[0].getBoundingClientRect().right;
        function isOverlapContainer(dateCellEvent){
            return (dateCellEvent).getBoundingClientRect().right < containerBoundingClientRectRight;
        }
        dateCellEvents = Array.from(jQuery('.events-is-not-empty .date-cell-events'));
        for (var i = 0; i < dateCellEvents.length; i++) {
            (function(dateCellEvent) {
                for(var i = 0; (i < 100 && !isOverlapContainer(dateCellEvent)); i++) {
                    dateCellEvent.style.width = (Number(dateCellEvent.style.width.replace('%',''))-1) + '%';
                }
            })(dateCellEvents[i]);
        }
    })
</script>
