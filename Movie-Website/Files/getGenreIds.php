<?php
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$genres = $_POST["genres"];
		explode(",",$genres);
		$cSession = curl_init("https://api.themoviedb.org/3/genre/movie/list?api_key=9fec24ec7d4e672df882a26a2de58930&language=en-US");
		curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
   		curl_setopt($cSession,CURLOPT_HEADER,false);
    	$result = curl_exec($cSession);
    	curl_close($cSession);
    	$genre_array = json_decode($result);
    	for($j = 0;$j<sizeof($genres);$j++)
    	{
    		for($i = 0;$i<sizeof($genre_array->genres);$i++)
    		{
    			if($genres[$j] == strtolower($genre_array->genres[$i]->name))
    			{
    				echo $genre_array->genres[$i]->id." ";	
    			}
    		
    		}
    	}
    	
	}
?>