<?php

namespace Tests;

use Carbon\Factory;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
abstract class TestCase extends BaseTestCase
{
    protected $model = User::class;
    use CreatesApplication;

    protected function user()
    {
        return User::factory()->create();
    }
}
