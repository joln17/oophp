<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$movie) {
    return;
}
?>

<form method="post">
    <fieldset>
    <legend>Redigera</legend>

    <p>
        <label>Titel:<br> 
        <input type="text" name="movieTitle" value="<?= $movie->title ?>">
        </label>
    </p>

    <p>
        <label>År:<br> 
        <input type="number" name="movieYear" value="<?= $movie->year ?>">
    </p>

    <p>
        <label>Bild:<br> 
        <input type="text" name="movieImage" value="<?= $movie->image ?>" pattern="[a-z/_-]+?\.(?:jpe?g|png|gif)">
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Spara">
        <input type="reset" value="Reset">
    </p>
    </fieldset>
</form>
