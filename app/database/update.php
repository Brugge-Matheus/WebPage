<?php

function update(string $table, array $fields, array $where)
{

    if (!arrayIsAssociative($fields) || !arrayIsAssociative($where)) {
        throw new Exception('O array precisa ser associativo no update');
    }

    $connect = connect();

    $values = '';
    $whereFields = implode(array_keys($where));
    $data = array_merge($fields, $where);

    foreach (array_keys($fields) as $field) {
        $values .= "$field = :{$field}, ";
    }

    $values = trim($values, ', ');

    $sql = "UPDATE {$table} SET {$values} WHERE {$whereFields} = :{$whereFields}";


    $prepare = $connect->prepare($sql);
    return $prepare->execute($data);
}