<?php

function getListEnum($table)
{
    $db = db_connect();
    $sql = 'SHOW COLUMNS FROM ' . $table . ' WHERE type LIKE "enum%"';
    $query = $db->query($sql);
    $list = false;

    if ($query->getNumRows() > 0) {
        foreach ($query->getResult() as $item) {
            // Clean Up the Typ List
            // preg_match is a mighty function
            // to mighty for the little function
            // so, just str_replace is enough
            $tmp_array_list = explode(',',    str_replace(array('enum(', ')', "'"), '', $item->Type));
            // prepare every single enum field as list                            
            foreach ($tmp_array_list as $v => $entry) {
                $lists[$v] = $entry;
            }
        }

        // write the serialize lists on the table file
        // write_file($file, serialize($lists));

        // Asked several list = return as array
        if ($list) {
            return (array_key_exists($list, $lists)) ? $lists[$list] : $lists;
        } else {
            return $lists;
        }
    }
}
