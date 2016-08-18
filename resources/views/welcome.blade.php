<?php
use \Illuminate\Foundation\Inspiring as Inspiring;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Laravel Local</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }

            .quote {
                color: red;
                font-size: 2.7em;
                font-weight: bold;
                font-family: "Comic Sans MS", Tahoma, "Century Gothic" ;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5.3.1 - it`s cool</div>
                <div class="quote"><?= Inspiring::quote(); ?></div>
            </div>
        </div>
    </body>
</html>
