<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostFormType;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PostRepository $repo): Response
    {
        //1- je récupère tous les posts
        $posts = $repo->findAll();
        // dd($posts);
        //2- j'envoie la data à la vue
        return $this->render('blog/index.html.twig', compact('posts'));
        

    }
    #[Route('/post/{id}', name: 'app_show')]
    public function show($id, PostRepository $repo): Response 
    {
        // je récupère le poste
        $post = $repo->find($id);
        //je passe à la vue
        return $this->render('blog/show.html.twig', compact('post'));
    }

    #[Route('/post/delete/{id}', name: 'app_delete', methods: ['GET', 'DELETE'])]
    public function delete($id, PostRepository $repo, EntityManagerInterface $em): Response 
    {
        // je récupère le poste
        $post = $repo->find($id);
        // supprimer post
        $em->remove($post);
        // je vide la chasse
        $em->flush();
        // redirection vers la page d'acceuil
        return $this->redirectToRoute('app_home');
    }

    #[Route('/create', name: 'app_create',)]
    public function create( PostRepository $repo): Response 
    {
        
        // créer un nouvel objet

        $post = new Post;

        // create form
        $form = $this->createForm(PostFormType::class, $post);
        $showForm = $form->createView();

        // envoie form dans la vue
        return $this->render('blog/create.html.twig', compact('showForm'));
    }

}
