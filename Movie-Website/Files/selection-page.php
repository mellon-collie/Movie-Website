<?php
?>
<!DOCTYPE html>
<html >
    <head>
        <meta charset="UTF-8">
        <title>Selection Page</title>
        <link rel="stylesheet" href="../CSS/selection.css">
    </head>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript">
         function getGenreId(genre)
         {   
            $.ajax({
                type:'post',
                url:'getNumberWatchedMovies.php',
                data:{"genreName":genre},
                success: function (){
                    $.ajax({
                    type: 'post',
                    url: 'getGenreId.php',
                    data: {"genreName":genre},
                    success: function(data_1) 
                    {
                        //window.onload = window.location.href;
                        window.location.href = "activity-page.php?genreId="+data_1;
                    }
                }
            });

                }
            });
           
        }
    </script>
    <body>
        <nav class='menu'>
            <input checked='checked' class='menu-toggler' id='menu-toggler' type='checkbox'>
            <label for='menu-toggler'></label>
            <ul>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Action')">Action</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Adventure')">Adventure</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Animation')">Animation</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Thriller')">Thriller</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Comedy')">Comedy</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Romance')">Romance</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Science Fiction')">Sci-Fi</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Mystery')">Mystery</a>
                </li>
                <li class='menu-item'>
                    <a href='#' onclick="getGenreId('Horror')">Horror</a>
                </li>
            </ul>
        </nav>
    </body>
</html>
