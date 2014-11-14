<?php
class Hit {
	protected $soldier = "unknown soldier";
	protected $time = null;

	public function __construct( /*string*/ $soldier, /*DateTime*/ $time=null ) {
		$this->soldier = $soldier;
		if( $time == null )
			$this->time = new DateTime();
		else
			$this->time = $time;
	}
	
	public function get_soldier(){
	    return $this->soldier;
	}
	public function get_time(){
	    return $this->time;
	}
}
