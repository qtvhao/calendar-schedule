<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:41 PM
 */
namespace Qtvhao\CalendarSchedule\Event;

use Carbon\Carbon;

/**
 * Class Event
 * @package Qtvhao\CalendarSchedule\Event
 * @property Carbon start
 * @property Carbon end
 */
abstract class Event {
	private $id;

	/**
	 * @return mixed
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @param mixed $id
	 */
	public function setId( $id ) {
		$this->id = $id;
	}
}
