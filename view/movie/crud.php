<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<form method="post">
    <fieldset>
    <legend>Välj</legend>
    <p>
        <input type="submit" name="doAdd" value="Lägg till ny film">
    </p>
    <p>
        <label>Film:<br>
        <select name="movieId">
            <option value="">Välj film...</option>
            <?php foreach ($res as $row) : ?>
            <option value="<?= $row->id ?>"><?= $row->title ?></option>
            <?php endforeach; ?>
        </select>
    </label>
        <input type="submit" name="doEdit" value="Redigera">
        <input type="submit" name="doDelete" value="Ta bort">
    </p>
    </fieldset>
</form>
