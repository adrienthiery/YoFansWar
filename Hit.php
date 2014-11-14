<?php
class Hit {
	protected $soldier = "unknown soldier";
	protected $time = DateTime();

	public function __construct( /*string*/ $soldier, /*DateTime*/ $time=DateTime() ) {
		$this->soldier = $soldier;
		$this->time = $time;
	}
	
	public function get_soldier(){
	    return $this->soldier;
	}
	public function get_time(){
	    return $this->time;
	}
}
