<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:41 PM
 */
namespace Qtvhao\CalendarSchedule;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Qtvhao\CalendarSchedule\Event\Event;

/**
 * @property DateTime start_at
 * @property DateTime end_at
 */
class Calendar {
	/**
	 * @var Collection
	 */
	private $events;

	public function __construct() {
		$this->events = Collection::make();
	}

	public static function regular() {
		$calendar = new Calendar();
		$calendar->setStart(DateTime::getMondayStartOfMonth());
		$calendar->setEnd(DateTime::getSundayEndOfMonth());

		return $calendar;
	}

	private function setStart( DateTime$mondayOfMonth ) {
		$this->start_at = $mondayOfMonth;
	}

	private function setEnd(DateTime $sundayOfMonthEnd ) {
		$this->end_at = $sundayOfMonthEnd;
	}

	public function render( $view = 'default' ) {
		echo "<div class='date-cells-wrapper'>";
		$dates = $this->getDates();
		echo "<div class='date-cells'>";
		echo "<div class='date-cells-container'>";
		for($i = 0; $i<7;$i++) {
			$D = $this->start_at->copy()->addDay($i)->format( 'D');
			echo "<div class='date-cell-wrapper date-cell-heading-wrapper'>
    <div class='date-cell date-cell-heading'>
        <div class='date-cell-container'>
            <div class='date-cell-heading-container'>
            <span class='date-cell-heading-text'>
                $D
            </span>
            </div>
        </div>
    </div>
</div>";
		}
		foreach($dates as $date) {
			$dateEvents = $this->buildEventElementsOfDate($date);
			echo "<div class='date-cell-wrapper'>
    <div class='date-cell'>
        <div class='date-cell-container'>
            <div class='date-cell-text'>
                {$date->day}
            </div>
        </div>
        <div class='date-cell-events-wrapper'>
			$dateEvents
        </div>
    </div>
</div>";
		}
		echo "</div>";
		echo "</div>";
		echo "</div>";
	}

	/**
	 * @return \Illuminate\Support\Collection|DateTime[]
	 */
	private function getDates() {
		$dates = collect();
		$i = 0;
		do{
			$date = $this->start_at->copy()->addDay($i);
			$dates->push($date);
			$i++;
		}while($date->copy()->addDay(1)->lessThanOrEqualTo( $this->end_at));

		return $dates;
	}

	public function addEvent( Event$event ) {
		$this->events->push($event);
	}

	private function getEventsOfDate( Carbon $date ) {
		return $this->events->filter( function ( Event $event ) use ( $date ) {
			return
				( $event->end->timestamp > $date->timestamp ) and
				( $event->start->timestamp < $date->timestamp );
		} );
	}

	private function buildEventElementsOfDate(Carbon $date ) {
		$eventsOfDate = $this->getEventsOfDate( $date );
		$eventsOfDate = $eventsOfDate->map(function(Event$event) use ( $date ) {
			$width = (($event->end->diffInDays($date) + 1) * 100) . '%';

			return <<<HTML
<div class='date-cell-events' style="width:$width;padding: 5px;">
    <div class='date-cell-events-container' style="background:#CFFCC1;padding: 0px 9px;">
        {$event->getId()}
    </div>
</div>
HTML;
		})->implode( '');

		return $eventsOfDate;
	}
}
