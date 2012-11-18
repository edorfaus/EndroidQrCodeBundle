<?php

namespace Endroid\Bundle\QrCodeBundle\Twig\Extension;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class QrCodeExtension extends Twig_Extension implements ContainerAwareInterface
{
    /**
     * {@inheritdoc}
     */
    protected $container;

    /**
     * {@inheritdoc}
     */
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

    /**
     * Creates the QR code URL corresponding to the given message and extension.
     *
     * @param $text
     * @param string $extension
     * @return mixed
     */
    public function qrcodeUrlFunction($text, $extension = 'png')
    {
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