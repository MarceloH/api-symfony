<?php

namespace App\Controller;

use App\Helper\EspecialidadeFactory;
use App\Helper\ExtratorDadosRequest;
use App\Repository\EspecialidadeRepository;
use Doctrine\ORM\EntityManagerInterface;

class EspecialidadesController extends BaseController
{
    public function __construct(
        EntityManagerInterface $entityManager,
        EspecialidadeRepository $repository,
        EspecialidadeFactory $factory,
        ExtratorDadosRequest $extratorDadosRequest
    ) {
        parent::__construct($repository, $entityManager, $factory, $extratorDadosRequest);
    }

    public function atualizarEntidadeExistente(int $id, $entidade)
    {
        /**
         * @var Especialista $entidadeExistente
         */
        $entidadeExistente = $this->repository->find($id);
        if (is_null($entidadeExistente)) {
            throw new \invalidArgumentException();
        }

        $entidadeExistente
            ->setDescricao($entidade->getDescricao());

        return $entidadeExistente;
    }
}
