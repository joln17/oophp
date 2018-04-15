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

    if (!isset($_SESSION['game']) || isset($_POST['reset']) || empty($_POST)) {
        $dices = $_GET['dices'] ?? 1;
        $_SESSION['game'] = new \Joln\Dice100\Dice100($dices);
    }
    
    $game = $_SESSION['game'];
    $points = $game->getPoints();
    $playStatus = -1;
    $message = "Din tur att kasta:";
    
    if (isset($_POST['play'])) {
        $points = $game->play();
        if ($points == 0) {
            $playStatus = 0;
            $message = "Du fick en 1:a. Turen går över till datorn:";
        } else {
            $playStatus = 1;
            $message = "Välj om du vill fortsätta kasta eller stanna:";
        }
    }
    if (isset($_POST['stop'])) {
        $game->stop();
        $playStatus = 0;
        $message = "Du valde att stanna på {$points} poäng. Turen går över till datorn:";
    }
    if (isset($_POST['computer'])) {
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

    $data['game'] = $game;
    $data['points'] = $points;
    $data['score'] = $score;
    $data['winner'] = $winner;
    $data['playStatus'] = $playStatus;
    $data['message'] = $message;

    $app->view->add('dice100/game', $data);
    $app->page->render($data);
});
