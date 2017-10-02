<?php
    $message = "";
    if (array_key_exists('city', $_GET)) {
        $city = str_replace(' ', '', $_GET["city"]);
        $file = "http://www.weather-forecast.com/locations/".$city."/forecasts/latest";
        $file_headers = @get_headers($file);

        if(!$file_headers || $file_headers[9] == 'HTTP/1.1 404 Not Found') {
            $message = '<div style="margin:0 auto;" class="alert alert-danger col-md-6" role="alert">'.$_GET["city"].': That city could not be found!!</div>';
        }
        else {
            $content = file_get_contents("http://www.weather-forecast.com/locations/".$city."/forecasts/latest");
            $first_step = explode( '<span class="phrase">' , $content );
            $second_step = explode("</span>" , $first_step[1] );

            $message = '<div style="margin:0 auto;" class="alert alert-success col-md-6" role="alert">'.$second_step[0].'</div>';
        }
    }


?>

<html>
    <head>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

        <title>Weather Scraper</title>

        <style type="text/css">

            body{
                background: url(weather.jpg) center;
                background-size: cover;
            }

            .container {
                margin-top: 10%;
            }

        </style>
    </head>

    <body>

        <div class="container">
            <h1 class="text-center"><strong>What's The Weather?</strong></h1>
            <p class="text-center">Enter the name of a city.</p>
            <form>
                <div class="row">
                    <div class="form-group col-md-6 ml-auto mr-auto">
                        <input name="city" type="text" class="form-control" id="city" placeholder="Eg. London, Tokyo" value="<? if (array_key_exists('city', $_GET)) {echo $_GET['city'];} ?>">
                    </div>
                </div>
                <div class="row">
                    <button id="submit" type="submit" class="btn btn-primary ml-auto mr-auto" >Submit</button>
                </div>
            </form>
            <div id="error" ><? echo $message; ?></div>
        </div>


        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>



        <script type="text/javascript">

            $( "#submit" ).click(function( event ) {
                errorMsg = "";
                if ($("#city").val() == "") {
                    errorMsg = "City name is required";
                    $("#error").html('<div style="margin:0 auto; width:100%;" class="alert alert-danger col-md-6 ml-auto mr-auto" role="alert"><strong>Error! </strong>' + errorMsg + '</div>');
                    return false;
                }
                else {
                    return true;
                }

            });

        </script>


    </body>
</html>
