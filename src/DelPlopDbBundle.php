<?php

namespace DelPlop\DbBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class DelPlopDbBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
