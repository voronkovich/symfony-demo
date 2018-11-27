<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Controller used to return flash messages.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class FlashController extends AbstractController
{
    /**
     * @Route("/flashes", methods="GET", name="flashes")
     */
    public function flashes(Request $request, TranslatorInterface $translator): JsonResponse
    {
        $flashes = [];

        if ($request->hasPreviousSession()) {
            foreach ($request->getSession()->getFlashBag()->all() as $type => $messages) {
                $flashes[$type] = array_map([$translator, 'trans'], $messages);
            }
        }

        return $this->json($flashes);
    }
}
