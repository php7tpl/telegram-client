<?php

namespace App\Dialog\Domain\Services;

use App\Dialog\Domain\Interfaces\Services\AnswerOptionServiceInterface;
use App\Dialog\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Core\Domain\Libs\Query;

class AnswerOptionService extends BaseCrudService implements AnswerOptionServiceInterface
{

    public function __construct(AnswerOptionRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function allByAnswerIds(array $answerIds) {
        $query = new Query;
        $query->where('answer_id', $answerIds);
        $query->orderBy([
            'sort' => SORT_ASC,
        ]);
        return parent::all($query);
    }
}
