<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->e($title) ?></title>
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <div id="header">
        <?=$this->insert('partials/header')?>
    </div>

    <div class="container">
        <?=$this->section('content')?>
    </div>

</body>

</html>