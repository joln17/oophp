<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<h1><?= $title ?></h1>
<h2>Test av BB-kod</h2>
<h3>Källkod</h3>
<pre><?= $bbText ?></pre>
<h3>Filtrerad</h3>
<p><?= $bbTextFormatted ?></p>
<br>
<hr>
<br>
<h2>Test av make clickable</h2>
<h3>Källkod</h3>
<pre><?= htmlentities($mcText) ?></pre>
<h3>Filtrerad</h3>
<p><?= $mcTextFormatted ?></p>
<br>
<hr>
<br>
<h2>Test av markdown</h2>
<h3>Källkod</h3>
<pre><?= $mdText ?></pre>
<h3>Filtrerad</h3>
<?= $mdTextFormatted ?>
<br>
<hr>
<br>
<h2>Test av nl2br</h2>
<h3>Källkod</h3>
<p><?= $nbText ?></p>
<h3>Filtrerad</h3>
<?= $nbTextFormatted ?>
