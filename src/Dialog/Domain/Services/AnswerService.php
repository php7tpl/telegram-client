<?php

namespace App\Dialog\Domain\Services;

use App\Dialog\Domain\Entities\AnswerEntity;
use App\Dialog\Domain\Interfaces\Services\AnswerServiceInterface;
use App\Dialog\Domain\Interfaces\Repositories\AnswerRepositoryInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Core\Domain\Libs\Query;

class AnswerService extends BaseCrudService implements AnswerServiceInterface
{

    public function __construct(AnswerRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function oneByRequestTextOrCreate(string $word): AnswerEntity
    {
        $query = new Query;
        $query->where('request_text', $word);
        $collection = $this->repository->all($query);
        if ($collection->count() === 0) {
            $entity = $this->createEntity();
            $entity->setRequestText($word);
            $this->repository->create($entity);
        } else {
            $entity = $collection->first();
        }
        return $entity;
    }

    public function allByIds(array $answerIds) {
        $query = new Query;
        $query->where('id', $answerIds);
        return parent::all($query);
    }

}
