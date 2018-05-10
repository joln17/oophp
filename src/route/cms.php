<?php
/**
 * Movie specific routes.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Login.
 */
$app->router->any(['GET', 'POST'], 'content/login', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    $data = [
        'title' => "Logga in",
        'isLoggedIn' => $isLoggedIn,
        'message' => ""
    ];

    if ($app->request->getPost('login')) {
        $user = $app->request->getPost('user');
        $password = $app->request->getPost('password');

        $content = new \Joln\Content\ContentDB($app->db);
        $verified = $content->verifyLogin($user, $password);
        if ($verified) {
            $app->session->set('userid', $user);
            $app->response->redirect('content/show');
            exit;
        } else {
            $data['message'] = "Fel användarnamn eller lösen";
        }
    }

    $app->view->add('cms/header', $data);
    $app->view->add('cms/login', $data);
    $app->page->render($data);
});



/**
 * Logout.
 */
$app->router->get('content/logout', function () use ($app) {
    $app->session->delete('userid');
    $app->response->redirect('content/login');
});



/**
 * Show all articles with sort and paginate options.
 */
$app->router->get('content/show', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    $data = [
        'title' => "Artiklar i databasen",
        'isLoggedIn' => $isLoggedIn,
        'defaultRoute' => '?'
    ];
    $app->view->add('cms/header', $data);

    $hits = $app->request->getGet('hits', 5);
    $page = $app->request->getGet('page', 1);
    if (!(preg_match('/^(?:5|10|20)$/', $hits) && preg_match('/^\d+$/', $page) && $page != 0)) {
        $app->response->redirect('content/show');
        exit;
    }

    $orderBy = $app->request->getGet('orderby', 'id');
    $order = $app->request->getGet('order', 'asc');

    $content = new \Joln\Content\ContentDB($app->db);
    $data['max'] = $content->getMaxPage($hits);
    if ($page > $data['max']) {
        $queryString = "?hits={$hits}&page={$data['max']}&orderby={$orderBy}&order={$order}";
        $app->response->redirect("movie/show{$queryString}");
    }
    $data['res'] = $content->getRowsPaginate($hits, $page, $orderBy, $order);
    $data['queryString'] = $app->request->getServer('QUERY_STRING');

    $app->view->add('cms/show-res-paginate', $data);
    $app->page->render($data);
});



/**
 * Search for title.
 */
/*$app->router->get('content/search-title', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    $data = [
        'title' => "Sök på titel i artikeldatabasen",
        'isLoggedIn' => $isLoggedIn
    ];
    $app->view->add('cms/header', $data);

    $searchTitle = $app->request->getGet('searchTitle');
    $data['searchTitle'] = $searchTitle;
    $app->view->add('cms/search-title', $data);

    if ($searchTitle) {
        $content = new \Joln\Content\ContentDB($app->db);
        $data['res'] = $content->searchColumn($searchTitle);
        $app->view->add('cms/show-res', $data);
    }

    $app->page->render($data);
});*/



/**
 * CRUD.
 */
/*$app->router->any(['GET', 'POST'], 'content/crud', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }

    $data = [
        'title' => "Skapa ny film eller välj film att redigera/ta bort",
        'isLoggedIn' => $isLoggedIn
    ];

    $movieId = $app->request->getPost('movieId');
    $content = new \Joln\Content\ContentDB($app->db);

    if ($app->request->getPost('doDelete') && is_numeric($movieId)) {
        $content->deleteRow($movieId);
        $app->response->redirect('content/crud');
        exit;
    } elseif ($app->request->getPost('doAdd')) {
        $movieId = $content->addRow();
        $app->response->redirect("content/edit?movie_id=$movieId");
        exit;
    } elseif ($app->request->getPost('doEdit') && is_numeric($movieId)) {
        $app->response->redirect("content/edit?movie_id=$movieId");
        exit;
    } else {
        $app->view->add('cms/header', $data);
        $data['res'] = $content->getAllRows();
        $app->view->add('cms/crud', $data);
        $app->page->render($data);
    }
});*/



/**
 * Edit article.
 */
$app->router->any(['GET', 'POST'], 'content/edit', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }
    $data = [
        'title' => "Redigera artikel",
        'isLoggedIn' => $isLoggedIn
    ];

    $articleId = $app->request->getGet('id');
    if (!is_numeric($articleId)) {
        $app->response->redirect('content/crud');
        exit;
    }
    $articleData = [
        'title' => $app->request->getPost('title'),
        'path'  => $app->request->getPost('path'),
        'slug'  => $app->request->getPost('slug'),

    ];
    $content = new \Joln\Content\ContentDB($app->db);

    if ($app->request->getPost('doSave')) {
        $content->updateRow($articleId, $articleData);
        $app->response->redirect("content/edit?id=$articleId");
        exit;
    }

    $app->view->add('cms/header', $data);
    $data['article'] = $content->getRowById($articleId);
    $data['types'] = $content->getArticleTypes();
    $data['filters'] = $content->getArticleFilters();
    $app->view->add('cms/edit', $data);
    $app->page->render($data);
});



/**
 * Reset DB.
 */
$app->router->any(['GET', 'POST'], 'content/reset', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }
    $data = [
        'title' => "Återställ databasen",
        'isLoggedIn' => $isLoggedIn,
        'output' => ""
    ];

    $app->view->add('cms/header', $data);

    if ($app->request->getPost('reset')) {
        $content = new \Joln\Content\ContentDB($app->db);
        $data['output'] = $content->reset();
    }

    $app->view->add('cms/reset', $data);
    $app->page->render($data);
});
