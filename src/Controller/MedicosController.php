<?php

namespace App\Controller;

use App\Entity\Medico;
use App\Helper\ExtratorDadosRequest;
use App\Helper\MedicoFactory;
use App\Repository\MedicosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MedicosController extends BaseController
{
    public function __construct(
        EntityManagerInterface $entityManager,
        MedicoFactory $medicoFactory,
        MedicosRepository $repository,
        ExtratorDadosRequest $extratorDadosRequest
    ) {
        parent::__construct($repository, $entityManager, $medicoFactory, $extratorDadosRequest);
    }
    
    /**
     * @Route("/especialidades/{especialidadeId}/medicos", methods={"GET"})
     */
    public function buscaPorEspecialidade(int $especialidadeId): Response
    {
        $medico = $this->repository->findBy([
            'especialidade' => $especialidadeId
        ]);

        return new JsonResponse($medico);
    }

    /**
     * @var Medico $entidadeExistente
     */
    public function atualizarEntidadeExistente(int $int, $entidade)
    {
        $entidadeExistente = $this->repository->find($int);
        if (is_null($entidadeExistente)) {
            throw new \invalidArgumentException();
        }
        
        $entidadeExistente
            ->setCrm($entidade->getCrm())
            ->setNome($entidade->getNome())
            ->setEspecialidade($entidade->getEspecialidade());
    }
}
