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
?>

<p>Filmer per sida: 
    <a href="<?= mergeQueryString($queryString, ['hits' => 2], $defaultRoute) ?>">2</a> |
    <a href="<?= mergeQueryString($queryString, ['hits' => 4], $defaultRoute) ?>">4</a> |
    <a href="<?= mergeQueryString($queryString, ['hits' => 8], $defaultRoute) ?>">8</a>
</p>

<table>
    <tr class="first">
        <th>Rad</th>
        <th>Id <?= orderby2($queryString, 'id', $defaultRoute) ?></th>
        <th>Bild <?= orderby2($queryString, 'image', $defaultRoute) ?></th>
        <th>Titel <?= orderby2($queryString, 'title', $defaultRoute) ?></th>
        <th>År <?= orderby2($queryString, 'year', $defaultRoute) ?></th>
    </tr>
<?php $id = -1; foreach ($res as $row) :
    $id++;
?>
    <tr>
        <td><?= $id ?></td>
        <td><?= $row->id ?></td>
        <td><img src="../image/movie/<?= $row->image ?>&w=100"></td>
        <td><?= $row->title ?></td>
        <td><?= $row->year ?></td>
    </tr>
<?php endforeach; ?>
</table>

<p>
    Sida:
    <?php for ($i = 1; $i <= $max; $i++) : ?>
        <a href="<?= mergeQueryString($queryString, ['page' => $i], $defaultRoute) ?>"><?= $i ?></a> 
    <?php endfor; ?>
</p>

