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
			echo "<div class='date-cell-wrapper'>
    <div class='date-cell'>
        <div class='date-cell-container'>
            <div class='date-cell-text'>
                {$date->day}
            </div>
        </div>
    </div>
</div>";
		}
		echo "</div>";
		?>
		<style>
            #date-cells{
                /*font-size:0;*/
                margin:1em;
            }
            /*.date-cell{*/
                /*font-size:1em;*/
            /*}*/
            .date-cell-text{
                position: absolute;
                right: 9px;
                top: 8px;
            }
			.date-cell-wrapper {
                position:relative;
				background: #fff;
				outline:1px solid #e2e2e2;
				height: 100px;
				width: 14%;
				display: inline-block;
			}
			div#date-cells {
				width: 920px;
			}
			.date-cell-heading-wrapper .date-cell-heading-container{
                padding: 3px 4px;
            }
			.date-cell-heading-wrapper .date-heading-text{
				padding: 4px 13px;
				display: inline-block;
				text-transform: uppercase;
			}
			.date-cell-heading-wrapper{
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
