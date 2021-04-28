<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Game;
use App\Entity\Player;
use App\Entity\Pieces;
use App\Utils\Utilities;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


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
        //create game
        $em = $this ->getDoctrine()->getManager();
        $game = new Game();
        $game->setId(Utilities::generateId(Game::class,'id', $this->getDoctrine()));
        $game->setInd(0);
        $em->persist($game);
        $em->flush();
        //create frist player
        $player = new Player();
        $player->setId(Utilities::generateId(Player::class,'id', $this->getDoctrine()));
        $player->setGame($game);
        $player->setColor(Player::$WHITE); 
        $em->persist($player);
        $em->flush();
        //create pieces
        $arr = Utilities::initPieces($game, $this->getDoctrine());
        foreach($arr as $p){
            $em->persist($p);
            $em->flush();
        }
        return $this->redirectToRoute('game', ['id' => $game->getId()]);
    }
    /**
     * @Route("/game/{id}", name="game")
     */
    public function game($id, Request $req){
        $form = $this->createFormBuilder()
            ->add('move')
            ->add('Play', SubmitType::class)
            ->getForm();

        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('play',['id' => $id, 'move' => $form->getData()['move']]);
        }
        return $this->render('game/game.html.twig', ['form_move' => $form->createView()]);
    }
    /**
     * @Route("/play/{id}/{move}", name="play")
     */
    public function play($id, $move){
        //we do checks later!

    }
    /**
     * @Route("/join", name="join")
     */
    public function join(Request $request){
        $form = $this->createFormBuilder()
            ->add('id')
            ->add('join', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $game = $this->getDoctrine()->getRepository(Game::class)->find($data['id']);
            if($game == NULL){
                return new Response('no game found! press back');
            }else{
                //create second player
                $em = $this ->getDoctrine()->getManager();
                $player = new Player();
                $player->setId(Utilities::generateId(Player::class,'id', $this->getDoctrine()));
                $player->setGame($game);
                $player->setColor(Player::$BLACK); 
                $em->persist($player);
                $em->flush();

                return $this->redirectToRoute('game', ['id' => $game->getId()]);
            }
        }
        return $this->render('game/join.html.twig', ['gamejoin'=> $form->createView()]);
    }
}