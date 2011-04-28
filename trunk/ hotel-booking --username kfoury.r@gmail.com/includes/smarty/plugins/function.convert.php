<?php
function smarty_function_convert($params, &$smarty)
{
    return iconv('Windows-1252','UTF-8',$params['value']);
}

?>
