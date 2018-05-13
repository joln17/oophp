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
    <legend>Skapa ny artikel</legend>

    <p>
        <label>Typ:<br>
        <select name="type">
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type ?>"><?= $type ?></option>
        <?php endforeach; ?>;
        </select>
        </label>
    </p>

    <p>
        <label>Titel:<br>
        <input type="text" name="title" class="edit-text" maxlength="100" required>
        </label>
    </p>

    <p>
        <input type="submit" name="doAdd" value="Lägg till">
    </p>
    </fieldset>
</form>
