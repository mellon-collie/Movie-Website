<?php
    session_start();
    $id = $_SESSION['movies_details'];
    $cSession = curl_init('https://api.themoviedb.org/3/movie/'.$id.'?api_key=9fec24ec7d4e672df882a26a2de58930');
    curl_setopt($cSession,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($cSession,CURLOPT_HEADER,false);
    $result = curl_exec($cSession);
    curl_close($cSession);  
    $json = json_decode($result);
?>  


<!DOCTYPE html>
<html>
<head>
    <title>Movie Details</title>
    <style media="screen">

        *
        {
            margin, padding: 0;
        }
        body
        {
            background-color: #1F2739;
            margin: 70px;
        }
        h1 a
        {
        	display: block;
            text-decoration: none;
        	font-family: Neuropol X;
            font-size: 100px;
            letter-spacing: -5px;
        	text-align: center;
        	color: #4DC3FA;
            text-shadow: 0px 3px 8px #2a2a2a;
        }
 	    h1 a:hover
        {
 		    color: #4DC3FA;
            text-shadow: 0px 5px 8px #2a2a2a;
 	    }
        h2
        {
            font-family: Liberation Serif;
        	font-size: 70px;
        	text-align: center;
        	color: #555;
            text-shadow: 0px 2px 3px #171717;
            margin: 0 auto;
            padding: 20px;
        }
        div
        {
            position: relative;
            top: 100px;
        	height: auto;
            margin: 0 auto;
            background: #222;
            padding: 20px;
        	font-size: 22px;
            color: #555;
            text-shadow: 0px 2px 3px #171717;
        	-webkit-box-shadow: 0px 2px 3px #555;
        	-moz-box-shadow: 0px 2px 3px #555;
        	-webkit-border-radius: 10px;
        	-moz-border-radius: 10px;
        }
        #summary
        {
            float: left;
            width: 500px;
        }
        #still
        {
            float: right;
            width: 300px;        
        }
        table
        {
            position: relative;
            top: 200px;
            float: left;
        }

        .container th h1
        {
	        font-weight: bold;
    	    font-size: 1em;
            text-align: left;
            color: #185875;
        }

        .container td
        {
	        font-weight: normal;
	        font-size: 1em;
            -webkit-box-shadow: 0 2px 2px -2px #0E1119;
	        -moz-box-shadow: 0 2px 2px -2px #0E1119;
	        box-shadow: 0 2px 2px -2px #0E1119;
        }

        .container
        {
            border-radius: 20%;
	        text-align: left;
	        overflow: hidden;
	        width: 80%;
	        margin: 0 auto;
            display: table;
            padding: 0 0 8em 0;
        }

        .container td, .container th
        {
	        padding-bottom: 2%;
	        padding-top: 2%;
            padding-left:2%;
        }

        /* Background-color of the odd rows */
        .container tr:nth-child(odd)
        {
        	background-color: #323C50;
        }

        /* Background-color of the even rows */
        .container tr:nth-child(even)
        {
        	background-color: #2C3446;
        }

        .container th
        {
        	background-color: #1F2739;
        }

        

        .container tr:hover
        {
            background-color: #464A52;
            -webkit-box-shadow: 0 6px 6px -6px #0E1119;
        	-moz-box-shadow: 0 6px 6px -6px #0E1119;
        	box-shadow: 0 6px 6px -6px #0E1119;
        }

        .container td:hover
        {
            background-color: #FFF842;
            color: #403E10;
            font-weight: bold;
            box-shadow: #7F7C21 -1px 1px, #7F7C21 -2px 2px, #7F7C21 -3px 3px, #7F7C21 -4px 4px, #7F7C21 -5px 5px, #7F7C21 -6px 6px;
            transform: translate3d(6px, -6px, 0);

            transition-delay: 0s;
        	transition-duration: 0.4s;
        	transition-property: all;
            transition-timing-function: line;
        }

        @media (max-width: 800px)
        {
            .container td:nth-child(4),
            .container th:nth-child(4) { display: none; }
        }
    </style>

    <body>
        <?php echo "<h1><a>".$json->title."</a></h1>"; ?>
        <?php echo '<div id = "summary"><h2>Summary</h2>'.$json->overview.'</div>';
           ?>
        <?php 
            $url = 'https://image.tmdb.org/t/p/w500'.$json->backdrop_path;
            echo'<div id = "still"><img src="'.$url.'" width="300" height="auto" alt="My Image"></div>';
        ?>
        
        <table class="container">
            <tbody>
                <tr>
                    <td><h1>Rating</h1></td>
			        <td><h1>Genre</h1></td>
        			<td><h1>Release Date</h1></td>
                    <td><h1>Budget</h1></td>
                </tr>
                <tr>
                    <td><h1><?php echo $json->vote_average; ?></h1></td>
                    <td><h1><?php echo $json->genres[0]->name; ?></h1></td>
                    <td><h1><?php echo $json->release_date ?></h1></td>
                    <td><h1><?php echo "$".$json->budget;?></h1></td>
                </tr>
          
            </tbody>
        </table>
    </body>
</head>
</html>

