    <?php
/*
 * AL-CMS -- Gernal Information --
 * 
 * Copyright (C) Dennis Falkenberg (http://www.sunrising-network.de) Email: DFalkenberg@gmx.de
 * 
 * AL-CMS is free software, you can you can redistribute it and/or modify
 *it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 *(at your option) any later version.  
 *   
 */
     
     
    function generatePW($length=8)
    {
    $dummy = array_merge(range('0', '9'), range('a', 'z'), range('A', 'Z'), array('#','&','@','$','_','%','?','+'));
     
     
    mt_srand((double)microtime()*1000000);
    for ($i = 1; $i <= (count($dummy)*2); $i++)
    {
    $swap = mt_rand(0,count($dummy)-1);
    $tmp = $dummy[$swap];
    $dummy[$swap] = $dummy[0];
    $dummy[0] = $tmp;
    }
    return substr(implode('',$dummy),0,$length);
     
    }
     
    ?> 