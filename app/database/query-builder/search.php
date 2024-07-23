<?php

function search(array $searchFields)
{
    global $query;

    if (!isset($query['read'])) {
        throw new Exception("É necessario executar o read antes do search", 210);
    }

    if (isset($query['where'])) {
        throw new Exception("Não é possível chamar o where junto com o search", 210);
    }

    if (!arrayIsAssociative($searchFields)) {
        throw new Exception("A busca precisa ser feita com um array associativo", 217);
    }

    $sql = "{$query['sql']} WHERE ";

    foreach ($searchFields as $field => $searchField) {
        $sql .= "{$field} LIKE :{$field} OR ";
        $execute[$field] = "%{$searchField}%";
    }

    $sql = trim($sql, ' OR ');

    $query['sql'] = $sql;
    $query['execute'] = $execute;
}