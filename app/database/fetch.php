<?php

// query builder
$query = [];

function read(string $table, string $fields = '*')
{
    global $query;

    $query['read'] = true;
    $query['execute'] = [];

    $query['sql'] = "SELECT {$fields} FROM {$table}";
}

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
    } else {
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

    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] .= " WHERE {$field} {$operator} :{$field}";
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
        4 => whereFourParameters($args)
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

function whereFourParameters(array $args): array
{
    $field = $args[0];
    $operator = $args[1];
    $value = $args[2];
    $typeWhere = $args[3];

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

function limit(string|int $limit)
{
    global $query;

    if (isset($query['paginate'])) {
        throw new Exception("O limit não pode ser chamado com a paginação", 214);
    }

    $query['limit'] = true;
    $query['sql'] .= " LIMIT {$limit}";
}

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

function search()
{
    global $query;
}

function paginate()
{
    global $query;

    if (isset($query['limit'])) {
        throw new Exception("A paginação não pode ser chamado com o limit", 214);
    }

    $query['paginate'] = true;
}

function execute()
{
    global $query;

    return $query;

    $connect = connect();

    $prepare = $connect->prepare($query['sql']);
    $prepare->execute();

    dd($query);
}

// query complete
function all(string $table, string $fields = '*'): array
{
    try {
        $connect = connect();

        $query = $connect->query("SELECT {$fields} FROM {$table}");
        return $query->fetchAll();
    } catch (PDOException $e) {
        dd($e->getMessage());
    }
}

function findBy($table, $whereField, $whereValue, $fields = '*')
{

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