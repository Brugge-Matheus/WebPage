<?php 

function all(string $table, string $fields = '*'): array {
    try {
        $connect = connect();

        $query = $connect->query("SELECT {$fields} FROM {$table}");
        return $query->fetchAll();

    } catch (PDOException $e) {
        dd($e->getMessage());
    }
}

function findBy($table, $whereField, $whereValue, $fields = '*') {

    try {
        $connect = connect();

        $prepare = $connect->prepare("SELECT {$fields} from {$table} WHERE {$whereField} = :{$whereField}");   
        $prepare->execute([
            $whereField => $whereValue
        ]);
        
        return $prepare->fetch();

    } catch (PDOException $e) {
        dd($e->getMessage());
    }
    
}