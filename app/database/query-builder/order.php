<?php
function order(string $field, string $type = 'asc')
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception("O order não pode vir antes do limit", 214);
    }

    if (isset($query['paginate'])) {
        throw new Exception("O order não pode vir depois da paginação", 214);
    }

    $query['sql'] .= " ORDER BY {$field} {$type}";
}