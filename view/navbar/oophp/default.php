<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<navbar>
    <a href="<?= url("") ?>">Hem</a> |
    <a href="<?= url("redovisning") ?>">Redovisning</a> |
    <a href="<?= url("om") ?>">Om</a> |
    <a href="<?= url("lek") ?>">Lek</a> |
    <a href="<?= url("gissa") ?>">Gissa</a> |
    <a href="<?= url("tarning100") ?>">Tärningsspel</a> |
    <a href="<?= url("movie/show") ?>">Film</a> |
    <a href="<?= url("textfilter/test") ?>">Textfilter</a> |
    <a href="<?= url("content/show") ?>">CMS</a> |
    <a href="<?= url("debug") ?>">Debug</a>
</navbar>
