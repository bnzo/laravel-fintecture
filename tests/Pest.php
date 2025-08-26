<?php

use Bnzo\Fintecture\Tests\TestCase;
use Illuminate\Foundation\Testing\LazilyRefreshDatabase;

pest()
    ->extend(TestCase::class)
    ->use(LazilyRefreshDatabase::class)
    ->in(__DIR__);
