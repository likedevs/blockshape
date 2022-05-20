<?php

namespace spec\App\Services;

use App\Services\FigureType;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class FigureTypeSpec extends ObjectBehavior
{
    public function it_detects_clepsidra()
    {
        $this->detect(90, 93)->shouldBe(FigureType::TYPE_CLEPSIDRA);
        $this->detect(95, 90)->shouldBe(FigureType::TYPE_CLEPSIDRA);
    }

    public function it_detects_apple()
    {
        $this->detect(100, 107)->shouldBe(FigureType::TYPE_APPLE);
        $this->detect(80, 88)->shouldBe(FigureType::TYPE_APPLE);
    }

    public function it_detects_pear()
    {
        $this->detect(120, 110)->shouldBe(FigureType::TYPE_PEAR);
        $this->detect(100, 90)->shouldBe(FigureType::TYPE_PEAR);
        $this->detect(106, 100.0)->shouldBe(FigureType::TYPE_PEAR);
        $this->detect(110, 100.0)->shouldBe(FigureType::TYPE_PEAR);
    }
}
