<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/app.css">
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
$calendar->render();
