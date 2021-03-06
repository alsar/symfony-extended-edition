<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\SecurityExtraBundle\JMSSecurityExtraBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            //new FOS\UserBundle\FOSUserBundle(),
            //new FOS\RestBundle\FOSRestBundle(),
            //new JMS\SerializerBundle\JMSSerializerBundle(),
            //new Nelmio\ApiDocBundle\NelmioApiDocBundle(),

            new AppBundle\AppBundle(),
        );

        if (in_array($this->getEnvironment(), ['dev', 'test'])) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
        $loader->load(__DIR__.'/config/application/application.yml');
        $loader->load(__DIR__.'/config/application/doctrine.yml');
        $loader->load(__DIR__.'/config/application/jms.yml');
        $loader->load(__DIR__.'/config/application/fos.yml');
        $loader->load(__DIR__.'/config/parameters.yml');
    }

    /**
     * Gets the var directory.
     *
     * @return string The var directory
     */
    public function getVarDir()
    {
        return $this->rootDir.'/../var';
    }

    /**
     * {@inheritdoc}
     */
    protected function getKernelParameters()
    {
        $extraParameters = ['kernel.var_dir' => $this->getVarDir()];

        return array_merge($extraParameters, parent::getKernelParameters());
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        if (in_array($this->environment, array('dev', 'test'))) {
            return '/dev/shm/sf/cache/' .  $this->environment;
        }

        return parent::getCacheDir();
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if (in_array($this->environment, array('dev', 'test'))) {
            return '/dev/shm/sf/logs';
        }

        return parent::getLogDir();
    }
}
