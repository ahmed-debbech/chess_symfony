<?php

namespace App\Utils;

use \DateTime;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Pieces;
class Utilities {
    public static function generateId($table,$atr, $doctrine){

        $article = NULL;
        $rand = 0;
        do{
        $rand = rand(1000, 9999);
        $article = $doctrine->getManager()
             ->getRepository($table)
             ->findOneBy(array($atr => $rand));
        }while($article != NULL);
        return $rand;
    }
    public static function initPieces($game, $doc){
        $arr = array();
        //WHIITEEE
        array_push($arr, new Pieces($game, Player::$WHITE, 'R', 'a1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'H', 'b1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'B', 'c1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'Q', 'd1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'K', 'e1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'B', 'f1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'H', 'g1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'R', 'h1', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'a2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'b2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'c2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'd2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'e2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'f2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'g2', $doc));
        array_push($arr, new Pieces($game, Player::$WHITE, 'p', 'h2', $doc));
        //BLAAACKK
        array_push($arr, new Pieces($game, Player::$BLACK, 'R', 'a8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'H', 'b8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'B', 'c8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'Q', 'd8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'K', 'e8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'B', 'f8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'H', 'g8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'R', 'h8', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'a7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'b7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'c7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'd7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'e7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'f7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'g7', $doc));
        array_push($arr, new Pieces($game, Player::$BLACK, 'p', 'h7', $doc));
        return $arr;
    }
}
?>