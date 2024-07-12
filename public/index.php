<?php require 'bootstrap.php';

    
    try {
        $data = router();

        if(!isset($data['data'])) {
            throw new Exception('O índice data esta faltando');
            
        }

        if(!isset($data['data']['title'])) {
            throw new Exception('O índice title esta faltando');
            
        }
        
        if(!isset($data['view'])) {
            throw new Exception('O índice view esta faltando');
            
        }

        if(!file_exists(VIEW_DIR.$data['view'] .'.php')) {
            throw new Exception("Essa view: {$data['view']}, não existe");
        }
        
        // Create new Plates instance
        $templates = new League\Plates\Engine(VIEW_DIR);

        // Render a template
        echo $templates->render($data['view'], $data['data']); 

        // extract($data['data']);

        // $view = $data['view'];
        
        // require VIEW_DIR.'master.php';

    } catch(Exception $e) {
        
        dd($e->getMessage());
    }