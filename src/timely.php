<?php

class Timely extends DateTime {

	private $TIMEZONE;
	private $TIMEFORMAT = array ( "past" => "ago" );
	private $FROMDATETIME;
	private $THRESHOLDS = array(
            "s" => 1,  // seconds to minute
            "m" => 1,  // minutes to hour
            "h" => 1,  // hours to day
            "d" => 1,  // days to month
            "M" => 1   // months to year
        );
	private static $SUFFIX = "전";

	public function __construct($time = null, $timezone = null) {		
		/*
		if( is_null( $locale )) {
		}
		$this->LOCALE = $locale;
		*/
		if ( !is_null($timezone) ) {
			parent::__construct($time);
		} else {
			parent::__construct($time);
		}
	}

	public function setTime( $value ) {
		$this->FROMDATETIME =  new DateTime( $value );
	}

	public static function pluralize($count, $singular, $plural = false) {
		$result = $singular;
		if( !$plural && $count != 1 ) { $result = $singular.'s'; }
		return sprintf("%s %s", $singular, static::$SUFFIX);
	}	

	private static function _getRelativeTime( $intervalObj ) {
		$relativeTimeResult = "";
		if ( $intervalObj->y >= 1 ) { 
			$relativeTimeResult = $intervalObj->y.static::pluralize( $intervalObj->y , "년" , true ); 
		} else if ($intervalObj->m >= 1) {
			$relativeTimeResult = $intervalObj->m.static::pluralize( $intervalObj->m , "월" , true ); 
		} else if ($intervalObj->d >= 1) {
			$relativeTimeResult = $intervalObj->d.static::pluralize( $intervalObj->d , "일" , true ); 
		} else if ($intervalObj->h >= 1) {
			$relativeTimeResult = $intervalObj->h.static::pluralize( $intervalObj->h ,"시간" , true ); 
		} else if ($intervalObj->i >= 1) {
			$relativeTimeResult = $intervalObj->i.static::pluralize( $intervalObj->i, "분" , true ); 
		} else {
			$relativeTimeResult = $intervalObj->s.static::pluralize( $intervalObj->s, "초" , true ); 
		}		
		return $relativeTimeResult;
	}

	public static function getRelTimeFromNow( $fromdatetime ) {
		$todatetime = new DateTime();
		$interval = $todatetime->diff(new DateTime( $fromdatetime ));
		return static::_getRelativeTime( $interval );
	}

	public static function now($time = null) {
        return new static( null, $tz );
    }
	
	public function addYears( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addYears function only accepts integers. Input was: '.$value);
		}
		return $this->modify( intval($value) . ' year');
	}

	public function addMonths( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addMonths function only accepts integers. Input was: '.$value);
		}
		return $this->modify( intval($value) . ' month');
	}

	public function addDays( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addDays function only accepts integers. Input was: '.$value);
		}
		return $this->modify( intval($value) . ' day');
	}

	public function addHours( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addHours function only accepts integers. Input was: '.$value);
		}
		return $this->modify( intval($value) . ' hour');
	}

	public function addMinutes( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addMinutes function only accepts integers. Input was: '.$value);
		}
		return $this->modify( intval($value) . ' minute');
	}

	public function addSeconds($value)
    {
        if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addSeconds function only accepts integers. Input was: '.$value);
		}
		return $this->modify( intval($value) . ' second');
    }
}
?>
