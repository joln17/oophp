<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$article) {
    return;
}
?>

<form method="post">
    <fieldset>
    <legend>Redigera</legend>

    <p>
        <label>Titel:<br>
        <input type="text" name="title" value="<?= $article->title ?>">
        </label>
    </p>

    <p>
        <label>Path:<br>
        <input type="text" name="path" value="<?= $article->path ?>">
        </label>
    </p>

    <p>
        <label>Slug:<br>
        <input type="text" name="slug" value="<?= $article->slug ?>">
        </label>
    </p>

    <p>
        <label>Text:<br>
        <textarea name="data" rows="10" cols="75"><?= $article->data ?></textarea
        </label>
    </p>

    <p>
        <label>Typ:<br>
        <select>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type ?>" <?= $type != $article->type ? : "selected" ?>><?= $type ?></option>
        <?php endforeach; ?>;
        </select>
        </label>
    </p>

    <p>
        <label>Filter:<br>
        <select multiple>
        <?php $articleFilters = explode(',', $article->filter); foreach ($filters as $filter) : ?>
            <option value="<?= $filter ?>" <?= !in_array($filter, $articleFilters) ? : "selected" ?>><?= $filter ?></option>
        <?php endforeach; ?>;
        </select>
        </label>
    </p>

    <p>
        <label>Publiceringsdatum och tid:<br>
        <input type="date" name="published-date" value="<?= substr($article->published, 0, 10) ?>">
        <input type="time" name="published-time" value="<?= substr($article->published, 11, 8) ?>">
        </label>
    </p>

    <p>
        <input type="submit" name="doSave" value="Spara">
        <input type="reset" value="Reset">
    </p>
    </fieldset>
</form>
