<?php

use App\Glossary;
use App\Target;
use Illuminate\Database\Migrations\Migration;

class MoveTargetNotesToGlossary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        foreach(Target::all() as $target) {
            foreach($this->params() as $param) {
                Glossary::create([
                    'title' => $this->name($param, $target),
                    'slug'  => $this->slug($param, $target),
                    'body'  => $this->value($param, $target)
                ]);
            }
        }

        foreach($this->params() as $param) {
            Glossary::create([
                'title' => ucwords($param) . " [Slabire < 7 kg]",
                'slug'  => "definition.{$param}.weight-loss-lte-7-kg"
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach(Target::all() as $target) {
            foreach($this->params() as $param) {
                Glossary::whereSlug($this->slug($param, $target))->delete();
                Glossary::whereSlug("definition.{$param}.weight-loss-lte-7-kg");
            }
        }

    }

    /**
     * @param $param
     * @param $target
     * @return string
     */
    protected function slug($param, $target)
    {
        return 'definition.' . $param . '.' . $target->slug;
    }

    /**
     * @param $param
     * @param $target
     * @return string
     */
    protected function name($param, $target)
    {
        return ucfirst($param) . ' [' . $target->name . ']';
    }

    /**
     * @param $param
     * @param $target
     * @return mixed
     */
    protected function value($param, $target)
    {
        return $target->$param;
    }

    /**
     * @return array
     */
    protected function params()
    {
        return ['imc', 'metabolism', 'pulse', 'resume'];
    }
}
