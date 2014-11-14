<?php
function write_score( $file, $score=null  ){
	$handle = fopen($filename, "r");
        if ($handle) {
		$line = fgets($handle);
		if( $score === null ){
			$score = explode( " ", explode( ":", $line )[1])[0];
			$score = int( $score ) +1;
		}
		$to_write = "score:".$score;
		for( $j=0; $j< ( 49-strlen( $towrite ) ); $j++ ){
			$to_write .= " ";
		}
		$to_write += "%";
              	fwrite( $handle, $to_write );
        }	
}

$api_token = "5032dc6f-172b-4f96-9835-98b616405161";

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
	$file = escapeshellarg($target);
	$latest_hit = `tail -n 1 $file`;
	$score = `head -n 1 $file`;
	if( $latest_hit =< $midnight ){
		file_put_contents( $file, "% ".$score, FILE_APPEND );
		file_put_contents( $file, $now.":".$user, FILE_APPEND );
		write_score( $file, 1 );
	} elseif( $latest_hit > $midnight ){
		file_put_contents( $file, $now.":".$user, FILE_APPEND );
		write_score( $file );
	} else {
		file_put_contents( "error", "ERROR at ".$now.":".$user, FILE_APPEND );
	}
}
?>
