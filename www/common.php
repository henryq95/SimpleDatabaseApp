<?php
/*common.php stores functions for later use*/

/**
 * Escapes HTML for output
 *In order to output special characters
 */

function escape($html)
{
    /*Convert special characters to HTML entities, ie & to &amp;*/
    /*ENT_QUOTES will convert both double and single quotes*/
    /*ENT_SUBSTITUTE replaces invalid code unit sequences with a Unicode Replacement Character 
    instead of returning an empty string*/
	return htmlspecialchars($html, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8");
}
?>