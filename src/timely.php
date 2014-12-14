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
	
}

?>
