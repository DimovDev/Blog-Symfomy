<?php

namespace BlogRestApiBundle\Controller;

use BlogBundle\Entity\Article;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Response;

class ArticleControllerController extends Controller
{
	/**
	 * @Route("/articles", name="rest_api_articles",methods={"GET"})
	 */

	public function articlesActions()
	{
		$articles=$this->getDoctrine()->getRepository(Article::class)->findAll();
		$serializer=$this->container->get('jms_serializer');
		$json=$serializer->serialize($articles,'json');

		return new Response($json,Response::HTTP_OK,array('content-type'=>'application/json'));
	}

	/**
	 * @Route("/articles/{id}", name="rest_api_article",methods={"GET"})

	 * @param $id article id
	 * @return Response
	 */
	public function articleAction($id)
	{
		$article = $this->getDoctrine()->getRepository(Article::class)->find($id);
		if (null===$article){
			return new Response(json_encode(array('error' =>'resourse not found')),
			Response::HTTP_NOT_FOUND,array('content-type'=>'application/json')
		);
		}
		$serializer=$this->container->get('jms_serializer');
		$articleJson=$serializer->serialize($article,'json');

		return new Response($articleJson,Response::HTTP_OK,array('content-type'=>'application/json'));
	}
}
