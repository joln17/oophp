<?php
/**
 * CMS specific routes.
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
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }
    $data = [
        'title' => "Artiklar i databasen",
        'isLoggedIn' => $isLoggedIn
    ];
    $app->view->add('cms/header', $data);

    $hits = $app->request->getGet('hits', 10);
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
        $app->response->redirect("content/show{$queryString}");
    }
    $data['res'] = $content->getRowsPaginate($hits, $page, $orderBy, $order);
    $data['queryString'] = $app->request->getServer('QUERY_STRING');

    $app->view->add('cms/show-res-paginate', $data);
    $app->page->render($data);
});



/**
 * Show page.
 */
$app->router->get('content/article', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    $data = [
        'isLoggedIn' => $isLoggedIn
    ];

    $path = $app->request->getGet('page');
    $content = new \Joln\Content\ContentDB($app->db);

    if (!$path) {
        $app->view->add('cms/header', $data);
        $data['res'] = $content->getArticlesByType('page');
        $data['title'] = "Webbsidor";
        $app->view->add('cms/pages', $data);
        $app->page->render($data);
        exit;
    }

    $data['res'] = $path ? $content->getPage($path) : null;
    $data['title'] = $data['res']->title ?? null;

    $app->view->add('cms/header', $data);
    $app->view->add('cms/article', $data);
    $app->page->render($data);
});



/**
 * Show blog.
 */
$app->router->get('content/blog', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    $data = [
        'isLoggedIn' => $isLoggedIn
    ];

    $slug = $app->request->getGet('post');
    $content = new \Joln\Content\ContentDB($app->db);

    if (!$slug) {
        $app->view->add('cms/header', $data);
        $data['res'] = $content->getArticlesByType('post');
        $data['title'] = "Blog";
        $app->view->add('cms/blog', $data);
        $app->page->render($data);
        exit;
    }

    $data['res'] = $content->getBlogpost($slug);
    $data['title'] = $data['res']->title ?? null;
    $app->view->add('cms/header', $data);
    $app->view->add('cms/blogpost', $data);
    $app->page->render($data);
});



/**
 * Create article.
 */
$app->router->any(['GET', 'POST'], 'content/create', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }
    $data = [
        'title' => "Skapa ny artikel",
        'isLoggedIn' => $isLoggedIn
    ];

    $content = new \Joln\Content\ContentDB($app->db);

    if ($app->request->getPost('doAdd')) {
        $post = $app->request->getPost();
        $articleData = [
            'title'     => $post['title'] ? $post['title'] : null,
            'type'      => $post['type'] ? $post['type'] : null,
            'user'      => $app->session->get('userid'),
            'published' => null
        ];
        if ($articleData['type'] == 'post') {
            $articleData['slug'] = $content->getUniqueSlug($articleData['title']);
        }
        $articleId = $content->addRow($articleData);
        $app->response->redirect("content/edit?id=$articleId");
        exit;
    }

    $app->view->add('cms/header', $data);
    $data['types'] = $content->getArticleTypes();
    $app->view->add('cms/create', $data);
    $app->page->render($data);
});



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
        $app->response->redirect('content/show');
        exit;
    }

    if ($app->request->getPost('doDelete')) {
        $app->response->redirect("content/delete?id={$articleId}");
        exit;
    }

    if ($app->request->getPost('doUndelete')) {
        $app->response->redirect("content/undelete?id={$articleId}");
        exit;
    }

    $content = new \Joln\Content\ContentDB($app->db);

    if ($app->request->getPost('doSave')) {
        $post = $app->request->getPost();

        $articleData = [
            'title' => $post['title'] ? $post['title'] : null,
            'data'  => $post['data'] ? $post['data'] : null,
            'type'  => $post['type'] ? $post['type'] : null
        ];

        if (isset($post['path'])) {
            $articleData['path'] = $content->getUniquePath($post['path'], $articleId, $articleData['type']);
        }

        $slugStr = $post['slug'] ? $post['slug'] : $articleData['title'];
        $articleData['slug'] = ($post['type'] == 'post')
            ? $content->getUniqueSlug($slugStr, $articleId)
            : null;

        $articleData['filter'] = !empty($post['filter'])
            ? implode(',', $post['filter'])
            : null;

        $articleData['published'] = $post['published-date'] && $post['published-time']
            ? $post['published-date'] . ' ' . $post['published-time']
            : null;

        $content->updateRow($articleId, $articleData);
        $app->response->redirect("content/edit?id=$articleId");
        exit;
    }

    $app->view->add('cms/header', $data);
    $article = $content->getRowById($articleId);

    $data['article'] = $article;
    $data['types'] = $content->getArticleTypes();
    $data['filters'] = $content->getArticleFilters();
    $app->view->add('cms/edit', $data);
    $app->page->render($data);
});



/**
 * Delete article.
 */
$app->router->any(['GET', 'POST'], 'content/delete', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }
    $data = [
        'title' => "Ta bort artikel",
        'isLoggedIn' => $isLoggedIn
    ];

    $articleId = $app->request->getGet('id');
    if (!is_numeric($articleId)) {
        $app->response->redirect('content/show');
        exit;
    }
    $content = new \Joln\Content\ContentDB($app->db);

    if ($app->request->getPost('doDelete')) {
        $content->softDeleteArticle($articleId);
        $app->response->redirect('content/show');
        exit;
    }

    $app->view->add('cms/header', $data);
    $data['article'] = $content->getRowById($articleId);
    $app->view->add('cms/delete', $data);
    $app->page->render($data);
});



/**
 * Undelete article.
 */
$app->router->any(['GET', 'POST'], 'content/undelete', function () use ($app) {
    $isLoggedIn = $app->session->has('userid');
    if (!$isLoggedIn) {
        $app->response->redirect('content/login');
        exit;
    }
    $data = [
        'title' => "Ångra borttagning av artikel",
        'isLoggedIn' => $isLoggedIn
    ];

    $articleId = $app->request->getGet('id');
    if (!is_numeric($articleId)) {
        $app->response->redirect('content/show');
        exit;
    }
    $content = new \Joln\Content\ContentDB($app->db);

    if ($app->request->getPost('doUndelete')) {
        $articleData['deleted'] = null;
        $content->updateRow($articleId, $articleData);
        $app->response->redirect('content/show');
        exit;
    }

    $app->view->add('cms/header', $data);
    $data['article'] = $content->getRowById($articleId);
    $app->view->add('cms/undelete', $data);
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
