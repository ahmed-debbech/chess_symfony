<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Game;
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
                dd($game);
            }
        }
        return $this->render('game/join.html.twig', ['gamejoin'=> $form->createView()]);
    }
}
