<?php
/**
 * Movie specific routes.
 */
//var_dump(array_keys(get_defined_vars()));

/**
 * Login.
 */
$app->router->any(['GET', 'POST'], 'movie/login', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    $data = [
        'title' => "Logga in",
        'isLoggedIn' => $isLoggedIn,
        'message' => ""
    ];

    if ($app->request->getPost('login')) {
        $user = $app->request->getPost('user');
        $password = $app->request->getPost('password');

        $movieDB = new \Joln\MovieDB\MovieDB($app->db);
        $verified = $movieDB->verifyLogin($user, $password);
        $data['res'] = $verified;
        if ($verified) {
            $app->session->set('userid', $user);
            $app->response->redirect('movie/crud');
            exit;
        } else {
            $data['message'] = "Fel användarnamn eller lösen";
        }
    }

    $app->view->add('movie/header', $data);
    $app->view->add('movie/login', $data);
    $app->page->render($data);
});



/**
 * Logout.
 */
$app->router->get('movie/logout', function () use ($app) {
    $app->session->delete('userid');
    $app->response->redirect('movie/login');
});



/**
 * Show all movies.
 */
$app->router->get('movie/show-all', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    $data = [
        'title' => "Filmdatabas",
        'isLoggedIn' => $isLoggedIn
    ];
    $app->view->add('movie/header', $data);

    $movieDB = new \Joln\MovieDB\MovieDB($app->db);
    $data['res'] = $movieDB->getAllMovies();

    $app->view->add('movie/show-res', $data);
    $app->page->render($data);
});



/**
 * Search for title.
 */
$app->router->get('movie/search-title', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    $data = [
        'title' => "Sök på titel i filmdatabasen",
        'isLoggedIn' => $isLoggedIn
    ];
    $app->view->add('movie/header', $data);

    $searchTitle = $app->request->getGet('searchTitle');
    $data['searchTitle'] = $searchTitle;
    $app->view->add('movie/search-title', $data);

    if ($searchTitle) {
        $movieDB = new \Joln\MovieDB\MovieDB($app->db);
        $data['res'] = $movieDB->searchTitle($searchTitle);
        $app->view->add('movie/show-res', $data);
    }

    $app->page->render($data);
});



/**
 * Search for year.
 */
$app->router->get('movie/search-year', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    $data = [
        'title' => "Sök på år i filmdatabasen",
        'isLoggedIn' => $isLoggedIn
    ];
    $app->view->add('movie/header', $data);

    $year1 = $app->request->getGet('year1');
    $year2 = $app->request->getGet('year2');
    $data['year1'] = $year1;
    $data['year2'] = $year2;
    $app->view->add('movie/search-year', $data);

    if ($year1 || $year2) {
        $movieDB = new \Joln\MovieDB\MovieDB($app->db);
        $data['res'] = $movieDB->searchYear($year1, $year2);
        $app->view->add('movie/show-res', $data);
    }

    $app->page->render($data);
});



/**
 * CRUD.
 */
$app->router->any(['GET', 'POST'], 'movie/crud', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    if (!$isLoggedIn) {
        $app->response->redirect('movie/login');
        exit;
    }

    $data = [
        'title' => "Skapa ny film eller välj film att redigera/ta bort",
        'isLoggedIn' => $isLoggedIn
    ];

    $movieId = $app->request->getPost('movieId');
    $movieDB = new \Joln\MovieDB\MovieDB($app->db);

    if ($app->request->getPost('doDelete')) {
        $movieDB->deleteMovie($movieId);
        $app->response->redirect('movie/crud');
        exit;
    } elseif ($app->request->getPost('doAdd')) {
        $movieId = $movieDB->addMovie();
        $app->response->redirect("movie/edit?movie_id=$movieId");
        exit;
    } elseif ($app->request->getPost('doEdit') && is_numeric($movieId)) {
        $app->response->redirect("movie/edit?movie_id=$movieId");
        exit;
    } else {
        $app->view->add('movie/header', $data);
        $data['res'] = $movieDB->getAllMovies();
        $app->view->add('movie/crud', $data);
        $app->page->render($data);
    }
});



/**
 * Edit movie.
 */
$app->router->any(['GET', 'POST'], 'movie/edit', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    if (!$isLoggedIn) {
        $app->response->redirect('movie/login');
        exit;
    }
    $data = [
        'title' => "Redigera film",
        'isLoggedIn' => $isLoggedIn
    ];

    $movieId = $app->request->getPost('movieId') ? : $app->request->getGet('movie_id');
    $movieTitle = $app->request->getPost('movieTitle');
    $movieYear = $app->request->getPost('movieYear');
    $movieImage = $app->request->getPost('movieImage');
    $movieDB = new \Joln\MovieDB\MovieDB($app->db);

    if ($app->request->getPost('doSave')) {
        $movieDB->updateMovie($movieTitle, $movieYear, $movieImage, $movieId);
        $app->response->redirect("movie/edit?movie_id=$movieId");
        exit;
    }

    $app->view->add('movie/header', $data);
    $data['movie'] = $movieDB->getMovieById($movieId);
    $app->view->add('movie/edit', $data);
    $app->page->render($data);
});



/**
 * Reset DB.
 */
$app->router->any(['GET', 'POST'], 'movie/reset', function () use ($app) {
    $isLoggedIn = isLoggedIn($app->session);
    if (!$isLoggedIn) {
        $app->response->redirect('movie/login');
        exit;
    }
    $data = [
        'title' => "Återställ databasen",
        'isLoggedIn' => $isLoggedIn,
        'output' => ""
    ];

    $app->view->add('movie/header', $data);

    if ($app->request->getPost('reset')) {
        $movieDB = new \Joln\MovieDB\MovieDB($app->db);
        $data['output'] = $movieDB->reset();
    }

    $app->view->add('movie/reset', $data);
    $app->page->render($data);
});
