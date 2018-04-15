<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1><?= $title ?></h1>

<p>Dina poäng totalt: <?= $score['player'] ?> <br>
Datorns poäng totalt: <?= $score['computer'] ?></p>

<p><?= $message ?></p>

<form method="post">

<?php if ($playStatus != 0 && is_null($winner)) : ?>
    <input type="submit" name="play" value="Kasta">
<?php endif; ?>

<?php if ($playStatus == 1 && is_null($winner)) : ?>
    <input type="submit" name="stop" value="Stanna">
<?php endif; ?>

<?php if ($playStatus == 0 && is_null($winner)) : ?>
    <input type="submit" name="computer" value="Låt datorn kasta">
<?php endif; ?>

    <br><br>
    <input type="submit" name="reset" value="Börja om">

</form>

<p>Poäng i spelomgång: <?= $points ?> </p>

<ol>
<?php foreach ($game->getFaceValues() as $valueArr) : ?>
    <li>
    <?php foreach ($valueArr as $value) : ?>
    <span class="dice-sprite dice-<?= $value ?>"></span>
    <?php endforeach; ?>
    </li>
<?php endforeach; ?>
</ol>
