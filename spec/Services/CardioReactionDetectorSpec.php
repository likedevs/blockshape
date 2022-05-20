<?php

namespace spec\App\Services;

use App\Services\Contracts\CardioReactionDetector as Detector;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CardioReactionDetectorSpec extends ObjectBehavior
{
    /**
     * Hipertonie - Attention
     *
     * @test
     */
    public function it_detects_hipertonie_atention()
    {
        $this->detect(140)->toString()->shouldBe(Detector::R_HIPERTONIE . '-' . Detector::R_ATTENTION);
        $this->detect(160)->toString()->shouldBe(Detector::R_HIPERTONIE . '-' . Detector::R_ATTENTION);
        $this->detect(200)->toString()->shouldBe(Detector::R_HIPERTONIE . '-' . Detector::R_ATTENTION);
    }

    /**
     * Hipotonie - Hipertonie
     *
     * @test
     */
    public function it_detects_hipotonie_hipertonie()
    {
        $this->detect(70, 135)->toString()->shouldBe(Detector::R_HIPOTONIE . '-' . Detector::R_HIPERTONIE);
        $this->detect(90, 140)->toString()->shouldBe(Detector::R_HIPOTONIE . '-' . Detector::R_HIPERTONIE);
    }

    /**
     * Hipotonie - Normotonie
     *
     * @test
     */
    public function it_detects_hipotonie_normotonie()
    {
        $this->detect(70, 110)->toString()->shouldBe(Detector::R_HIPOTONIE . '-' . Detector::R_NORMOTONIE);
        $this->detect(90, 130)->toString()->shouldBe(Detector::R_HIPOTONIE . '-' . Detector::R_NORMOTONIE);
    }

    /**
     * Normotonie - Hipertonie
     *
     * @test
     */
    public function it_detects_normotonie_hipertonie()
    {
        $this->detect(110, 135)->toString()->shouldBe(Detector::R_NORMOTONIE . '-' . Detector::R_HIPERTONIE);
        $this->detect(120, 150)->toString()->shouldBe(Detector::R_NORMOTONIE . '-' . Detector::R_HIPERTONIE);
    }

    /**
     * Normotonie - Normotonie
     *
     * @test
     */
    public function it_detects_normotonie_normotonie()
    {
        $this->detect(110, 110)->toString()->shouldBe(Detector::R_NORMOTONIE . '-' . Detector::R_NORMOTONIE);
        $this->detect(120, 130)->toString()->shouldBe(Detector::R_NORMOTONIE . '-' . Detector::R_NORMOTONIE);
    }

    /**
     * @test
     */
    public function it_resolves_id()
    {
        $this->detect(155)->id()->shouldBe(4);
        $this->detect(70, 135)->id()->shouldBe(3);
        $this->detect(70, 110)->id()->shouldBe(2);
        $this->detect(110, 135)->id()->shouldBe(5);
        $this->detect(110, 130)->id()->shouldBe(1);
    }
}
