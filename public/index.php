<?php require 'bootstrap.php';
session_start();

    
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

        if(!file_exists(VIEW_DIR.$data['view'])) {
            throw new Exception("Essa view: {$data['view']}, não existe");
        }
        
        extract($data['data']);

        $view = $data['view'];
        
        require VIEW_DIR.'master.php';

    } catch(Exception $e) {
        
        dd($e->getMessage());
    }