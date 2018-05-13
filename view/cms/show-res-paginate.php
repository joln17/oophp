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
<p>Rader per sida: 
    <a href="<?= mergeQueryString($queryString, ['hits' => 5]) ?>">5</a> |
    <a href="<?= mergeQueryString($queryString, ['hits' => 10]) ?>">10</a> |
    <a href="<?= mergeQueryString($queryString, ['hits' => 20]) ?>">20</a>
</p>

<table class="font-small">
    <tr class="first">
        <th>Id<br><?= orderby2($queryString, 'id') ?></th>
        <th>Titel<br><?= orderby2($queryString, 'title') ?></th>
        <th>Typ<br><?= orderby2($queryString, 'type') ?></th>
        <th>Path<br><?= orderby2($queryString, 'path') ?></th>
        <th>Slug<br><?= orderby2($queryString, 'slug') ?></th>
        <th>Publicerad<br><?= orderby2($queryString, 'published') ?></th>
        <th>Skapad<br><?= orderby2($queryString, 'created') ?></th>
        <th>Uppdaterad<br><?= orderby2($queryString, 'updated') ?></th>
        <th>Borttagen<br><?= orderby2($queryString, 'deleted') ?></th>
    <?php if ($isLoggedIn) : ?>
        <th><i class="fas fa-edit"></i></th>
        <th><i class="fas fa-trash"></i></th>
    <?php endif; ?>
    </tr>
<?php foreach ($res as $row) : ?>
    <tr>
        <td><?= $row->id ?></td>
        <td><?= $row->title ?></td>
        <td><?= $row->type ?></td>
        <td><?= $row->path ?></td>
        <td><?= $row->slug ?></td>
        <td><?= $row->published ?></td>
        <td><?= $row->created ?></td>
        <td><?= $row->updated ?></td>
        <td><?= $row->deleted ?></td>
        <td><a href="edit?id=<?= $row->id ?>"><i class="fas fa-edit"></i></a></td>
    <?php if (!$row->deleted) : ?>
        <td><a href="delete?id=<?= $row->id ?>"><i class="fas fa-trash"></i></a></td>
    <?php else : ?>
        <td><a href="undelete?id=<?= $row->id ?>"><i class="fas fa-undo"></i></a></td>
    <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>

<p>
    Sida:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString($queryString, ['page' => $i]) ?>"><?= $i ?></a> 
    <?php endfor; ?>
</p>

