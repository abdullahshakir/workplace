<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Post;
use App\Entity\PostFile;
use App\Form\PostType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PostController extends AbstractController
{
    /**
     * @Route("/dashboard", name="user_dashboard")
     */
    public function index(Request $request): Response
    {
        $post = new Post();

        $form = $this->createForm(PostType::class, $post)
                ->add('attachedFiles', FileType::class, [
                    'multiple' => true,
                    'mapped' => false,
                    'data_class' => null,
                ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $attachedFiles = $form->get('attachedFiles')->getData();

            $post->setPublishedAt(new \DateTime());
            $post->setUser($this->getUser());

            foreach($attachedFiles as $file) {
                $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $newFilename = md5(uniqid()).'.'.$file->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $file->move(
                        $this->getParameter('post_attachments_directory'),
                        $newFilename
                    );
                    $postFile = new PostFile();
                    
                    $postFile->setName($originalFilename);
                    $postFile->setPath($newFilename);
                    $post->addPostFile($postFile);
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                
                unset($file);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('user_dashboard');
        }

        return $this->render('post/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
