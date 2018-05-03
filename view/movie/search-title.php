<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<form method="get">
    <fieldset>
    <legend>Sök</legend>
    <p>
        <label>Titel (använd % som jokertecken):
            <input type="search" name="searchTitle" value="<?= htmlentities($searchTitle) ?>">
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    </fieldset>
</form>
