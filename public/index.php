<?php require 'bootstrap.php'?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php     
    try {
        $data = router();
        
        extract($data['data']);
        
        if(!isset($data['view'])) {
            throw new Exception('O índice view esta faltando');
            
        }

        if(!file_exists(VIEW_DIR.$data['view'])) {
            throw new Exception("Essa view: {$data['view']}, não existe");
        }

        $view = $data['view'];
        
        require VIEW_DIR.'master.php';
    } catch(Exception $e) {
        dd($e->getMessage());
    }
    ?>




</body>

</html>