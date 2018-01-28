<?php















class curseFilter{
    function curseFilter($string){
        $badword = array('fuck', 'fucker', 'fucked');
        $replace = array('f***', 'f*****', 'f*****');
        $clean = str_ireplace($badword, $replace, $string);
        return $clean;
    }
}






































?>