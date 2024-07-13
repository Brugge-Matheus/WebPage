<?php

function delete(string $table, array $where)
{
    if (!arrayIsAssociative($where)) {
        throw new Exception("O array tem que ser associativo no delete");
    }

    $connect = connect();

    $whereValues = implode(array_keys($where));

    $sql = "DELETE FROM {$table} WHERE {$whereValues} = :{$whereValues}";


    $preapare = $connect->prepare($sql);
    return $preapare->execute($where);
}