<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<form method="post">
    <fieldset>
    <legend>Ange användarnamn och lösenord</legend>

    <p>
        <label>Användarnamn:<br>
        <input type="text" name="user" required>
        </label>
    </p>

    <p>
        <label>Lösenord:<br>
        <input type="password" name="password" required>
    </p>

    <p>
        <input type="submit" name="login" value="Logga in"><br><br>
        <?= $message ?>
    </p>
    </fieldset>
</form>
