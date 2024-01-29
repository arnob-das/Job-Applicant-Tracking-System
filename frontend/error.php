<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Error Page</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .error-container {
            max-width: 400px;
        }
    </style>
</head>

<body>

    <div class="error-container">
        <h2 class="mb-4">Oops! Something went wrong.</h2>
        <p class="mb-4">We're sorry, but it seems there was an error processing your request.</p>
        <a href="#" class="btn btn-primary" onclick="goBack()">Go Back</a>
    </div>


    <script>
        function goBack() {
            window.history.back();
        }
    </script>

</body>

</html>