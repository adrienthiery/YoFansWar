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
	<div id='recent'>
	<?php foreach( $entities as $entity ){
		echo '<div style="color:'.$entity->get_color().';">'.$entity->get_name().'</div>';
	} ?></div>
	<div id='battle-ground'>
	<?php foreach( $entities as $entity ){ ?>
		<div class='<?php echo $entity->get_name(); ?>' style=''>
		</div>	
	<?php } ?>
	</div>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', '', 'auto');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
</body>
</html>
