<?php
include( "Hit.php" );

class Entity {
	protected $name = "";
	protected $color = "";
	/* A table with the history of hits? */
	protected $hits = array();
	protected $todays_score = 0;
	protected $proportion = 0;

	public function __construct( /*string*/ $file_name, /*string*/ $color ) {
		$this->name = $file_name;
		$this->color = $color;
		$handle = fopen($file_name, "r");
		$i = 0;
		if ($handle) {
		    while (($line = fgets($handle)) !== false) {
		    	if( $i !== 0 && substr( $line, 0, 1 ) != "%" ){
		            	// process the hit line read.
				$array = explode( ":", $line );
				$this->hits[ $array[1] ] = $array[0];
			} else if( $i === 0 ){
				$score_space = explode( ":", $line );
				$score = explode( " ", $score_space[1] );
				$this->todays_score = $score[0];
			}
			$i++;
		    }
		} else {
		    // error opening the file.
		} 
		fclose($handle);
	}
	
	public function get_name(){
	    return $this->name;
	}
	public function get_color(){
	    return $this->color;
	}
	public function get_score(){
	    return $this->todays_score;
	}
	public function get_proportion(){
	    return $this->proportion;
	}
	public function set_proportion( /*float*/ $proportion ){
	    $this->proportion = $proportion;
	}
	public function get_hits(){
	    return $this->hits;
	}
	public function get_latest_hit(){
	    return new Hit( end( $this->hits ), new DateTime( key( $this->hits ) ) );
	}
	public function get_first_hit(){
	    return new Hit( reset($this->hits) , new DateTime( key( $this->hits ) ) );
	}
	public function get_todays_hits(){
	    $arr = $this->hits;
	    $input = strtotime('today midnight');
	    $the_key = get_closest_key( $arr, $input );
	    return array_slice( $arr, $the_key );
	}
	private function get_closest_key( $arr, $input){
	    if (isset($arr[$input])) {
	        return $input;
	    }
	    
	    foreach ($arr as $key => $value) {
	        if ($key > $input) {
	            if (prev($arr) === FALSE) {
	                // If the input is smaller than the first key
	                return $key;
	            }
	            $prevKey = key($arr);
	    
	            if (abs($key - $input) < abs($prevKey - $input)) {
	                return $key;
	            } else {
	                return $prevKey;
	            }
	    	}
	    }
	}

}
