<?php

namespace Tests;

use Faker\Factory;
use Faker\Generator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * @var Generator
     */
    protected Generator $faker;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
    }
}
