<html>
<head>
        <title>YoFansWar</title>
        <meta charset="UTF-8"/>
        <link rel="icon" type="image/png" href="assets/img/favicon.png" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0, user-scalable=yes"/>
        <link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Montserrat:700,400">
    	<link href="//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">        
        <link href="style.css" rel="stylesheet" type="text/css"> 
</head>
<body>
<?php 
	include( 'Entity.php' );
//Read file, define entities, calculate proportions 
	$entities = array(
		new Entity( 'google', "#cc0" ),
		new Entity( 'apple', "#fff" ),
		new Entity( 'microsoft', "#00c" ),
		new Entity( 'yo', "#713b87" )
	);
?>
	<?php 
	$sum = 0;
	foreach( $entities as $entity ){
		$sum += $entity->get_score();
	} ?>
	<div id='recent'>
		<h3>Parties</h3>
	<?php
	foreach( $entities as $entity ){
		if( $sum != 0 )
			$entity->set_proportion( ( $sum - $entity->get_score() )/( $sum * ( count( $entities )- 1 ) ) );
		else
			$entity->set_proportion( 1/count( $entities ) );
		echo '<div class="party">';
		echo '<span class="brand" style="color:'.$entity->get_color().';">'.$entity->get_name().'</span> has been shot '.$entity->get_score().' times today! ';
		if( $entity->get_latest_hit() != null )
			$hit = $entity->get_latest_hit();
			if( $hit->get_soldier() != "INIT\n" )
				echo '<p>Latest soldier to shoot was '.$hit->get_soldier().'</p>';
		echo '</div>';
	} ?>
		<div>
			<h3>Join now</h3>
			<div class='party'>
			<p>Yo YOFANSWAR to get a link to this page</p>
			<a href='http://justyo.co/YOFANSWAR' class='button' target='_blank'>+YOFANSWAR</a>
			<p>Yo the following channels to shoot one of the parties!</p>
			<a href='http://justyo.co/SHOOTAPPLE' class='button' target='_blank'>+SHOOTAPPLE</a>
			<a href='http://justyo.co/SHOOTGOOGLE' class='button' target='_blank'>+SHOOTGOOGLE</a>
			<a href='http://justyo.co/SHOOTMICROSOFT' class='button' target='_blank'>+SHOOTMICROSOFT</a>
			<a href='http://justyo.co/SHOOTYO' class='button' target='_blank'>+SHOOTYO</a>
			</div>
		</div>	
		<div>
			<h3>About</h3>
			<div class='party'>
			<p>YoFansWar is a war between fans of different entities of today's Tech world. Who do you like and support and who do you want to shoot more today : Google, Apple or Microsoft? Maybe we could bring Yo to the same level than the others by sparing it more than the others?</p>
			<p>This graph represents the state of the war. The more a party has been shot, the little a party is.</p>
			</div>
		</div>	
	</div>
	<?php
	$x = ( $entities[0]->get_proportion() + $entities[2]->get_proportion() )*100;
	$y1 = $entities[1]->get_proportion() / ( $entities[1]->get_proportion() + $entities[3]->get_proportion() )*100;
	$y2 = $entities[0]->get_proportion() / ( $entities[0]->get_proportion() + $entities[2]->get_proportion() )*100;
 
	?>
	<div id='battle-ground'>
		<div style='background-color: <?php echo $entities[0]->get_color(); ?>; width:<?php echo $x; ?>%; height: <?php echo $y2; ?>%; '>
		</div>
		<div style='background-color: <?php echo $entities[1]->get_color(); ?>; width:<?php echo 100-$x; ?>%; height: <?php echo $y1; ?>%; left: <?php echo $x; ?>%;'>
		</div>	
		<div style='background-color: <?php echo $entities[2]->get_color(); ?>; width:<?php echo $x; ?>%; height: <?php echo 100-$y2; ?>%; top: <?php echo $y2; ?>%;'>
		</div>	
		<div style='background-color: <?php echo $entities[3]->get_color(); ?>; width:<?php echo 100-$x; ?>%; height: <?php echo 100-$y1; ?>%; top: <?php echo $y1; ?>%; left: <?php echo $x; ?>%;'>
		</div>	
	</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-56757965-2', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
</body>
</html>
