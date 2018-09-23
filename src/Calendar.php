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
		$dates = $this->getDates();
		echo "<div id='date-cells'>";
		for($i = 0; $i<7;$i++) {
			$D = $this->start_at->copy()->addDay($i)->format( 'D');
			echo "<div class='date-cell date-heading'><span class='date-heading-text'>$D</span></div>";
		}
		foreach($dates as $date) {
			echo "<div class='date-cell'></div>";
		}
		echo "</div>";
		?>
		<style>
			.date-cell {
				background: #fff;
				outline:1px solid #e2e2e2;
				height: 120px;
				width: 14%;
				display: inline-block;
			}
			div#date-cells {
				width: 920px;
			}
			.date-heading .date-heading-text{
				padding: 4px 13px;
				display: inline-block;
				text-transform: uppercase;
			}
			.date-heading{
				outline:0;
				text-align: right;
				height: unset;
			}
		</style>
		<?php
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
