<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<form method="post">
    <input type="submit" name="reset" value="Återställ databasen">
    <?= $output ?>
</form>
