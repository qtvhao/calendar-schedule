<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:41 PM
 */
namespace Qtvhao\CalendarSchedule;

/**
 * @property DateTime start_at
 * @property DateTime end_at
 */
class Calendar {

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

		echo "";
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
}
