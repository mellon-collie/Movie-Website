<?php
$cSession = curl_init('https://api.themoviedb.org/3/genre/28/movies?api_key=9fec24ec7d4e672df882a26a2de58930&language=en-US&page=1&include_adult=false&sort_by=vote_average.desc');
curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER,false);
    $result = curl_exec($cSession);
    curl_close($cSession);  
    $json = json_decode($result); 
    print_r($json); 
?>