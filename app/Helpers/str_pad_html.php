<?php
    /**
     * str_pad_html - Pad a string to a certain length with another string.
     * accepts HTML code in param: $strPadString.
     * 
     * @name        str_pad_html()
     * @author        Tim Johannessen <root@it.dk>
     * @version        1.0.0
     * @param        string    $strInput    The array to iterate through, all non-numeric values will be skipped.
     * @param        int    $intPadLength    Padding length, must be greater than zero.
     * @param        string    [$strPadString]    String to pad $strInput with (default: &nbsp;)
     * @param        int        [$intPadType]        STR_PAD_LEFT, STR_PAD_RIGHT (default), STR_PAD_BOTH
     * @return        string    Returns the padded string
    **/
    function str_pad_html($strInput = "", $intPadLength, $strPadString = "&nbsp;", $intPadType = STR_PAD_RIGHT) {
        if (strlen(trim(strip_tags($strInput))) < intval($intPadLength)) {
            
            switch ($intPadType) {
                 // STR_PAD_LEFT
                case 0:
                    $offsetLeft = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    $offsetRight = 0;
                    break;
                    
                // STR_PAD_RIGHT
                case 1:
                    $offsetLeft = 0;
                    $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    break;
                    
                // STR_PAD_BOTH
                case 2:
                    $offsetLeft = intval(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2);
                    $offsetRight = round(($intPadLength - strlen(trim(strip_tags($strInput)))) / 2, 0);
                    break;
                    
                // STR_PAD_RIGHT
                default:
                    $offsetLeft = 0;
                    $offsetRight = intval($intPadLength - strlen(trim(strip_tags($strInput))));
                    break;
            }
            
            $strPadded = str_repeat($strPadString, $offsetLeft) . $strInput . str_repeat($strPadString, $offsetRight);
            unset($strInput, $offsetLeft, $offsetRight);
            
            return $strPadded;
        }
        
        else {
            return $strInput;
        }
    }
