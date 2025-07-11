<?php
namespace App\Controller;

use App\Entity\MainCourante;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/maincourantes', name: 'api_maincourante_')]
class MainCouranteController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em,
        private readonly SerializerInterface $serializer,
        private readonly ValidatorInterface $validator
    ) {}

    #[Route('', name: 'list', methods: ['GET'])]
    public function list(): JsonResponse
    {
        $data = $this->em->getRepository(MainCourante::class)->findAll();
        $json = $this->serializer->serialize($data, 'json', ['groups'=>['read']]);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('', name: 'create', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $object = $this->serializer->deserialize(
            $request->getContent(),
            MainCourante::class,
            'json'
        );
        $errors = $this->validator->validate($object);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }
        $this->em->persist($object);
        $this->em->flush();
        $json = $this->serializer->serialize($object, 'json', ['groups'=>['read']]);
        return new JsonResponse($json, 201, [], true);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(MainCourante $entity): JsonResponse
    {
        $json = $this->serializer->serialize($entity, 'json', ['groups'=>['read']]);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', name: 'update', methods: ['PUT','PATCH'])]
    public function update(Request $request, MainCourante $entity): JsonResponse
    {
        $this->serializer->deserialize(
            $request->getContent(),
            MainCourante::class,
            'json',
            ['object_to_populate'=>$entity]
        );
        $errors = $this->validator->validate($entity);
        if (count($errors) > 0) {
            return $this->json($errors, 400);
        }
        $this->em->flush();
        $json = $this->serializer->serialize($entity, 'json', ['groups'=>['read']]);
        return new JsonResponse($json, 200, [], true);
    }

    #[Route('/{id}', name: 'delete', methods: ['DELETE'])]
    public function delete(MainCourante $entity): JsonResponse
    {
        $this->em->remove($entity);
        $this->em->flush();
        return new JsonResponse(null, 204);
    }
}
