<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/app.css">
<?php
require_once 'vendor/autoload.php';

use Carbon\Carbon;
use Qtvhao\CalendarSchedule\Calendar;
use Qtvhao\CalendarSchedule\Event\ShortEvent;

$calendar = Calendar::regular();
$start    = Carbon::now();
$end    = Carbon::now()->addDay(4);
$calendar->addEvent(new ShortEvent($start, $end));
$calendar->render();
