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
	}

	private function setStart( DateTime$mondayOfMonth ) {
		$this->start_at = $mondayOfMonth;
	}

	private function setEnd(DateTime $sundayOfMonthEnd ) {
		$this->end_at = $sundayOfMonthEnd;
	}
}
