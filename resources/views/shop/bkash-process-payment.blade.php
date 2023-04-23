<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="loader">Processing</div>
    <p style="text-align: center"> We are processing your payment. Do not close this window</p>
    <style>
        body {
            background: #000;
            color: #ccc;
            font-family: sans-serif;
            font-size: 14px;
        }

        .loader {
            width: 150px;
            height: 150px;
            line-height: 150px;
            margin: 100px auto;
            position: relative;
            box-sizing: border-box;
            text-align: center;
            z-index: 0;
            text-transform: uppercase;
        }

        .loader:before,
        .loader:after {
            opacity: 0;
            box-sizing: border-box;
            content: "\0020";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border-radius: 100px;
            border: 5px solid #fff;
            box-shadow: 0 0 50px #fff, inset 0 0 50px #fff;
        }

        .loader:after {
            z-index: 1;
            -webkit-animation: gogoloader 2s infinite 1s;
        }

        .loader:before {
            z-index: 2;
            -webkit-animation: gogoloader 2s infinite;
        }

        @-webkit-keyframes gogoloader {
            0% {
                -webkit-transform: scale(0);
                opacity: 0;
            }

            50% {
                opacity: 1;
            }

            100% {
                -webkit-transform: scale(1);
                opacity: 0;
            }
        }
    </style>
</body>

</html>
