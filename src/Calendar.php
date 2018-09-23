<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:41 PM
 */
namespace Qtvhao\CalendarSchedule;

class Calendar {

	public static function regular() {
		$calendar = new Calendar();
		/** @var DateTime $mondayOfMonth */
		$mondayOfMonth = DateTime::now();
		$calendar->setStart($mondayOfMonth);

		/** @var DateTime $sundayOfMonthEnd */
		$sundayOfMonthEnd = DateTime::now();
		$calendar->setEnd($sundayOfMonthEnd);

	}

	private function setStart( DateTime$mondayOfMonth ) {
		$this->start_at = $mondayOfMonth;
	}

	private function setEnd(DateTime $sundayOfMonthEnd ) {
		$this->end_at = $sundayOfMonthEnd;
	}
}
