<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    /**
     * @Route("/", name="indexAction")
     * @Template()
     */
    public function indexAction()
    {
        // return new Response('Da');
        return $this->render('base.html.twig',
                [
                    'title' => 'Tile yeaaaah',
                ]);
    }

    /**
     * @Route("/{slug}", name="show")
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
            'title' => $slug,
        ]);
    }
}
