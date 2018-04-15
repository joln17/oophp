<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1><?= $title ?></h1>
<p>Guess a number betwen 1 and 100, you have <?= $game->tries() ?> tries left.</p>
<form method="<?= $method ?>">
    <input type="number" name="guess" value="<?= $guess ?>" autofocus>
<?php if (!$session) : ?>
    <input type="hidden" name="number" value="<?= $game->number() ?>">
    <input type="hidden" name="tries" value="<?= $game->tries() ?>">
<?php endif; ?>
    <input type="submit" name="doGuess" value="Guess">
    <input type="submit" name="doReset" value="Reset">
    <input type="submit" name="doCheat" value="Cheat">
</form>
<p><?= $res ?></p>
