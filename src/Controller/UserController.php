<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{
    /**
     * @Route("/chars", name="user")
     */
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'users' => $this->getDoctrine()->getManager()->getRepository(User::class)->findAll()
        ]);
    }

    /**
     * @Route("/chars/{id}", name="user_set")
     */
    public function set(int $id): Response
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);

        if(!$user)
            throw $this->createNotFoundException();

//        $this->session->clear();
        $this->session->set('user:id', $user->getId());
        $this->session->set('user:name', $user->getUsername());

        return $this->redirectToRoute('user');
    }
}
