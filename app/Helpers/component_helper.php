<?php

    function convertBooleanToInteger($_params) {
        $_result = 0;
        
        switch ($_params) {
            case 'on':
            case 'true':
            case '1':
            case 1:
            case true:
                $_result = 1;
                break;
            default:
                $_result = 0;
        }

        return $_result;
    }

?>