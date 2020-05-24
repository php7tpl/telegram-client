<?php

namespace Tests\Unit;

use App\Dialog\Domain\Services\PredictService;
use Illuminate\Container\Container;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

    public function testTextToSentences()
    {
        $container = Container::getInstance();
        $tagService = $container->get(PredictService::class);

        $sentences = $tagService->textToSentences('привет! как дела? че делаешь?');
        $this->assertEquals([
            [
                'привет',
            ],
            [
                'как',
                'дела',
            ],
            [
                'чё',
                'делаешь',
            ],
        ], $sentences);

        $sentences = $tagService->textToSentences('........превет!!!!....... КАК$%^&*(*&^%дел???...... че#$%^&*(делаеш....?........');
        $this->assertEquals([
            [
                'привет',
            ],
            [
                'как',
                'дела',
            ],
            [
                'чё',
                'делаешь',
            ],
        ], $sentences);
    }

    public function testTextToTokensChars()
    {
        $container = Container::getInstance();
        $tagService = $container->get(PredictService::class);

        $words = $tagService->textToWords('   ***$%^  &привет  $^&(&^#$    ');
        $this->assertEquals(['привет'], $words);

        $words = $tagService->textToWords('   ***$%^  как@#$%^&*дила  $^&(&^#$   ');
        $this->assertEquals(['как', 'дела'], $words);

        $words = $tagService->textToWords('.');
        $this->assertEquals([''], $words);

        $words = $tagService->textToWords('1');
        $this->assertEquals([''], $words);
    }

    public function testTextToTokensCases()
    {
        $container = Container::getInstance();
        $tagService = $container->get(PredictService::class);

        $words = $tagService->textToWords('ПРИВЕТ');
        $this->assertEquals(['привет'], $words);

        $words = $tagService->textToWords('КАК ДИЛА');
        $this->assertEquals(['как', 'дела'], $words);
    }

    public function testTextToTokens()
    {
        $container = Container::getInstance();
        $tagService = $container->get(PredictService::class);


        $words = $tagService->textToWords('привет');
        $this->assertEquals(['привет'], $words);

        $words = $tagService->textToWords('превет');
        $this->assertEquals(['привет'], $words);

        $words = $tagService->textToWords('превед');
        $this->assertEquals(['привет'], $words);

        $words = $tagService->textToWords('првет');
        $this->assertEquals(['привет'], $words);

        $words = $tagService->textToWords('првт');
        $this->assertEquals(['привет'], $words);

        // -------------------

        $words = $tagService->textToWords('как дела');
        $this->assertEquals(['как', 'дела'], $words);

        $words = $tagService->textToWords('каг дела');
        $this->assertEquals(['как', 'дела'], $words);

        $words = $tagService->textToWords('как дила');
        $this->assertEquals(['как', 'дела'], $words);

        $words = $tagService->textToWords('как дел');
        $this->assertEquals(['как', 'дела'], $words);

        // -------------------

        $words = $tagService->textToWords('как делишки');
        $this->assertEquals(['как', 'делишки'], $words);

        $words = $tagService->textToWords('как делишки');
        $this->assertEquals(['как', 'делишки'], $words);

        $words = $tagService->textToWords('как дилишки');
        $this->assertEquals(['как', 'делишки'], $words);

        $words = $tagService->textToWords('как делищки');
        $this->assertEquals(['как', 'делишки'], $words);
    }


}
