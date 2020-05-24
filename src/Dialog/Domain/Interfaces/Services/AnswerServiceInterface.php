<?php

namespace App\Dialog\Domain\Interfaces\Services;

use App\Dialog\Domain\Entities\AnswerEntity;
use PhpLab\Core\Domain\Interfaces\Service\CrudServiceInterface;

interface AnswerServiceInterface extends CrudServiceInterface
{

    public function oneByRequestTextOrCreate(string $word): AnswerEntity;

}

