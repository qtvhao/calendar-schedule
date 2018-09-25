<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 9/23/2018
 * Time: 1:41 PM
 */
namespace Qtvhao\CalendarSchedule\Event;

use Carbon\Carbon;
use Qtvhao\CalendarSchedule\DateTime;

/**
 * Class Event
 * @package Qtvhao\CalendarSchedule\Event
 * @property Carbon start
 * @property Carbon end
 */
abstract class Event {
	/**
	 * @var int
	 */
	private $id;
	/**
	 * @var bool
	 */
	private $is_on_date;

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

	/**
	 * @return bool
	 */
	public function isOnDate() {
		return $this->is_on_date;
	}

	/**
	 * @param bool $is_on_date
	 */
	public function setIsOnDate( $is_on_date ) {
		$this->is_on_date = $is_on_date;
	}

	public function isNotHappenYetAt(DateTime $date ) {
		return $date->timestamp < $this->start->timestamp;
	}
}
