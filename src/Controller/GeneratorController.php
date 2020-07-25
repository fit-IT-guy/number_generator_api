<?php

namespace App\Controller;

use App\Entity\Generator;
use mysql_xdevapi\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GeneratorController extends AbstractController
{
    /**
     * @Route("/generate", name="api_generate")
     */
    public function generate(): JsonResponse
    {
        $gn = new Generator();

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($gn);
        $entityManager->flush();

        return new JsonResponse([
            'id'        => $gn->getId(),
            'number'    => $gn->getNumber(),
        ]);
    }

    /**
     * @Route("/generate/{id}", name="api_get_generated")
     */
    public function retrieve(int $id): JsonResponse
    {
        $gn = $this->getDoctrine()->getManager()->find(Generator::class, $id);

        if ($gn === null)
        {
//            throw new \OutOfBoundsException('Записи в таблице не существует');
            return new JsonResponse([
                'id'        => null,
                'number'    => null,
            ]);
        }

        return new JsonResponse([
            'id'        => $gn->getId(),
            'number'    => $gn->getNumber(),
        ]);
    }
}
