<?php

namespace Endroid\Bundle\QrCodeBundle\Twig\Extension;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Symfony\Bundle\FrameworkBundle\Routing\Router;

class QrCodeExtension extends Twig_Extension implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            'qrcode_url' => new \Twig_Function_Method($this, 'qrcodeUrlFunction')
        );
    }

    public function qrcodeUrlFunction($text, $extension = 'png')
    {
        /** @var $router Router */
        $router = $this->container->get('router');
        $url = $router->generate('endroid_qrcode', array(
            'text' => urlencode($text),
            'extension' => $extension
        ));

        return $url;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'endroid_qrcode';
    }
}