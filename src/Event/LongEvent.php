<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/24/2018
 * Time: 8:44 PM
 */

namespace Qtvhao\CalendarSchedule\Event;


use Carbon\Carbon;

class LongEvent extends Event {
	/**
	 * @var Carbon
	 */
	public $start;
	/**
	 * @var Carbon
	 */
	public $end;

	public function __construct($id, Carbon$start, Carbon$end) {
		$this->setId( $id);
		$this->start = $start;
		$this->end = $end;
	}
}
