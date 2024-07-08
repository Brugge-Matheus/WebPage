<?php 

function create($table, array $data) {
    try {
        $connect = connect();

        
        $fields = implode(', ', array_keys($data));
        $values = ':' .implode(', :', array_keys($data));

        $sql = "INSERT INTO {$table} (id, {$fields}) VALUES (DEFAULT, {$values})";

        $prepare = $connect->prepare($sql);
        
        return $prepare->execute($data);

    } catch (PDOException $e) {

        dd($e->getMessage());
    }
}