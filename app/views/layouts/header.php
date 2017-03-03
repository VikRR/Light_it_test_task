<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../../../vendor/components/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../css/style.css'">
    <title>Comments</title>
</head>
<body>

<div class="container">
    <div class="row text-right">

        <?php if (!empty($_SESSION['fb_id'])): ?>
            <nav>
                <a href="/logout" class="btn btn-info">Logout</a>
            </nav>
        <?php endif; ?>

    </div>