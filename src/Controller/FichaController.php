<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ficha;
use App\Entity\User;

class FichaController extends AbstractController
{

    public function index()
    {
        //Entidades y relaciones
        $em=$this->getDoctrine()->getManager();

        /*$ficha_repo=$this->getDoctrine()->getRepository(Ficha::class);

        $fichas=$ficha_repo->findAll();

        foreach ($fichas as $ficha){
            echo $ficha->getTitle()."- Perteneciente a: ".$ficha->getUser()->getName()."<br/>";
        }*/

        $user_repo=$this->getDoctrine()->getRepository(User::class);
        $users = $user_repo->findAll();

        foreach ($users as $user){
            echo "<h1>{$user->getName()} {$user->getSurname()}</h1>";

            foreach ($user->getFichas() as $ficha){
                echo $ficha->getTitle()."<br/>";
            }
        }

        //var_dump($users);

        return $this->render('ficha/index.html.twig', [
            'controller_name' => 'FichaController',
        ]);
    }
}
