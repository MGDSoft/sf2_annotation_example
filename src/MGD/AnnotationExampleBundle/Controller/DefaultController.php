<?php

namespace MGD\AnnotationExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MGD\AnnotationExampleBundle\Annotations\PersonalAnnotation;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/loader_annotation", name="loader_annotation")
     * @PersonalAnnotation(url="/")
     */
    public function redirectByAnnotationAction()
    {
        return array();
    }

}
