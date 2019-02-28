<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function homepage()
    {
        // return new Response('Da');
        return $this->render('article/homepage.html.twig',
                [
                    'title' => 'Tile yeaaaah',
                ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @Template()
     */
    public function show($slug)
    {
        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render('article/show.html.twig', [
            'comments' => $comments,
            'slug' => $slug,
            'title' => ucwords(str_replace('-', ' ', $slug)),
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"} )
     */
    public function toggleArticleHeart($slug)
    {
        // TODO - actually heart/unheart the article!

        return new JsonResponse(['hearts' => rand(5, 100)]);
    }


}
