<?php

namespace App\Controller;

use App\Entity\Arret;
use App\Forms\ArretForm;
use App\Manager\ArretInfoManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class HomeController extends AbstractController
{
    /**
     * @var Environment
     */
    private Environment $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="Home")
     * @param Request $request
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request): Response
    {

        $search = new Arret();
        $formArret = $this->createForm(ArretForm::class, $search);
        $formArret->handleRequest($request);
        $arret = new Arret();

        if ($formArret->isSubmitted()) {
            $arret = (Array) $formArret->getData();
        }

        return new Response($this->twig->render('pages/home.html.twig', [
            'arret' => $arret,
            'formArret' => $formArret->createView()]));
    }

}