<?php
/**
 * General functions.
 */

/**
 * Check if user is logged in.
 *
 * @return bool    True if logged in, else false
 */
function isLoggedIn(\Anax\Session\Session $session)
{
    return $session->has('userid');
}
