<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Εφαρμογή Εκτίμησης Κόστους Μετακόμισης</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>


        <?php
            if(App::environment() == 'production'){
                ?>
                    <!-- Global site tag (gtag.js) - Google Analytics -->
                    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-79842632-7"></script>
                    <script>
                        window.dataLayer = window.dataLayer || [];
                        function gtag(){dataLayer.push(arguments);}
                        gtag('js', new Date());

                        gtag('config', 'UA-79842632-7');
                    </script>
                <?php
            }
        ?>
        
    </head>
    
    <!-- page wrapper start -->
    <body class="container">

        <!-- header start -->
        <section id="the-header" class="text-center my-2">
            <a href="<?php
                    if(env('COMPANY_HOME_URL') == ""){
                        echo url('/');
                    }else{
                        echo env('COMPANY_HOME_URL');
                    }
                ?>">
                <img src="assets/logo.png" width="120">
            </a>
        </section>
        <!-- header end -->   

        <!-- app div start -->
        <div id="app">
            
        </div>
        <!-- app div end -->

    </body>
    <!-- page wrapper end -->

    <script type="text/javascript">
        var CATEGORY_KEYS = JSON.parse('<?php echo json_encode($categoryKeys) ?>');
        var CATEGORIES = JSON.parse('<?php echo json_encode($categories) ?>');
        var OBJECTS = JSON.parse('<?php echo json_encode($objects, JSON_UNESCAPED_UNICODE) ?>');
        var ENV = '<?php echo App::environment(); ?>';
    </script>
    <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</html>
