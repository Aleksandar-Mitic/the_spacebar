<?php

namespace App\Controller;

use App\Entity\Article;
use Psr\Log\LoggerInterface;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleController extends AbstractController
{
    private $isDebug;

    public function __construct($isDebug)
    {
        $this->isDebug = $isDebug;
    }

    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function homepage(ArticleRepository $repository)
    {

        $articles = $repository->findAllPublishedOrderedByNewest();

        return $this->render('article/homepage.html.twig',
                [
                    'articles' => $articles,
                ]);
    }

    /**
     * @Route("/news/{slug}", name="article_show")
     * @Template()
     */
    public function show(Article $article, ArticleRepository $repository, $slug)
    {

        $article = $repository->findOneBy(['slug' => $slug]);

        if (!$article) {
            throw $this->createNotFoundException(sprintf('No article for slug "%s"', $slug));
        }

        $comments = [
            'I ate a normal rock once. It did NOT taste like bacon!',
            'Woohoo! I\'m going on an all-asteroid diet!',
            'I like bacon too! Buy some from my site! bakinsomebacon.com',
        ];

        return $this->render('article/show.html.twig', [
            'article'  => $article,
            'comments' => $comments,
        ]);
    }

    /**
     * @Route("/news/{slug}/heart", name="article_toggle_heart", methods={"POST"} )
     */
    public function toggleArticleHeart(Article $article, EntityManagerInterface $em)
    {
        $article->incrementHeartCount();
        $em->flush();

        return new JsonResponse(['hearts' => $article->getHeartCount()]);
    }


}
