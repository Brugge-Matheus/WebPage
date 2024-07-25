<?php

function where()
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();
    $validOperators = ['=', '!=', '<', '>', '<=', '>=', 'LIKE', 'IN'];

    if (!isset($query['read'])) {
        throw new Exception("É necessario executar o read antes do where", 210);
    }

    if ($numArgs < 2 or $numArgs > 3) {
        throw new Exception("O where precisa de 2 ou 3 parâmetros", 213);
    }

    if ($numArgs === 2) {
        $field = $args[0];
        $operator = '=';
        $value = $args[1];
    }

    if ($numArgs === 3) {
        $field = $args[0];
        $operator = $args[1];
        $value = $args[2];
    }

    if (!in_array($operator, $validOperators)) {
        throw new Exception("Operador passado no where é inválido", 215);
    }

    if (!is_string($field) || !is_string($operator) && !is_string($value) && !is_numeric($value)) {
        throw new Exception("Tipagem dos parâmetros inválida", 216);
    }

    $fieldWhere = $field;

    if (str_contains($field, '.')) {
        [, $fieldWhere] = explode('.', $field);
    }


    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$fieldWhere => $value]);
    $query['sql'] .= " WHERE {$field} {$operator} :{$fieldWhere}";
}

// function where(string $field, string $operator = '=', string|int $value)
// {
//     global $query;

//     if (!isset($query['read'])) {
//         throw new Exception("É necessario executar o read antes do where", 210);
//     }

//     if (func_num_args() !== 3) {
//         throw new Exception("O where precisa de exatamente 3 parâmetros", 213);
//     }

//     $query['where'] = true;
//     $query['execute'] = array_merge($query['execute'], [$field => $value]);
//     $query['sql'] .= " WHERE {$field} {$operator} :{$field}";
// }

function orWhere()
{
    global $query;

    $args = func_get_args();
    $numArgs = func_num_args();
    $validTypesWhere = ['and', 'or'];
    $validOperators = ['=', '!=', '<', '>', '<=', '>=', 'LIKE', 'IN'];

    // dd($args);

    if (!isset($query['where'])) {
        throw new Exception('É necessário executar o where antes do or where', 211);
    }

    if ($numArgs < 2 || $numArgs > 4) {
        throw new Exception("O where precisa de 2 ou 4 parâmetros", 213);
    }

    $data = match ($numArgs) {
        2 => whereTwoParameters($args),
        3 => whereThreeParameters($args, $validTypesWhere, $validOperators),
        4 => $args
    };

    [$field, $operator, $value, $typeWhere] = $data;

    if (!in_array($operator, $validOperators)) {
        throw new Exception("Operador passado no orWhere é inválido", 215);
    }

    if (!in_array($typeWhere, $validTypesWhere)) {
        throw new Exception("type where passado no orWhere é inválido", 215);
    }

    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] .= " " . strtoupper($typeWhere) . " {$field} {$operator} :{$field}";
}

function whereTwoParameters(array $args): array
{
    $field = $args[0];
    $operator = '=';
    $value = $args[1];
    $typeWhere = 'or';

    return [$field, $operator, $value, $typeWhere];
}

function whereThreeParameters(array $args, array $validTypesWhere, array $validOperators): array
{
    $field = $args[0];
    $operator = in_array($args[1], $validOperators) ? $args[1] : '=';
    $value = in_array($args[1], $validOperators) ? $args[2] : $args[1];
    $typeWhere = in_array($args[2], $validTypesWhere) ? $args[2] : 'or';

    return
        [$field, $operator, $value, $typeWhere];
}

// function orWhere(string $field, string $operator, string|int $value, string $typeWhere = 'or')
// {
//     global $query;

//     if (!isset($query['where'])) {
//         throw new Exception('É necessário executar o where antes do or where', 211);
//     }

//     if ($typeWhere !== 'and' && $typeWhere !== 'or') {
//         throw new Exception("Condicional inválida, necessário escolher AND ou OR", 212);
//     }

//     if (func_num_args() < 3 or func_num_args() > 4) {
//         throw new Exception("O orWhere precisa de 3 ou 4 parâmetros", 213);
//     }

//     $query['execute'] = array_merge($query['execute'], [$field => $value]);
//     $query['sql'] .= " " . strtoupper($typeWhere) . " {$field} {$operator} :{$field}";
// }

function whereIn(string $field, array $data)
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception("O where in não pode ser usado junto com o where", 214);
    }

    $whereValues = '\'' . implode('\', \'', $data) . '\'';

    // dd($whereValues);

    $query['sql'] .= " WHERE {$field} IN ({$whereValues})";
}