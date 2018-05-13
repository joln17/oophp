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
<h1><?= htmlentities($title) ?></h1>
<p style="color:red;"><b>Status: <?= $res->status ?></b></p>
<div>
<?= $res->data ?>
</div>
<?php elseif ($res->status == 'isPublished') : ?>
<h1><?= htmlentities($title) ?></h1>
<div>
<?= $res->data ?>
</div>
<?php endif; ?>
