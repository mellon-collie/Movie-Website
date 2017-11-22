<?php
	$number_of_genres = sizeof($_GET);
	$genresIds = [];
	for($i = 0;$i<$number_of_genres;$i++)
	{
		$genresIds[$i] = $_GET["genreId".$i];
	}
	for($j = 0;$j<$number_of_genres;$j++)
	{
		$cSession = curl_init('https://api.themoviedb.org/3/genre/'.$genresIds[$j].'/movies?api_key=9fec24ec7d4e672df882a26a2de58930&language=en-US&include_adult=false&sort_by=vote_average.desc');
    	curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
   	 	curl_setopt($cSession,CURLOPT_HEADER,false);
    	$result = curl_exec($cSession);
    	curl_close($cSession);  
    	$json = json_decode($result); 
    	echo "<br>";
    	print_r($json);
	}
	

?>