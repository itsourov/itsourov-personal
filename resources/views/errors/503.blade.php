<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Itsourov - Maintenance Page</title>

    <style>
        body {
            background: rgb(103, 66, 230);
            background: linear-gradient(135deg,
                    rgba(103, 66, 230, 1) 35%,
                    rgba(114, 68, 237, 1) 100%);
            color: white;
            font-family: -apple-system, BlinkMacSystemFont, Segoe UI, Helvetica, Arial,
                sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol;
        }

        .error-image {
            max-width: 720px;
            width: 90%;
            margin: auto;
            text-align: center;
        }

        .error-image h1 {
            font-size: 120px;
            margin: 48px auto 20px;
        }

        .error-msg-container {
            margin: 18px auto 30px auto;
            max-width: 800px;
            width: 80%;
            text-align: center;
        }

        .error-msg-container h1 {
            font-size: 56px;
            max-width: 560px;
            margin: auto auto 48px;
        }
    </style>

</head>

<body>
    <!-- partial:index.partial.html -->
    <div class="error-image">
        <h1>👨‍🔧</h1>
    </div>
    <div class="error-msg-container">
        <h1>We're working on this Website now!</h1>
        <p>We expect this outage to last about 5 minutes. If you continue to see this page, please contact us via email
            at admin@itsourov.com.</p>
        <p>We apologize for any inconvenience.</p>
    </div>
    <!-- partial -->

    <script>
        setTimeout("location.reload(true);", 15000);
    </script>
</body>

</html>
