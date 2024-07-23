<?php

function read(string $table, string $fields = '*')
{
    global $query;

    if (isset($query['sql'])) {
        $query['sql'] = [];
    }

    $query['read'] = true;
    $query['execute'] = [];
    $query['table'] = $table;

    $query['sql'] = "SELECT {$fields} FROM {$table}";
}