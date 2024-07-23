<?php

function execute(bool $isFetchAll = true, bool $rowCount = false)
{
    global $query;

    try {
        $connect = connect();

        if (!isset($query['sql'])) {
            throw new Exception("Não existe uma query a ser executada", 216);
        }

        // dd($query);

        $prepare = $connect->prepare($query['sql']);
        $prepare->execute($query['execute'] ?? []);

        if ($rowCount) {
            $query['count'] = $prepare->rowCount();
            return $query['count'];
        }

        if ($isFetchAll) {
            return (object) [
                'count' => $query['count'] ?? $prepare->rowCount(),
                'rows' => $prepare->fetchAll()
            ];
        }

        return ($isFetchAll) ? $prepare->fetchAll() :
            $prepare->fetch();
    } catch (PDOException $e) {
        ddd($e, "Query: " . $query['sql']);
    }
}