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
        return $this->redirectToRoute('game', ['user' => 1, 'id' => $game->getId()]);
    }
    /**
     * @Route("/game/{user}/{id}", name="game")
     */
    public function game($user, $id, Request $req){
        $form = $this->createFormBuilder()
            ->add('move')
            ->add('play', SubmitType::class)
            ->getForm();

        $form->handleRequest($req);
        $board= array();
        $ch = array('a','b','c','d','e','f','g','h');
        $pieces = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id]);
        $pi= NULL;
        for($i=7; $i>=0; $i--){
            $y = 0; $a = array();
            $pi = NULL;
            for($j=7; $j>=0; $j--){
                $pi = NULL;
                foreach($pieces as $r){
                    $coo = $ch[$y].($i+1);
                    if($r->getCoord() == $coo){
                        if($r->getQuit() != 1){
                            $pi = $r;
                        }
                    }
                }
                if($pi != NULL){
                    array_push($a, $pi);
                }else{
                    $pi = NULL;
                    array_push($a, $pi);
                }
                $y++;
            }
            array_push($board, $a);
        }
        $dead = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'quit' => 1]);
        //dd($board);
        if($form->isSubmitted() && $form->isValid()){
            return $this->redirectToRoute('play',['user' => $user,'id' => $id, 'move' => $form->getData()['move']]);
        }
        return $this->render('game/game.html.twig', ['dead' => $dead, 'id'=>$id, 'chars' => ["a","b","c","d","e", "f" ,"g","h"], 'user' => $user, 'form_move' => $form->createView(), 'board'=>$board]);
    }
    /**
     * @Route("/play/{user}/{id}/{move}", name="play")
     */
    public function play($user, $id, $move){
        //we do checks later!
        //exp: wHb1c3
        $em = $this ->getDoctrine()->getManager();
        if($move[2] != 'L' && $move[2] != 'S'){
            $piece = $move[0];
            $from = $move[1].$move[2];
            $to = $move[3].$move[4];
            $piece = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'coord' => $from, 'piece' => $piece]);
            $piece1 = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'coord' => $to]);
            if($piece1 != NULL){
                $piece1[0]->setQuit(1);
                $em->persist($piece1[0]);
                $em->flush();
            }
            if(($piece[0]->getPiece() == 'p') && (($to[1] == '8') || ($to[1] == '1'))){
                $piece[0]->setPiece('Q');
            }
            $piece[0]->setCoord($to);
            $em->persist($piece[0]);
            $em->flush();
        }else{
            if($move[2] == 'S'){
                //castling short
                if($move[0] == 'w'){
                    $k = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'K', 'color' => 1]);
                    $r = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'R', 'coord' => 'h1']);
                    $k[0]->setCoord('g1');
                    $r[0]->setCoord('f1');
                    $em->persist($k[0]);
                    $em->flush();
                    $em->persist($r[0]);
                    $em->flush();
                }else{
                    $k = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'K', 'color' => 0]);
                    $r = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'R', 'coord' => 'h8']);
                    $k[0]->setCoord('g8');
                    $r[0]->setCoord('f8');
                    $em->persist($k[0]);
                    $em->flush();
                    $em->persist($r[0]);
                    $em->flush();
                }
            }else{
                //castling long
                if($move[0] == 'w'){
                    $k = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'K', 'color' => 1]);
                    $r = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'R', 'coord' => 'a1']);
                    $k[0]->setCoord('c1');
                    $r[0]->setCoord('d1');
                    $em->persist($k[0]);
                    $em->flush();
                    $em->persist($r[0]);
                    $em->flush();
                }else{
                    $k = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'K', 'color' => 0]);
                    $r = $this->getDoctrine()->getRepository(Pieces::class)->findBy(['game' => $id, 'piece' => 'R', 'coord' => 'a8']);
                    $k[0]->setCoord('c8');
                    $r[0]->setCoord('d8');
                    $em->persist($k[0]);
                    $em->flush();
                    $em->persist($r[0]);
                    $em->flush();
                }
            }
        }
        return $this->redirectToRoute('game',['user'=>$user , 'id' => $id]);
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

                return $this->redirectToRoute('game', ['user'=> 2,'id' => $game->getId()]);
            }
        }
        return $this->render('game/join.html.twig', ['gamejoin'=> $form->createView()]);
    }
}
