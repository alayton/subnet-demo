<?php

namespace App\Controller;

use App\Repository\SubnetRepository;
use JMS\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class SubnetController extends AbstractController
{
    private SerializerInterface $serializer;
    private SubnetRepository $subnetRepository;

    public function __construct(SerializerInterface $serializer, SubnetRepository $subnetRepository)
    {
        $this->serializer = $serializer;
        $this->subnetRepository = $subnetRepository;
    }

    /**
     * @Route("/subnets", name="get_subnets", methods={"GET"})
     */
    public function getSubnets()
    {
        $subnets = $this->subnetRepository->findAll();
        $json = $this->serializer->serialize($subnets, 'json');
        return new JsonResponse($json, 200, [], true);
    }
}
