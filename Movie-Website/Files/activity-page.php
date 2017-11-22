<?php
    session_start();
    $watched = $_SESSION["movies_watched"];
    $max = max($watched);
    $cSession = curl_init('https://api.themoviedb.org/3/genre/'.$_GET["genreId"].'/movies?api_key=9fec24ec7d4e672df882a26a2de58930&language=en-US&include_adult=false&sort_by=vote_average.desc');
    /*$cSession = curl_init('https://api.themoviedb.org/3/genre/28/movies?api_key=9fec24ec7d4e672df882a26a2de58930&language=en-US&include_adult=false&sort_by=vote_average.desc');*/
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER,false);
    $result = curl_exec($cSession);
    curl_close($cSession);  
    $json = json_decode($result);
    if(isset($_REQUEST['movies_details']))
    {
        $id = $_REQUEST['movies_details'];
        $_SESSION['movies_details'] = $id;
        header("Location:movie-details.php");
    }



?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../CSS/navbar.css">
		<link rel="stylesheet" type="text/css" href="../CSS/image-hover.css">
		<title> Hover Effect </title>
	</head>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
        <script>
            var id = "<?php echo $_GET["genreId"] ?>";
            function getGenreId(genre)
            {   
            $.ajax({
                type:'post',
                url:'getNumberWatchedMovies.php',
                data:{"genreName":genre},
                success: function (data){
                    alert(data)
                    $.ajax({
                    type: 'post',
                    url: 'getGenreId.php',
                    data: {"genreName":genre},
                    success: function(data_1) {
                        window.location.href = "activity-page.php?genreId="+data_1;
                }
            });

                }
            });
           
        }

            function getGenreName(id)
            {
                $.ajax({
                    type: 'post',
                    url:'getGenreName.php',
                    data: {"genreId":id},
                    success: function (data_1)
                    {
                        genre = data_1;
                        //alert(genre)
                        getNumberOfWatchedMovies(genre)
                    }
                });
            }
            getGenreName(id)
            
            function getNumberOfWatchedMovies(genreName)
            {
                $.ajax({
                    type: 'post',
                    url:'getNumberWatchedMovies.php',
                    data: {"genreName":genreName},
                    success: function (data_1)
                    {
                        numberOfWatchedMovies = data_1;
                    }
                });
            }

            $(document).ready(function() {
                
                $(".heart input:image").click(function(){
                    var index = this.value;
                    var genreIDS = [genre,"1","1",index] 
                    alert(genreIDS)
                        $.ajax({
                        type: 'post',
                        url: 'LikeDislike.php',
                        data: {"genreIDs":genreIDS},
                        success: function(data_2) { 
                               console.log(data_2)                                       
                        }
                });       
                            
                        })
                });
                    
           $(document).ready(function() {
                
                $(".poop input:image").click(function(){
                        var index = this.value
                        var genreIDS = [genre,"0","1",index] 
                        alert(genreIDS)
                        $.ajax({
                            type: 'post',
                            url: 'LikeDislike.php',
                            data: {"genreIDs":genreIDS},
                            success: function(data_2) {
                                console.log(data_2)                                             
                        
                        }
                });      
                            
                        })
                });
            
                    
        </script>
        <?php 
            $watched = $_SESSION["movies_watched"];
            var_dump($watched);
            $max = max($watched);
            $notWatched = [];
            $k = 0;
            if($max == 0)
            {
                for($i = 0;$i<=3;$i++)
                {
                    $notWatched[$k] = $i;
                    $k++;
                }
            }
            else
            {
                for($i = 0;$i<=$max;$i++)
                {
                    if(!in_array($i,$watched))
                    {
                        $notWatched[$k] = $i;
                        $k++;
                    }
                    if($k == 3)
                    {   
                        break;
                    }       
                }
                if($k!=4)
                {
                    while($k!=4)
                    {
                        $notWatched[$k] = $i;
                        $i++;
                        $k++;
                    }
                }
            }
            
            

            var_dump($notWatched);
            
        ?>
	<body>
        <nav>
            <a href="#"><b><?php echo $_SESSION["username"]; ?></b></a>
            <a href="#" onclick="getGenreId('Action')">Action</a>
            <a href="#" onclick="getGenreId('Adventure')">Adventure</a>
            <a href="#" onclick="getGenreId('Animation')">Animation</a>
            <a href="#" onclick="getGenreId('Thriller')">Thriller</a>
            <a href="#" onclick="getGenreId('Comedy')">Comedy</a>
            <a href="#" onclick="getGenreId('Romance')">Romance</a>
            <a href="#" onclick="getGenreId('Science Fiction')">Sci-Fi</a>
            <a href="#" onclick="getGenreId('Mystery')">Mystery</a>
            <a href="#" onclick="getGenreId('Horror')">Horror</a>
            <a href="logout.php"><b>Logout</b></a>
            <div class="animation start-username"></div>
        </nav>  
      
  	<div class = "images">
			<table width=100% style="padding:25px;margin:25px;">
		 	<tr>

			<td>
			<div class="container">
				<div style="position: absolute; top: -250px; left: 40px; width: 30%;">
				<?php 
                    $url = 'https://image.tmdb.org/t/p/w500'.$json->results[$notWatched[0]]->poster_path;                      
                    echo "<img src='".$url."' alt='No Image available' class='image'>"; 
                ?>	
					<div class="overlay">					                       
                        

                            <form>

                             <button class = "buttonDetails" name = "movies_details" value = "<?php echo $json->results[$notWatched[0]]->id ?>">View Details</button> </form>
						<?php echo "<div class =  'text'> Rating:".$json->results[$notWatched[0]]->vote_average."</div>"; ?>
						<div class="heart">
						 <input type="image" src = "../Images/heart.png" width="20" height="20" value = "<?php echo "$notWatched[0]"; ?>">
						</div>
						<div class = "poop">
						<input type="image" src ="../Images/poop.png" width="20" height="20" value = "<?php echo $notWatched[0]?>"/>
						</div>
					</div>
				</div>
			</div>
		</td>

			<td>
			<div class = "container">
			<div style = "position: absolute; top:-250px; left:330px; width:30%;">
				<?php 
                    $url = 'https://image.tmdb.org/t/p/w500'.$json->results[$notWatched[1]]->poster_path;                      
                    echo "<img src='".$url."' alt='No Image available' class='image'>"; 
                ?>	
					<div class="overlay">                       
                        <form>						
                        <button class = "buttonDetails" name = "movies_details" value = "<?php echo $json->results[$notWatched[1]]->id ?>"> View Details</button> </form>
						<?php echo "<div class =  'text'> Rating:".$json->results[$notWatched[1]]->vote_average."</div>"; ?>
						<div class = "heart">
						<input type="image" src="../Images/heart.png" width="20" height="20" value = "<?php echo $notWatched[1]; ?>"/>
						</div>
						<div class = "poop">
						<input type="image" src ="../Images/poop.png" width="20" height="20" value = "<?php echo $notWatched[1]; ?>"/>
						</div>
					</div>
			</div>
			</div>
		</td>

		<td>
			<div class = "container">
			<div style = "position: absolute; top:-250px; left:630px; width:30%;">
				<?php 
                    $url = 'https://image.tmdb.org/t/p/w500'.$json->results[$notWatched[2]]->poster_path;                      
                    echo "<img src='".$url."' alt='No Image available' class='image'>"; 
                ?>	
					<div class="overlay">                        
                        <form>						
                        <button class = "buttonDetails" name = "movies_details" value = "<?php echo $json->results[$notWatched[2]]->id ?>"> View Details</button> </form>
						<?php echo "<div class =  'text'> Rating: ".$json->results[$notWatched[2]]->vote_average."</div>"; ?>
						<div class = "heart">
						<input type="image" src="../Images/heart.png" width="20" height="20" value = "<?php echo $notWatched[2]; ?>"/>
						</div>
						<div class = "poop">
						<input type="image" src ="../Images/poop.png" width="20" height="20" value = "<?php echo $notWatched[2]; ?>"/>
						</div>
					</div>
			</div>
			</div>
		</td>

		<td>
			<div class = "container">
			<div style = "position: absolute; top:-250px; left:930px; width:30%;">
				<?php 
                    $url = 'https://image.tmdb.org/t/p/w500'.$json->results[$notWatched[3]]->poster_path;                      
                    echo "<img src='".$url."' alt='No Image available' class='image'>"; 
                ?>	
					<div class="overlay">                        
                        <form>	                    
                        <button class = "buttonDetails" name = "movies_details" value = "<?php echo $json->results[$notWatched[3]]->id ?>"> View Details</button> </form>
						<?php echo "<div class =  'text'> Rating:".$json->results[$notWatched[3]]->vote_average."</div>"; ?>
						<div class = "heart">
						<input type="image" src="../Images/heart.png" width="20" height="20" value = "<?php echo $notWatched[3]; ?>"/>
						</div>
						<div class = "poop">
						<input type="image" src ="../Images/poop.png" width="20" height="20" value = "<?php echo $notWatched[3]; ?>"/>
						</div>
					</div>
			</div>
			</div>
		</td>
	</tr>
</table>
	</body>
</html>

