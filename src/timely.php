<?php

class timely {

	private $LOCALE;
	private $TIMEFORMAT = array ( "past" => "ago" );
	private $FROMDATETIME;
	private $THRESHOLDS = array(
            "s" => 1,  // seconds to minute
            "m" => 1,  // minutes to hour
            "h" => 1,  // hours to day
            "d" => 1,  // days to month
            "M" => 1   // months to year
        );
	private $SUFFIX = "ago";

	public function __construct($locale)
	{		
		/*
		if( is_null( $locale )) {
		}
		$this->LOCALE = $locale;
		*/
	}

	public function setTime( $value ) {
		$this->FROMDATETIME =  new DateTime( $value );
	}

	public function pluralize($count, $singular, $plural = false) {
		if (!$plural) $plural = $singular . 's';
		return ($count == 1 ? $singular : $plural) ;
	}

	

	private function _getRelativeTime( $intervalObj ) {

		$prefix = "";
		if ( $intervalObj->y >= 1 ) { 
			$prefix = $intervalObj->y."year".$this->pluralize( $intervalObj->y ); 
		} else if ($intervalObj->m >= 1) {
			$prefix = $intervalObj->m."month".$this->pluralize( $intervalObj->m ); 
		} else if ($intervalObj->d >= 1) {
			$prefix = $intervalObj->d."day".$this->pluralize( $intervalObj->d ); 
		} else if ($intervalObj->h >= 1) {
			$prefix = $intervalObj->h."hour".$this->pluralize( $intervalObj->h ); 
		} else if ($intervalObj->i >= 1) {
			$prefix = $intervalObj->i."hour".$this->pluralize( $intervalObj->i ); 
		} else {
			$prefix = $intervalObj->s."hour".$this->pluralize( $intervalObj->s ); 
		}
		
		echo $prefix." ".$this->SUFFIX;

	}
	
	public function getRelativeTime( $value ) {
		// 현재 서버 시간 
		// 해당 시간 시간
		$todatetime = new DateTime();
		if ( is_null ( $this->FROMDATETIME ) ) {
			$this->FROMDATETIME = new DateTime( $value );
		}		
		$interval = $todatetime->diff($this->FROMDATETIME);
		return $this->_getRelativeTime( $interval );
		
	}

/*

/*
		$seconds = $intervalObj->s;
		$minutes = $intervalObj->i;
		$hours = $intervalObj->h;
		$days = $intervalObj->d;
		$months = $intervalObj->m;
		$years = $intervalObj->y;
	

    function relativeTime(posNegDuration, withoutSuffix, locale) {
        var duration = moment.duration(posNegDuration).abs(),
            seconds = round(duration.as('s')),
            minutes = round(duration.as('m')),
            hours = round(duration.as('h')),
            days = round(duration.as('d')),
            months = round(duration.as('M')),
            years = round(duration.as('y')),

            args = seconds < relativeTimeThresholds.s && ['s', seconds] ||
                minutes === 1 && ['m'] ||
                minutes < relativeTimeThresholds.m && ['mm', minutes] ||
                hours === 1 && ['h'] ||
                hours < relativeTimeThresholds.h && ['hh', hours] ||
                days === 1 && ['d'] ||
                days < relativeTimeThresholds.d && ['dd', days] ||
                months === 1 && ['M'] ||
                months < relativeTimeThresholds.M && ['MM', months] ||
                years === 1 && ['y'] || ['yy', years];

        args[2] = withoutSuffix;
        args[3] = +posNegDuration > 0;
        args[4] = locale;
        return substituteTimeAgo.apply({}, args);
    }

*/
	
}
