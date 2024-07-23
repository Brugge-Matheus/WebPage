<?php

function paginate(string|int $perPage)
{
    global $query;

    $query['paginate'] = true;

    if (isset($query['limit'])) {
        throw new Exception("A paginação não pode ser chamado com o limit", 214);
    }

    $rowCount = execute(rowCount: true);

    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
    $page = $page ?? 1;

    $query['currentPage'] = (int)$page;
    $query['pageCount'] = (int)ceil($rowCount / $perPage);
    $offset = ($page - 1) * $perPage;

    $query['sql'] .= " limit {$perPage} offset {$offset}";
}

function render()
{
    global $query;

    $pageCount = $query['pageCount'];
    $currentPage = $query['currentPage'];
    $class = '';
    $maxLinks = 5;

    $links = '<ul class="pagination">';

    if ($query['currentPage'] > 1) {
        $page = ($currentPage - 1);
        $linkPage = http_build_query(array_merge($_GET, ['page' => $page]));
        $links .= '<li class="page-item"><a href="?' . $linkPage . '" class="page-link">First</a></li>';
        $links .= '<li class="page-item"><a href="?' . $linkPage . '" class="page-link">Previous</a></li>';
    }

    for ($i = ($currentPage - $maxLinks); $i <= ($currentPage + $maxLinks); $i++) {
        if ($i > 0 and $i <= $pageCount) {
            $linkPage = http_build_query(array_merge($_GET, ['page' => $i]));
            $class = $currentPage === $i ? 'active' : '';
            $links .= '<li class="' . $class . '"><a href="?' . $linkPage . '" class="page-link">' . $i . '</a></li>';
        }
    }

    if ($query['currentPage'] < $pageCount) {
        $lastPage = ($query['currentPage'] + 1);
        $linkPage = http_build_query(array_merge($_GET, ['page' => $lastPage]));
        $links .= '<li class="page-item"><a href="?' . $linkPage . '" class="page-link">Next</a></li>';
    }

    $links .= '</ul>';

    return $links;
}