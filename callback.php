<?php
function write_score( $file, $score=null  ){
	$handle = fopen($file, "r");
        if ($handle) {
		$line = fgets($handle);
		if( $score === null ){
			$explode_column = explode( ":", $line );
			$explode_space = explode( " ", $explode_column[1]);
			$score = intval( $explode_space[0] ) +1;
		}
		$score = "score:".$score;
		$to_write = $score;
		fclose( $handle );
		$handle = fopen($file, "r+");
		for( $j=0; $j< ( 49-strlen( $score ) ); $j++ ){
			$to_write .= " ";
		}
		$to_write .= "%";
              	fwrite( $handle, $to_write );
        }	
	fclose( $handle );
}

include( '../token_war.php' );

// Receive YO's and increment hits 
// Get parameters from url
$target = $_GET[ 'target' ];
$user = $_GET[ 'username' ];

// Respond on YOFANSWAR
if( $target === "YOFANSWAR" ){
	$url = "http://api.justyo.co/yo";
	$link = "http://yofanswar.thiery.io/";
	$data = array('api_token' => $api_token, 'username' => $user, 'link' => $link);

        $options = array(
                'http' => array(
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method'  => 'POST',
                        'content' => http_build_query($data),
                ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
} elseif( $target === "google" || $target === "apple" || $target === "microsoft" || $target === "yo" ){
	$now = strtotime( "now" );
	$midnight = strtotime( "today midnight" );
	$file = $target;
	$latest_hit = `tail -n 1 $file`;
	$score = `head -n 1 $file`;
	$file = getcwd()."/".$file;
	if( $latest_hit <= $midnight ){
		file_put_contents( $file, "% ".$score, FILE_APPEND );
		file_put_contents( $file, $now.":".$user."\n", FILE_APPEND );
		write_score( $file, 1 );
	} elseif( $latest_hit > $midnight ){
		file_put_contents( $file, $now.":".$user."\n", FILE_APPEND );
		write_score( $file );
	} else {
		file_put_contents( "error", "ERROR at ".$now.":".$user."\n", FILE_APPEND );
	}
}
?>
