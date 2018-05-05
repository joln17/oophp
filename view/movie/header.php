<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

$isLoggedIn = $isLoggedIn ?? false;
?>

<navbar>
    <a href="show">Visa filmer</a>
    | <a href="search-title">Sök titel</a>
    | <a href="search-year">Sök år</a>
<?php if ($isLoggedIn) : ?>
    | <a href="crud">CRUD</a>
    | <a href="reset">Återställ DB</a>
    | <a href="logout">Logga ut</a>
<?php endif; ?>
<?php if (!$isLoggedIn) : ?>
    | <a href="login">Logga in</a>
<?php endif; ?>
</navbar>

<h1><?= $title ?></h1>
