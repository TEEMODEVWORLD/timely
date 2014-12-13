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
	private static $SUFFIX = "ago";

	public function __construct($timezone) {		
		/*
		if( is_null( $locale )) {
		}
		$this->LOCALE = $locale;
		*/
	}

	public function setTime( $value ) {
		$this->FROMDATETIME =  new DateTime( $value );
	}

	public static function pluralize($count, $singular, $plural = false) {
		if (!$plural) $plural = $singular . 's';
		return ($count == 1 ? $singular : $plural) ;
	}

	

	private static function _getRelativeTime( $intervalObj ) {

		$prefix = "";
		if ( $intervalObj->y >= 1 ) { 
			$prefix = $intervalObj->y."year".static::pluralize( $intervalObj->y ); 
		} else if ($intervalObj->m >= 1) {
			$prefix = $intervalObj->m."month".static::pluralize( $intervalObj->m ); 
		} else if ($intervalObj->d >= 1) {
			$prefix = $intervalObj->d."day".static::pluralize( $intervalObj->d ); 
		} else if ($intervalObj->h >= 1) {
			$prefix = $intervalObj->h."hour".static::pluralize( $intervalObj->h ); 
		} else if ($intervalObj->i >= 1) {
			$prefix = $intervalObj->i."hour".static::pluralize( $intervalObj->i ); 
		} else {
			$prefix = $intervalObj->s."hour".static::pluralize( $intervalObj->s ); 
		}
		
		echo $prefix." ".static::$SUFFIX;

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

	public static function getRelTimeFromNow( $fromdatetime ) {
		$todatetime = new DateTime();
		$interval = $todatetime->diff(new DateTime( $fromdatetime ));
		return static::_getRelativeTime( $interval );
	}
	
}
