<?php 
function js_link($src)
{
    if(file_exists("include/" . $src))
    {
        //we know it will exists within the HTTP Context
        return sprintf("<script type=\"text/javascript\" src=\"%s\"></script>",$src);
    }
    return "<!-- Unable to load " . $src . "-->";
}
?>