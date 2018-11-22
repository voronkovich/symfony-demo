<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Controller;

use App\Form\UserRegistrationType;
use App\Message\AddUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller used to register users.
 *
 * @author Oleg Voronkovich <oleg-voronkovich@yandex.ru>
 */
class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", methods={"GET", "POST"}, name="registration_register")
     */
    public function register(Request $request, MessageBusInterface $messageBus): Response
    {
        $message = new AddUser();
        $message->setRoles(['ROLE_USER']);

        $form = $this->createForm(UserRegistrationType::class, $message);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $messageBus->dispatch($message);

            $this->addFlash('success', sprintf(
                'user.registered_successfully',
                $message->getUsername(),
                $message->getPlainPassword()
            ));
        }

        return $this->render('registration/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
