<?php
/**
 * Created by annotations.
 * User: PC
 * Date: 29/11/13
 * Time: 17:25
 */

namespace MGD\AnnotationExampleBundle\Annotations;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Annotation
 */
class PersonalAnnotationSubscriber
{
    public $url;

    public function redirect(Controller $controller)
    {
        $session = $controller->get('session');
        $session->getFlashBag()->add("redirect_annotation","Redirect annotation was called from PersonalAnnotationSubscriber");

        header("location: $this->url");
        exit;
    }
} 