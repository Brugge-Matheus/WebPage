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

function where(string $field, string $operator, string|int $value)
{
    global $query;

    if (isset($query['read'])) {
        throw new Exception("É necessario executar o read antes do where" . 210);
    }

    if (func_num_args() !== 3) {
        throw new Exception("O where precisa de exatamente 3 parâmetros", 213);
    }

    $query['where'] = true;
    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] = "{$query['sql']} WHERE {$field} {$operator} :{$field}";
}

function orWhere(string $field, string $operator, string|int $value, string $typeWhere = 'or')
{
    global $query;

    if (isset($query['where'])) {
        throw new Exception('É necessário executar o where antes do or where', 211);
    }

    if ($typeWhere !== 'and' && $typeWhere !== 'or') {
        throw new Exception("Condicional inválida, necessário escolher AND ou OR", 212);
    }

    if (func_num_args() < 3 or func_num_args() > 4) {
        throw new Exception("O orWhere precisa de 3 ou 4 parâmetros", 213);
    }

    $query['execute'] = array_merge($query['execute'], [$field => $value]);
    $query['sql'] = "{$query['sql']} " . strtoupper($typeWhere) . " {$field} {$operator} :{$field}";
}

function limit(string|int $limit)
{
    global $query;

    if (isset($query['paginate'])) {
        throw new Exception("O limit não pode ser chamado com a paginação", 214);
    }

    $query['limit'] = true;
    $query['sql'] = "{$query['sql']} LIMIT {$limit}";
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

    $query['sql'] = "{$query['sql']} ORDER BY {$field} {$type}";
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