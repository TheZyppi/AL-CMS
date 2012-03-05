    <?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) 2011-2012 Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is a free software, you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */

     
     
    function generatePW($laenge=8)
    {
    $zeichen = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'), array('#','&','@','$','_','%','?','+'));
     
     
    mt_srand((double)microtime()*1000000);
    for ($i = 1; $i <= (count($zeichen)*2); $i++)
    {
    $swap = mt_rand(0,count($zeichen)-1);
    $tmp = $zeichen[$swap];
    $zeichen[$swap] = $zeichen[0];
    $zeichen[0] = $tmp;
    }
    return substr(implode('',$zeichen),0,$laenge);
     
    }
     
    ?> 