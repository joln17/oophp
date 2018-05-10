<?php
/**
 * General functions.
 */



/**
 * Function to create links for sorting.
 *
 * @param string $column     The name of the database column to sort by
 * @param string $route      Prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby(string $column, string $route)
{
    return <<<EOD
<span class="orderby">
<a href="{$route}orderby={$column}&order=asc">&darr;</a>
<a href="{$route}orderby={$column}&order=desc">&uarr;</a>
</span>
EOD;
}



/**
 * Function to create links for sorting and keeping the original querystring.
 *
 * @param string $queryString    Current query string
 * @param string $column         The name of the database column to sort by
 * @param string $route          Prepend this to the anchor href
 *
 * @return string with links to order by column.
 */
function orderby2(string $queryString, string $column, string $route)
{
    $asc = mergeQueryString($queryString, ['orderby' => $column, 'order' => 'asc'], $route);
    $desc = mergeQueryString($queryString, ['orderby' => $column, 'order' => 'desc'], $route);
    
    return <<<EOD
<span class="orderby">
<a href="$asc">&darr;</a>&nbsp;<a href="$desc">&uarr;</a>
</span>
EOD;
}



/**
 * Use current querystring as base, extract it to an array, merge it
 * with incoming $options and recreate the querystring using the
 * resulting array.
 *
 * @param string $queryString    Current query string
 * @param array  $options        Options to merge into exitins querystring
 * @param string $prepend        Prepend this the resulting query string
 *
 * @return string as an url with the updated query string.
 */
function mergeQueryString(string $queryString, array $options, string $prepend = '?')
{
    // Parse querystring into array
    $query = [];
    parse_str($queryString, $query);

    // Merge query string with new options
    $query = array_merge($query, $options);

    // Build and return the modified querystring as url
    return $prepend . http_build_query($query);
}
