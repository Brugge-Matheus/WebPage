<?php

use Doctrine\Inflector\InflectorFactory;

function fieldFK(string $table, string $field)
{
    $inflector = InflectorFactory::create()->build();
    $tableToSingular = $inflector->singularize($table);

    return $tableToSingular . ucfirst($field);
}

function tableJoin(string $table, string $fieldFK, string $typeJoin = 'inner')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception("Não é possível adicionar o where antes do join", 214);
    }

    $fkToJoin = fieldFK($query['table'], $fieldFK);
    $query['sql'] .= " " . strtoupper($typeJoin) . " JOIN {$table} ON {$table}.{$fkToJoin} = {$query['table']}.{$fieldFK}";
}

function tableJoinWithFK(string $table, string $fieldFK, string $typeJoin = 'inner')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception("Não é possível adicionar o where antes do join", 214);
    }

    $fkToJoin = fieldFK($table, $fieldFK);
    $query['sql'] .= " " . strtoupper($typeJoin) . " JOIN {$table} ON {$table}.{$fieldFK} = {$query['table']}.{$fkToJoin}";
}