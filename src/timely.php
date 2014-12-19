<?php

class Timely extends DateTime {

	private $TIMEZONE;
	private $TIMEFORMAT = array ( "past" => "ago" );
	private $FROMDATETIME;
	
	private static $SUFFIX = "전";

	private static $DAYS = array(
		'Sunday',
		'Monday',
		'Tuesday',
		'Wednsday',
		'Thursday',
		'Friday',
		'Saturday'
	);


	public function __construct($time = null, $timezone = null) {			
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
			$relativeTimeResult = $intervalObj->m.static::pluralize( $intervalObj->m , "개월" , true ); 
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

	public static function Calendar( $year , $month ) {
	}

	public function getCalendar() {
		$Cal = array();
		for( $i = 1 ; $i <= $this->daysInMonth ; $i++ ) {
			$Cal[] = $this->getDay( $i );
		}
		return $Cal;
	}

	public function month ( $value ) {
		$this->month = $value;
		return $this;
	}

	public function day( $value ) {
		$this->day = $value;
		return $this;
	}

	public function getDay( $value ) {
		return $result = array(
			"date" => $value,
			"day" => $this->day($value)->format('w')
		);
	}

	public function startDayOfMonth() {		
		return $this->getDay(1); 
	}

	public function endDayOfMonth() {
		return $this->getDay($this->daysInMonth); 
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

	public function subYears( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addYears function only accepts integers. Input was: '.$value);
		}
		return $this->modify( -1 * intval($value) . ' year');
	}

	public function subMonths( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addMonths function only accepts integers. Input was: '.$value);
		}
		return $this->modify( -1 *  intval($value) . ' month');
	}

	public function subDays( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addDays function only accepts integers. Input was: '.$value);
		}
		return $this->modify( -1 * intval($value) . ' day');
	}

	public function subHours( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addHours function only accepts integers. Input was: '.$value);
		}
		return $this->modify( -1 * intval($value) . ' hour');
	}

	public function subMinutes( $value ) {
		if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addMinutes function only accepts integers. Input was: '.$value);
		}
		return $this->modify( -1 * intval($value) . ' minute');
	}

	public function subSeconds($value) {
        if ( !is_int( $value ) ) {
			throw new InvalidArgumentException('addSeconds function only accepts integers. Input was: '.$value);
		}
		return $this->modify( -1 * intval($value) . ' second');
    }

	public function __get( $name ) {
		switch ($name) {
            case 'year':
            case 'month':
            case 'day':
            case 'hour':
            case 'minute':
            case 'second':
            case 'micro':
            case 'dayOfWeek':
            case 'dayOfYear':
            case 'weekOfYear':
            case 'daysInMonth':
            case 'timestamp':
                $formats = array(
                    'year' => 'Y',
                    'month' => 'n',
                    'day' => 'j',
                    'hour' => 'G',
                    'minute' => 'i',
                    'second' => 's',
                    'micro' => 'u',
                    'dayOfWeek' => 'w',
                    'dayOfYear' => 'z',
                    'weekOfYear' => 'W',
                    'daysInMonth' => 't',
                    'timestamp' => 'U',
                );
                return (int) $this->format($formats[$name]);
			default:
				throw new InvalidArgumentException(sprintf("Unknown getter '%s'", $name));
				break;
		}
	}
	public function __set( $name , $value) {
		switch ($name) {
            case 'year':
                parent::setDate($value, $this->month, $this->day);
                break;
            case 'month':
                parent::setDate($this->year, $value, $this->day);
                break;
            case 'day':
                parent::setDate($this->year, $this->month, $value);
                break;
            case 'hour':
                parent::setTime($value, $this->minute, $this->second);
                break;
            case 'minute':
                parent::setTime($this->hour, $value, $this->second);
                break;
            case 'second':
                parent::setTime($this->hour, $this->minute, $value);
                break;
            case 'timestamp':
                parent::setTimestamp($value);
                break;
            case 'timezone':
            case 'tz':
                $this->setTimezone($value);
                break;
            default:
                throw new InvalidArgumentException(sprintf("Unknown setter '%s'", $name));
        }
	}

}
?>
