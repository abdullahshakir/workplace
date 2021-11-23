<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
  * @IsGranted("ROLE_USER")
  */
class DashboardController extends AbstractController
{
    /**
     * @Route("/dashboard", name="user_dashboard")
     */
    public function index(Request $request)
    {
        return $this->render('dashboard/index.html.twig');
    }
}
