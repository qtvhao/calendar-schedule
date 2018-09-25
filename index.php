<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/app.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
require_once 'vendor/autoload.php';

use Qtvhao\CalendarSchedule\DateTime as Carbon;
use Qtvhao\CalendarSchedule\Calendar;
use Qtvhao\CalendarSchedule\Event\LongEvent;

$calendar = Calendar::regular();
$calendar->render('pagination');
$now = Carbon::now();

$start_at = $now->copy()->day( rand( -6, 20 ) );
$calendar->addEvent(new LongEvent( 'Project #' . rand(1000,9999), $start_at, $start_at->copy()->addDay( rand( 4, 10 ) )));


$start_at = $now->copy()->day( rand( -6, 20 ) );
$calendar->addEvent(new LongEvent( 'Project #' . rand(1000,9999), $start_at, $start_at->copy()->addDay( rand( 4, 10 ) )));


$start_at = $now->copy()->day( rand( -6, 20 ) );
$calendar->addEvent(new LongEvent( 'Project #' . rand(1000,9999), $start_at, $start_at->copy()->addDay( rand( 4, 10 ) )));


$start_at = $now->copy()->day( rand( -6, 20 ) );
$calendar->addEvent(new LongEvent( 'Project #' . rand(1000,9999), $start_at, $start_at->copy()->addDay( rand( 4, 10 ) )));

$calendar->render();
?>

