<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Form\PostType;

class PostController extends AbstractController
{
    /**
     * @Route("/dashboard", name="user_dashboard")
     */
    public function index(Request $request): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encode the new users password
            // $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

            // // Set their role
            // $user->setRoles(['ROLE_USER']);

            // // Save
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($user);
            // $em->flush();

            // return $this->redirectToRoute('app_login');
        }

        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
