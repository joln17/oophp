<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

if (!$res) {
    return;
}
$isLoggedIn = $isLoggedIn ?? false;
?>

<?php if ($isLoggedIn && $res->status != 'isPublished') : ?>
<h1><?= htmlentities($res->title) ?></h1>
<p class="font-small">
    <i>Av: <?= htmlentities($res->user) ?> |</i>
    <b style="color:red;">Status: <?= $res->status ?></b>
</p>
<div>
<?= $res->data ?>
</div>
<?php elseif ($res->status == 'isPublished') : ?>
<h1><?= htmlentities($res->title) ?></h1>
<p class="font-small">
    <i>Av: <?= htmlentities($res->user) ?> |</i>
    <i>Publicerad: <time datetime="<?= htmlentities($res->published_iso8601) ?>" pubdate><?= htmlentities($res->published_date) ?></time></i>
</p>
<div>
<?= $res->data ?>
</div>
<?php endif; ?>
