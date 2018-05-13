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

<h1><?= $title ?></h1>

<?php foreach ($res as $row) : ?>
<?php if ($isLoggedIn && $row->status != 'isPublished') : ?>
<h2><a href="blog?post=<?= $row->slug ?>"><?= htmlentities($row->title) ?></a></h2>
<p class="font-small">
    <i>Av: <?= htmlentities($row->user) ?> |</i> 
    <b style="color:red;">Status: <?= $row->status ?></b>
</p>
<div>
<?= $row->data ?>
</div>
<br><hr><br>
<?php elseif ($row->status == 'isPublished') : ?>
<h2><a href="blog?post=<?= $row->slug ?>"><?= htmlentities($row->title) ?></a></h2>
<p class="font-small">
    <i>Av: <?= htmlentities($row->user) ?> |</i>
    <i>Publicerad: <time datetime="<?= htmlentities($row->published_iso8601) ?>" pubdate><?= htmlentities($row->published_date) ?></time></i>
</p>
<div>
<?= $row->data ?>
</div>
<br><hr><br>
<?php endif; ?>
<?php endforeach; ?>