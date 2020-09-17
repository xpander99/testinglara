<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;

    protected function nameGenerator($size){
        $str = '';
        while(strlen($str)<=$size){
            $str .= $this->faker->name . " ";
        }
        return $str;
    }
}
