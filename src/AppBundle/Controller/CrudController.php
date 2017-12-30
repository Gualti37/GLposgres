<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Post;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class CrudController extends Controller
{

    /**
     * @Route("/addPost", name="newAction")
     */
    public function newAction(Request $request){
        
        
        $post = new Post();

        $form = $this->createFormBuilder($post)
            ->add('title', TextType::class, array('required'=>true))
            ->add('content', TextareaType::class)
            ->add('save', SubmitType::class, array('label' => 'Add Post'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $post = $form->getData();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();
            $post->setUrl('url-'.$post->getTitle());
            $post->setPublished(new \Datetime('now'));
            $post ->setUserid($this->getUser()->getId());
            $post ->setUsername($this->getUser());
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
    
            return $this->redirectToRoute('post10');
        }
        
          
        
        

        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
          ));
    }
    
    
    /**
     * @Route("/update/{id}", name="postupdate")
    */
    public function updateAction(Request $request, $id)
    {  
    
        
    $em = $this->getDoctrine()->getManager();
    $post1 = $em->getRepository('AppBundle:Post')->find($id);

    if (!$post1) {
        throw $this->createNotFoundException(
            'No post found for id '.$id
        );
    }
    
    
    if (!$post1->isAuthor($this->getUser())) {
        //$this->denyAccessUnlessGranted('update', $post1);
        
      
        //$this->addFlash('success', 'something went <a href="/" class="alert-link">well!</a>');
        //$this->addFlash('info', 'some <a href="/" class="alert-link">important info</a>.');
        //$this->addFlash('warning', 'uh oh, that didn\'t quite <a href="/" class="alert-link">work right</a>');
        
        $this->addFlash('danger', 'Permission denied <a href="/" class="alert-link"> Only the author can edit the post</a>');
 
        return $this->render('default/flash-messages.html.twig');
    }
    
    else{
        

    ///$post->setName('New post name!');
    $title=$post1->getTitle();
    $content=$post1->getContent();
    $em->flush();
    
    
    $post = new Post();

        $form = $this->createFormBuilder($post)
            //->add('myField', 'number', ['empty_data' => 'Default value'])
            ->add('title', TextType::class, array('required'=>true,'data' => $title))
            ->add('content', TextareaType::class, array('required'=>true,'data' => $content))
            ->add('save', SubmitType::class, array('label' => 'Update Post'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $post = $form->getData();
            
            //$em->remove($post1);
            //$em->flush();
    
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $em = $this->getDoctrine()->getManager();
            // $em->persist($task);
            // $em->flush();
            $post1->setTitle($post->getTitle());
            $post1->setContent($post->getContent());
            $post1->setPublished(new \Datetime('now'));
            $em = $this->getDoctrine()->getManager();
            //$em->persist($post);
            $em->flush();
    
            return $this->redirectToRoute('post10');
        }
        

        return $this->render('default/add.html.twig', array(
            'form' => $form->createView(),
          ));
        
        
    }
        
          
    }
/**
 * @Route("/remove/{id}", name="postdelete")
 */
public function removeAction($id)
{
    
    
    
    $em = $this->getDoctrine()->getManager();
    $post = $em->getRepository('AppBundle:Post')->find($id);

    if (!$post) {
        throw $this->createNotFoundException(
            'No post found for id '.$id
        );
    }
       
    if (!$post->isAuthor($this->getUser())) {
       
        $this->addFlash('danger', 'Permission denied <a href="/" class="alert-link"> Only the author can edit the post</a>');
 
        return $this->render('default/flash-messages.html.twig');
    }
    
   

    $em->remove($post);
    $em->flush();

    //return new Response($post->getName());
    
    return $this->redirectToRoute('post10');
}
    


        
    
    
}
