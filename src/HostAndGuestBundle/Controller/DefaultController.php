<?php

namespace HostAndGuestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@HostAndGuest/experience/helli.html.twig');
    }
}
