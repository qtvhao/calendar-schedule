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
			$zIndex     = 9 - $date->dayOfWeek;
			$events_of_date     = $this->getEventsOfDate( $date );
			$eventsIsNotEmpty = (int)$events_of_date->filter->isOnDate()->isNotEmpty();
			$classes = '';
			$rowHeight = ($this->events->count() * 28 + 53) . 'px';
			$classes .= ($eventsIsNotEmpty?'events-is-not-empty':'events-is-empty');
			echo "<div class='date-cell-wrapper $classes' style='z-index: $zIndex;height:$rowHeight' data-events-is-not-empty='$eventsIsNotEmpty'>
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
		return $this->events->map( function ( Event $event ) use ( $date ) {
			$event->setIsOnDate( ( ( $event->end->timestamp >= $date->timestamp ) and ( $event->start->timestamp <= $date->timestamp ) ));

			return $event;
		} );
	}

	private function buildEventElementsOfDate(DateTime $date ) {
		$eventsOfDate = $this->getEventsOfDate( $date );
		$eventsOfDate = $eventsOfDate->map(function(Event$event) use ( $date ) {
			$width = (($event->end->diffInDays($date) + 1) * 100) . '%';

			$text = ($event->isOnDate() ? $event->getId() : '&nbsp;');

			$background = ($event->isOnDate()) ? "#CFFCC1" : "unset";
			$pointerEvents = ($event->isNotHappenYetAt($date)) ? 'none' : 'all';

			return <<<HTML
<div class='date-cell-events' style="width:$width;padding: 2px 5px;pointer-events: $pointerEvents">
    <div class='date-cell-events-container' style="background:$background;">
        {$text}
    </div>
</div>
HTML;
		})->implode( '');

		return $eventsOfDate;
	}
}
