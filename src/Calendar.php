<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:41 PM
 */
namespace Qtvhao\CalendarSchedule;

use Carbon\Carbon;

class Calendar {

	public static function regular() {
		$calendar = new Calendar();
		/** @var Carbon $mondayOfMonth */
		$mondayOfMonth = Carbon::now();
		$calendar->setStart($mondayOfMonth);
	}

	private function setStart( Carbon$mondayOfMonth ) {
		$this->start_at = $mondayOfMonth;
	}
}
