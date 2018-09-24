<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<?php
require_once 'vendor/autoload.php';
use Qtvhao\CalendarSchedule\Calendar;

$calendar = Calendar::regular();
$calendar->render();
