<!DOCTYPE html>
<html>
<head>
    <title>Server Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <style>
        body{
            margin:0;
            font-family: Arial, sans-serif;
            background:#f4f7fb;
            height:100vh;
            display:flex;
            align-items:center;
            justify-content:center;
        }

        .error-card{
            background:white;
            width:500px;
            max-width:90%;
            padding:45px;
            text-align:center;
            border-radius:22px;
            box-shadow:0 20px 50px rgba(0,0,0,.12);
        }

        .error-code{
            font-size:80px;
            font-weight:800;
            color:#dc3545;
            margin-bottom:10px;
        }

        .error-title{
            font-size:28px;
            font-weight:700;
            margin-bottom:12px;
            color:#222;
        }

        .error-text{
            color:#6c757d;
            margin-bottom:28px;
            line-height:1.6;
        }

        .btn-home{
            display:inline-block;
            background:#0d6efd;
            color:white;
            padding:12px 30px;
            border-radius:50px;
            text-decoration:none;
            font-weight:600;
        }
    </style>
</head>
<body>

<div class="error-card">
    <div class="error-code">500</div>

    <div class="error-title">
        Oops! Something went wrong
    </div>

    <div class="error-text">
        We are having some technical issue.<br>
        Please try again later.
    </div>

    <button onclick="history.back()" class="btn-home">
        Go Back
    </button>
</div>

</body>
</html>
