<?php

namespace HostAndGuestBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HostAndGuestBundle extends Bundle
{
    public function getParent()
    {
return('FOSUserBundle');
    }

}
