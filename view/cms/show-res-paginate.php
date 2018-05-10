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

<p>Rader per sida: 
    <a href="<?= mergeQueryString($queryString, ['hits' => 5], $defaultRoute) ?>">5</a> |
    <a href="<?= mergeQueryString($queryString, ['hits' => 10], $defaultRoute) ?>">10</a> |
    <a href="<?= mergeQueryString($queryString, ['hits' => 20], $defaultRoute) ?>">20</a>
</p>

<table class="table-font-small">
    <tr class="first">
        <th>Id<br><?= orderby2($queryString, 'id', $defaultRoute) ?></th>
        <th>Titel<br><?= orderby2($queryString, 'title', $defaultRoute) ?></th>
        <th>Typ<br><?= orderby2($queryString, 'type', $defaultRoute) ?></th>
        <th>Path<br><?= orderby2($queryString, 'path', $defaultRoute) ?></th>
        <th>Slug<br><?= orderby2($queryString, 'slug', $defaultRoute) ?></th>
        <th>Publicerad<br><?= orderby2($queryString, 'published', $defaultRoute) ?></th>
        <th>Skapad<br><?= orderby2($queryString, 'created', $defaultRoute) ?></th>
        <th>Uppdaterad<br><?= orderby2($queryString, 'updated', $defaultRoute) ?></th>
        <th>Borttagen<br><?= orderby2($queryString, 'deleted', $defaultRoute) ?></th>
    <?php if ($isLoggedIn) : ?>
        <th class="ta-left"><i class="fas fa-edit"></i><i class="fas fa-trash"></i></th>
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
    <?php if ($isLoggedIn) : ?>
        <td>
            <a href="edit?id=<?= $row->id ?>"><i class="fas fa-edit"></i></a>
            <a href="delete?id=<?= $row->id ?>"><i class="fas fa-trash"></i></a>
        </td>
    <?php endif; ?>
    </tr>
<?php endforeach; ?>
</table>

<p>
    Sida:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString($queryString, ['page' => $i], $defaultRoute) ?>"><?= $i ?></a> 
    <?php endfor; ?>
</p>

