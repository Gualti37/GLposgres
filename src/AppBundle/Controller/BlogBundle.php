<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use AppBundle\Entity\Product;
use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;

class BlogBundle extends Controller
{
    
    
    
     
    
    /**
    * @Route("/Create", name="post")
    */
    public function createAction()
    {
  
    $post=new Post();
    $post ->setTitle('New article');
    $post ->setUrl('htpp://er');
    $post ->setContent('Description');
    $post ->setPublished(new \Datetime('now'));
    $post ->setUser($this->getUser()->getId());
    $post ->setUsername($this->getUser());
    
    $em=$this->getDoctrine()->getManager();
    $em->persist($post);
    
    
    return new Response('Crée : '.$post->getId().$post->getId());
    }
    
    
    
    /**
    * @Route("/Recherche1/{id}", name="postsearch")
    */
    public function postAction($id){
        $post = $this->getDoctrine()
                ->getRepository('AppBundle:Post')
                ->find($id);
        
        if(!$post){
            throw $this->createNotFoundException(
                    'Aucun post trouvé pour cet id :'.$id
                    );
        }
    //return new Response($product->getName());
        
    return $this->render('default/post.html.twig', array('post'=>$post));
    }
    
      
    /**
    * @Route("/RechercheAll", name="postall")
    */
    public function allAction(){
        $posts = $this->getDoctrine()
                ->getRepository('AppBundle:Post')
                ->findAll();
        
        if(!$posts){
            throw $this->createNotFoundException(
                    'Aucun produit trouvé pour cet id :'.$id
                    );
        }  
        $output2="";
        foreach($posts as $post)
        {
        $output = $post->getTitle();
        $output2 = $output2.$output;
        }
    
    //return new Response($output2);
    
    return $this->render('default/index2.html.twig', array('posts'=>$posts));
    }
    
    
    /**
    * @Route("/", name="post10")
    */
    public function indexAction(){
        
    $em=$this->getDoctrine()->getManager();
    
    $query=$em->createQuery(
    'SELECT p
    FROM AppBundle:Post p
    ORDER BY p.published DESC'
    )->setMaxResults(5);

    $posts = $query->getResult();
    
    return $this->render('default/index2.html.twig', array('posts'=>$posts));

    }
 
 
        
    
}
