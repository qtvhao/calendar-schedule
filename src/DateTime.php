<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:55 PM
 */

namespace Qtvhao\CalendarSchedule;


use Carbon\Carbon;

class DateTime extends Carbon{
	/**
	 * @return DateTime
	 */
	public static function getMondayStartOfMonth(DateTime$date_time = null) {
		if (is_null( $date_time)) {
			$mondayStartOfMonth = DateTime::now();
		}
		$mondayStartOfMonth->startOfMonth();
		$mondayStartOfMonth->startOfWeek();

		return $mondayStartOfMonth;
	}

	/**
	 * @return DateTime
	 */
	public static function getSundayEndOfMonth(DateTime$date_time = null) {
		if (is_null( $date_time)) {
			$sundayEndOfMonth = DateTime::now();
		}
		$sundayEndOfMonth->endOfMonth();
		$sundayEndOfMonth->endOfWeek();

		return $sundayEndOfMonth;
	}
}
