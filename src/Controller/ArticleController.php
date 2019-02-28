<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class ArticleController extends Controller
{
    /**
     * @Route("/", name="")
     * @Template()
     */
    public function indexAction()
    {
        return new Response('Da');
    }

    /**
     * @Route("/test", name="")
     * @Template()
     */
    public function show()
    {
        return new Response('test');
    }
}
