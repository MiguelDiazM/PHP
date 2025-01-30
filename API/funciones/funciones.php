<?php
    class funciones{

        public static function comprobarArray($entrada){
            foreach($entrada as $cont){
                if($cont == ""){
                    return false;
                }
            }
            return true;
        }

    }

?>