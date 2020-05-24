<?php

namespace App\Dialog\Domain\Repositories\Eloquent;

use PhpLab\Eloquent\Db\Base\BaseEloquentCrudRepository;
use App\Dialog\Domain\Entities\AnswerOptionEntity;
use App\Dialog\Domain\Interfaces\Repositories\AnswerOptionRepositoryInterface;

class AnswerOptionRepository extends BaseEloquentCrudRepository implements AnswerOptionRepositoryInterface
{

    public function tableName() : string
    {
        return 'dialog_answer_option';
    }

    public function getEntityClass() : string
    {
        return AnswerOptionEntity::class;
    }


}

