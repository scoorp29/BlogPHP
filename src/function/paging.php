<?php


$req = $bdd->query('SELECT id FROM article');

if (!empty($req)) {
    $nb_total_articles = $req->rowCount();

    $nb_articles_par_page = 5;

    $nb_pages_max_left_right = 5;

    $last_page = ceil($nb_total_articles / $nb_articles_par_page);
}
if (isset($_GET['page']) && is_numeric($_GET['page'])) {
    $page_num = $_GET['page'];
} else {
    $page_num = 1;
}

if ($page_num < 1) {
    $page_num = 1;
} else if ($page_num > $last_page) {
    $page_num = $last_page;
}

$limit = 'LIMIT ' . ($page_num - 1) * $nb_articles_par_page . ',' . $nb_articles_par_page;

$sql = "SELECT id, image, title, content FROM article ORDER BY id DESC $limit";

$pagination = '';

if ($last_page != 1) {
    if ($page_num > 1) {
        $previous = $page_num - 1;
        $pagination .= '<a href="index.php?page=' . $previous . '">Previous</a> &nbsp; &nbsp;';

        for ($i = $page_num - $nb_pages_max_left_right; $i < $page_num; $i++) {
            if ($i > 0) {
                $pagination .= '<a href="index.php?page=' . $i . '">' . $i . '</a> &nbsp;';
            }
        }
    }

    $pagination .= '<span class="active">' . $page_num . '</span>&nbsp;';

    for ($i = $page_num + 1; $i <= $last_page; $i++) {
        $pagination .= '<a href="index.php?page=' . $i . '">' . $i . '</a> ';

        if ($i >= $page_num + $nb_pages_max_left_right) {
            break;
        }
    }

    if ($page_num != $last_page) {
        $next = $page_num + 1;
        $pagination .= '<a href="index.php?page=' . $next . '">Next</a> ';
    }
}
