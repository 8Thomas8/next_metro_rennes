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

        $dataSens0 = [];
        $dataSens1 = [];

        if ($formArret->isSubmitted()) {
            $arretInfoManager = new ArretInfoManager();
            $dataResponse = array($arretInfoManager->getData($search->getNomArret()))[0];
            $records = array_column(array($dataResponse), 'records')[0];

            foreach ($records as $e) {
                $data = array_column(array($e), 'fields')[0];
                $dataArray = (array) $data;

                if ($dataArray["sens"] == 0) {
                    array_push($dataSens0, $dataArray);
                } else if ($dataArray["sens"] == 1) {
                    array_push($dataSens1, $dataArray);
                }
            }
        }

        return new Response($this->twig->render('pages/home.html.twig', [
            'formArret' => $formArret->createView(),
            'dataSens0' => $dataSens0,
            'dataSens1' => $dataSens1
        ]));
    }

}