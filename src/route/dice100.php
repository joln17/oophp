<?php
/**
 * Dice 100 game specific routes.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Dice 100 game
 */
$app->router->any(['GET', 'POST'], 'tarning100/game', function () use ($app) {
    $data = [
        'title' => "Tärningsspel 100"
    ];

    $game = $app->session->get('game');
    $post = $app->request->getPost();

    if (!isset($game) || isset($post['reset']) || empty($post)) {
        $dices = $app->request->getGet('dices') ?? 1;
        $game = new \Joln\Dice100\Dice100($dices);
        $app->session->set('game', $game);
    }

    $points = $game->getPoints();
    $playStatus = -1;
    $message = "Din tur att kasta:";
    
    if (isset($post['play'])) {
        $points = $game->play();
        if ($points == 0) {
            $playStatus = 0;
            $message = "Du fick en 1:a. Turen går över till datorn:";
        } else {
            $playStatus = 1;
            $message = "Välj om du vill fortsätta kasta eller stanna:";
        }
    }
    if (isset($post['stop'])) {
        $game->stop();
        $playStatus = 0;
        $message = "Du valde att stanna på {$points} poäng. Turen går över till datorn:";
    }
    if (isset($post['computer'])) {
        $points = $game->computerPlay();
        $message = "Datorn fick {$points} poäng. Din tur att kasta:";
    }

    $score = $game->getScore();
    $winner = $game->checkWinner();

    if ($winner == 'player') {
        $message = "Grattis du vann!";
    } elseif ($winner == 'computer') {
        $message = "Du förlorade. Försök igen!";
    }

    $histogram = new \Joln\Dice100\Histogram();
    $histogram->injectData($game->getDiceHand());

    $data['game'] = $game;
    $data['points'] = $points;
    $data['score'] = $score;
    $data['winner'] = $winner;
    $data['playStatus'] = $playStatus;
    $data['message'] = $message;
    $data['histogram'] = $histogram;

    $app->view->add('dice100/game', $data);
    $app->page->render($data);
});
