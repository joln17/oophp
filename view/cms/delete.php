<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1><?= $title ?></h1>
<form method="post">
    <fieldset>
    <legend>Bekräfta borttagning av artikel</legend>

    <p>
        <label>Titel:<br>
        <input type="text" name="title" value="<?= htmlentities($article->title) ?>" required>
        </label>
    </p>

    <p>
        <input type="submit" name="doDelete" value="Ta bort">
    </p>
    </fieldset>
</form>
