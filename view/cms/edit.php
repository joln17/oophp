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

<h1><?= $title ?></h1>
<form method="post">
    <fieldset>
    <legend>Redigera</legend>

    <p>
        <label>Typ:<br>
        <select name="type">
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type ?>" <?= $type != $article->type ? "" : "selected" ?>><?= $type ?></option>
        <?php endforeach; ?>;
        </select>
        </label>
    </p>

    <p>
        <label>Titel:<br>
        <input type="text" name="title" class="edit-text" value="<?= htmlentities($article->title) ?>" maxlength="100" required>
        </label>
    </p>
<?php if ($article->type == 'page') : ?>
    <p>
        <label>Path:<br>
        <input type="text" name="path" class="edit-text" value="<?= htmlentities($article->path) ?>" maxlength="100" pattern="^[a-z0-9]+(?:-[a-z0-9]+)*(?:_<?= $article->id ?>)?$">
        </label>
    </p>
<?php endif; ?>
<?php if ($article->type == 'post') : ?>
    <p>
        <label>Slug:<br>
        <input type="text" name="slug" class="edit-text" value="<?= htmlentities($article->slug) ?>" maxlength="100" pattern="^[a-z0-9]+(?:-[a-z0-9]+)*(?:_<?= $article->id ?>)?$">
        </label>
    </p>
<?php endif; ?>
    <p>
        <label>Text:<br>
        <textarea name="data" class="edit-textarea"><?= htmlentities($article->data) ?></textarea>
        </label>
    </p>

    <p>
        <label>Filter:</label><br>
    <?php $articleFilters = explode(',', $article->filter); ?>
    <?php foreach ($filters as $filter) : ?>
        <input type="checkbox" name="filter[]" value="<?= $filter ?>" <?= !in_array($filter, $articleFilters) ? "" : "checked" ?>><?= $filter ?>
    <?php endforeach; ?>
    </p>

    <p>
        <label>Publiceringsdatum och tid:</label><br>
        <input type="date" name="published-date" value="<?= substr($article->published, 0, 10) ?>">
        <input type="time" name="published-time" value="<?= substr($article->published, 11, 8) ?>">
    </p>

    <p>
        <input type="submit" name="doSave" value="Spara">
        <input type="reset" value="Reset">
    <?php if (!$article->deleted) : ?>
        <input type="submit" name="doDelete" value="Ta bort">
    <?php else : ?>
        <input type="submit" name="doUndelete" value="Återskapa">
    <?php endif; ?>
    </p>
    </fieldset>
</form>
