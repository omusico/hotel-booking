<?php
/**
 * Smarty plugin
 * Developer: Rudy Zeinoun
 * Purpose: L'Orient-Le Jour
 */

function smarty_modifier_capfirst($string)
{
    return strtoupper(substr($string,0,1)).substr($string,1);
}


?>
