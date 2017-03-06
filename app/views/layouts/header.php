<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/vendor/components/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="/app/css/main.css">
    <title>Comments</title>
</head>
<body>

<div class="container">
    <nav class="row ">
        <div class="text-right">
            <?php if (!empty($_SESSION['fb_id'])): ?>
                <a href="/logout" class="btn btn-info">Logout</a>
            <?php endif; ?>
        </div>
    </nav>