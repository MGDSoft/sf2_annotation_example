<?php

namespace MGD\AnnotationExampleBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use MGD\AnnotationExampleBundle\Annotations\PersonalAnnotationSubscriber;

/**
 * @PersonalAnnotationSubscriber(url="/")
 */
class OtherSubscriberController extends Controller
{
    /**
     * @Route("/other_subscriber", name="other_subscriber")
     */
    public function indexAction()
    {
        // I will never stay here
        return array();
    }
}
