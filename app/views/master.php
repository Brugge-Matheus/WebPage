<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div id="header">
        <?php require(VIEW_DIR.'partials/header.php')?>
    </div>

    <div class="container">
        <?php require VIEW_DIR.$view?>
    </div>

</body>

</html>