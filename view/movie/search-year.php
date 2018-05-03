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
        <label>Släppt mellan: 
        <input type="number" name="year1" value="<?= $year1 ?: 1900 ?>" min="1900" max="2100">
        - 
        <input type="number" name="year2" value="<?= $year2 ?: 2100 ?>" min="1900" max="2100">
        </label>
    </p>
    <p>
        <input type="submit" name="doSearch" value="Sök">
    </p>
    </fieldset>
</form>
