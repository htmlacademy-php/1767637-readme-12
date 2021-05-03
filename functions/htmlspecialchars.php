<?php
function html($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}
