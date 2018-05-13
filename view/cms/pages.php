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

<table>
    <tr class="first">
        <th>Id</th>
        <th>Titel</th>
        <th>Status</th>
        <th>Publicerad</th>
    </tr>
<?php foreach ($res as $row) : ?>
    <?php if ($isLoggedIn || $row->status == 'isPublished') : ?>
    <tr>
        <td><?= $row->id ?></td>
    <?php if ($row->path) : ?>
        <td><a href="article?page=<?= $row->path ?>"><?= $row->title ?></a></td>
    <?php else : ?>
        <td><?= $row->title ?></td>
    <?php endif; ?>
        <td><?= $row->status ?></td>
        <td><?= $row->published ?></td>
    </tr>
    <?php endif; ?>
<?php endforeach; ?>
</table>
