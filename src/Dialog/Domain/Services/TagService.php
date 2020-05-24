<?php

namespace App\Dialog\Domain\Services;

use PhpBundle\TelegramClient\Libs\SoundexRuEn;
use App\Dialog\Domain\Entities\TagEntity;
use App\Dialog\Domain\Interfaces\Repositories\TagRepositoryInterface;
use App\Dialog\Domain\Interfaces\Services\TagServiceInterface;
use App\Dialog\Domain\Libs\Parser;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Collection;
use PhpLab\Core\Domain\Base\BaseCrudService;
use PhpLab\Core\Domain\Entities\Query\Where;
use PhpLab\Core\Domain\Enums\OperatorEnum;
use PhpLab\Core\Domain\Libs\Query;
use PhpLab\Core\Helpers\StringHelper;
use PhpLab\Core\Legacy\Yii\Helpers\ArrayHelper;

class TagService extends BaseCrudService implements TagServiceInterface
{

    public function __construct(TagRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function import(Container $container) {

        $dataBaseText = file_get_contents(__DIR__ . '/../../../../config/answer_databse') ;
        $parser = new Parser;
        $collection = $parser->parseFromText($dataBaseText);



        /** @var \App\Dialog\Domain\Interfaces\Services\TagServiceInterface $tagService */
        $tagService = $container->get(\App\Dialog\Domain\Services\TagService::class);

        /** @var \App\Dialog\Domain\Interfaces\Services\AnswerServiceInterface $answerService */
        $answerService = $container->get(\App\Dialog\Domain\Services\AnswerService::class);

        /** @var \App\Dialog\Domain\Interfaces\Services\AnswerTagServiceInterface $answerTagService */
        $answerTagService = $container->get(\App\Dialog\Domain\Services\AnswerTagService::class);

        /** @var \App\Dialog\Domain\Interfaces\Services\AnswerOptionServiceInterface $answerOptionService */
        $answerOptionService = $container->get(\App\Dialog\Domain\Services\AnswerOptionService::class);

        foreach ($collection as $token => $answer) {

            $answerEntity = $answerService->oneByRequestTextOrCreate($token);

            echo PHP_EOL . $token . PHP_EOL;
            //$tags = explode(' ', $token);
            $tags = StringHelper::getWordArray($token);
            foreach ($tags as $tag) {

                $tagEntity = $tagService->oneByWordOrCreate($tag);

                try {
                    $answerTagService->create([
                        'tag_id' => $tagEntity->getId(),
                        'answer_id' => $answerEntity->getId(),
                    ]);
                } catch (\Exception $e) {}
            }
            foreach ($answer as $option) {
                try {
                    $answerOptionService->create([
                        'answer_id' => $answerEntity->getId(),
                        'text' => $option['answer'],
                        'sort' => intval($option['sort']) * 100,
                    ]);
                } catch (\Exception $e) {}
            }
        }
    }

    private function filterTagCollection(string $word, Collection $tagCollection): string
    {
        if($tagCollection->count() > 1) {
            $ratingByLevenshtein = [];
            $ratingBySimilar = [];
            foreach ($tagCollection as $tagEntity) {
                $itemWord = $tagEntity->getWord();
                $ratingByLevenshtein[$itemWord] = levenshtein($word, $tagEntity->getWord());
                $ratingBySimilar[$itemWord] = similar_text($word, $tagEntity->getWord());
            }
            $firstWord = ArrayHelper::firstKey($ratingByLevenshtein);
        } else {
            $firstWord = $tagCollection->first()->getWord();
        }
        return $firstWord;
    }

    public function normalizeWorlds(array $words): array
    {
        $soundex = new SoundexRuEn;
        foreach ($words as &$word) {
            $query = new Query;
            $query->whereNew(new Where('soundex', $soundex->encodeSoundex($word), OperatorEnum::EQUAL, 'or'));
            $query->whereNew(new Where('metaphone', $soundex->encodeMetaphone($word), OperatorEnum::EQUAL, 'or'));
            /** @var TagEntity[] | Collection $tagCollection */
            $tagCollection = parent::all($query);
            $word = $this->filterTagCollection($word, $tagCollection);
        }
        return $words;
    }

    public function allByWorlds(array $words, Query $query = null): Collection
    {
        $query = new Query;
        $query->with(['answer']);
        $query->where('word', $words);
        return parent::all($query);
    }

    public function oneByWordOrCreate(string $word): TagEntity
    {
        $query = new Query;
        $query->where('word', $word);
        $collection = $this->repository->all($query);
        if ($collection->count() === 0) {
            $entity = $this->createEntity();
            $entity->setWord($word);
            $this->repository->create($entity);
        } else {
            $entity = $collection->first();
        }
        return $entity;
    }

}
