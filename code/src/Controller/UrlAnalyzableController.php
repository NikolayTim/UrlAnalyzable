<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\UrlAnalyzableFormType;
use App\Service\UrlAnalyzableInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UrlAnalyzableController extends AbstractController
{
    public function __construct(
        private FormFactoryInterface $formFactory,
        private UrlAnalyzableInterface $urlAnalyzable
    ) {}

    /**
     * @Route("/url-analyzable", methods={"GET"})
     */
    public function getUrlAnalyzableFormAction(): Response
    {
        $form = $this->formFactory->createBuilder(UrlAnalyzableFormType::class)->getForm();
        return $this->render('url_analyzable_form.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/url-analyzable", methods={"POST"})
     */
    public function urlAnalyzableAction(Request $request): Response
    {
        $form = $this->formFactory->createBuilder(UrlAnalyzableFormType::class)->getForm();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $urlDto = $form->getData();
            $imagesDto = $this->urlAnalyzable->process($urlDto);
            return $this->render('url_analyzable.twig', ['images' => $imagesDto->images]);
        }

        return $this->render('url_analyzable_form.twig', ['form' => $form->createView()]);
    }
}