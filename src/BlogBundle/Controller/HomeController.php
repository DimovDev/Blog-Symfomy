<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="blog_index",methods={"GET"})

     */
    public function indexAction()
    {

    	$articles=$this
		    ->getDoctrine()
		    ->getRepository(Article::class)
		    ->findBy([], ['viewCount' => 'desc', 'dateAdded'=> 'desc']);
    return $this->render('blog/index.html.twig',['articles'=>$articles]);
    }
}
