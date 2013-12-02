<?php

namespace MGD\AnnotationExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MGD\AnnotationExampleBundle\Annotations\PersonalAnnotation;

/**
 * @PersonalAnnotation(url="/")
 */
class OtherController extends Controller
{
    /**
     * @Route("/other", name="other")
     */
    public function indexAction()
    {
        // I will never stay here
        return array();
    }
}
