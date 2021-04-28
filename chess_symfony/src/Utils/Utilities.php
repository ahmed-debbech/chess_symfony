<?php

namespace App\Utils;

use \DateTime;

class Utilities {
    public static function generateId($table,$atr, $doctrine){

        $article = NULL;
        $rand = 0;
        do{
        $rand = rand(10000000, 99999999);
        $article = $doctrine->getManager()
             ->getRepository(get_class($table))
             ->findOneBy(array($atr => $rand));
        }while($article != NULL);
        return $rand;
    }
}
?>