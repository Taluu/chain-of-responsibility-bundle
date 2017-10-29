<?php
namespace ChainOfResponsibilityBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;

use ChainOfResponsibilityBundle\DependencyInjection\Compiler\ChainPass;

class ChainOfResponsibilityBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ChainPass);
    }
}
