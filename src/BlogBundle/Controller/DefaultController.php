<?php

namespace BlogBundle\Controller;

use BlogBundle\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="blog_index",methods={"GET"})

     */
    public function indexAction()
    {
    	$articles=$this
		    ->getDoctrine()
		    ->getRepository(Article::class
		    )->findAll();
    return $this->render('blog/index.html.twig',['articles'=>$articles]);
    }
}
