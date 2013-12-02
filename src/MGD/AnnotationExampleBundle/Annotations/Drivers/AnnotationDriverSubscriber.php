<?php
/**
 * Creating annotation logic and it will be called from subscriber, configured in services.yml
 *
 * You can create a interface to use only one annotation driver for all custom annotations.
 */

namespace MGD\AnnotationExampleBundle\Annotations\Drivers;


use Doctrine\Common\Annotations\Reader;//This thing read annotations
use MGD\AnnotationExampleBundle\Annotations\PersonalAnnotation;
use MGD\AnnotationExampleBundle\Annotations\PersonalAnnotationSubscriber;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;//Use essential kernel component
use MGD\AnnotationExampleBundle\Annotations\Redirect;//Use our annotation
use Symfony\Component\HttpFoundation\Response;// For example I will throw 403, if access denied

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class AnnotationDriverSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => 'onKernelController',
        );
    }

    /**
     * @var \Doctrine\Common\Annotations\Reader
     */
    private $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;//get annotations reader
    }
    /**
     * This event will fire during any controller call
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController()) || !$controller[0] instanceof Controller)  //return if no controller
        {
            return;
        }

        $controllerObj = $controller[0];

        $object = new \ReflectionObject($controllerObj);// get controller
        $method = $object->getMethod($controller[1]);// get method

        $this->searchMethodPersonalAnnotation($controllerObj, $method);
        $this->searchClassPersonalAnnotation($controllerObj, $object);

    }

    private function searchMethodPersonalAnnotation(Controller $controller, $method)
    {
        foreach ($this->reader->getMethodAnnotations($method) as $configuration) //Start of annotations reading
        {
            if ($configuration instanceof PersonalAnnotationSubscriber)
            {
                if(isset($configuration->url))
                {
                    $this->redirect($controller,$configuration->url);
                }
            }
        }
    }

    private function searchClassPersonalAnnotation(Controller $controller, $class)
    {
        foreach ($this->reader->getClassAnnotations($class) as $configuration) //Start of annotations reading
        {
            if ($configuration instanceof PersonalAnnotationSubscriber)
            {
                if(isset($configuration->url))
                {
                    $configuration->redirect($controller);
                }
            }
        }
    }

}