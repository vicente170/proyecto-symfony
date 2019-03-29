<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\User;
use App\Form\RegisterType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends AbstractController
{

    public function register(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //Crear el formulario
        $user=new User();
        $form=$this->createForm(RegisterType::class, $user);

        //unir lo que manda la request con el objeto user asociado al form
        //Rellenar el objeto con los datos del form
        $form->handleRequest($request);

        //Comprobar si se ha enviado el form
        if($form->isSubmitted() && $form->isValid())
        {
            //Modificando objeto para guardarlo
            $user->setRole('ROLE_USER');
            $user->setCreatedAt(new \DateTime('now'));

            //Cifrando la contraseña
            $encoded=$encoder->encodePassword($user, $user->getPassword());
            $user->setPassword($encoded);

            $em=$this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('fichas');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView()
        ]);
    }


    public function login(AuthenticationUtils $autenticationUtils){

        $error=$autenticationUtils->getLastAuthenticationError();

        $lastUsername=$autenticationUtils->getLastUsername();

        return $this->render('user/login.html.twig', array(
            'error'=>$error,
            'last_username'=>$lastUsername
        ));
    }

    public function perfil(){

        return $this->render('user/perfil.html.twig', array(
            'hola'=>"hola"
        ));

    }
}
