<?php
namespace Alsar\Symfony;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\Form\FormFactoryInterface;

class ControllerUtils
{
    const ID_ROUTER           = 'router';
    const ID_SECURITY_CONTEXT = 'security.context';
    const ID_FORM_FACTORY     = 'form.factory';
    const ID_TEMPLATE_ENGINE  = 'templating';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @return RouterInterface
     */
    public function getRouter()
    {
        return $this->getService(self::ID_ROUTER);
    }

    /**
     * @return RouterInterface
     */
    public function getSecurityContext()
    {
        return $this->getService(self::ID_SECURITY_CONTEXT);
    }

    /**
     * @return EngineInterface
     */
    public function getTemplateEngine()
    {
        return $this->getService(self::ID_TEMPLATE_ENGINE);
    }

    /**
     * @return FormFactoryInterface
     */
    public function getFormFactory()
    {
        return $this->getService(self::ID_FORM_FACTORY);
    }

    /**
     * @param string $id
     *
     * @return boolean
     */
    private function getService($id)
    {
        return $this->container->get('$id');
    }
}