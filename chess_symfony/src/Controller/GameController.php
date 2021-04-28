<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Game;
use App\Utils\Utilities;

class GameController extends AbstractController
{
    
    /**
     * @Route("/index", name="ind")
     */
    public function index(){
        return $this->render('game/home.html.twig');
    }
    /**
     * @Route("/create", name="create")
     */
    public function create(){
        $em = $this ->getDoctrine()->getManager();
        $game = new Game();
        $game->setId(Utilities::generateId($game,'id', $this->getDoctrine()));
        $game->setInd(0);
        $em->persist($game);
        $em->flush();
        return $this->redirectToRoute('game', ['id' => $game->getId()]);
    }
    /**
     * @Route("/game/{id}", name="game")
     */
    public function game($id){
        return $this->render('game/game.html.twig');
    }
}
