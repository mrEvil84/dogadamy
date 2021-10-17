<?php

namespace Tests\Feature;

use Tests\TestCase;

class AddCategoriesTest extends TestCase
{

    public function testAddCategories(): void
    {
        $addResponse = $this->postJson('http://localhost:82/api/categories/', [
            'category_name' => 'samoloty',
            'locale' => 'pl',
        ]);

        $addResponse->assertStatus(200);

        $deleteResponse = $this->deleteJson('http://localhost:82/api/categories/', [
            'category_name' => 'samoloty'
        ]);

        $deleteResponse->assertStatus(200);
    }

    public function testCategoryAlreadyExists(): void
    {
        $addResponse = $this->postJson('http://localhost:82/api/categories/', [
            'category_name' => 'ludzie',
            'locale' => 'pl',
        ]);

        $addResponse->assertStatus(400);
        $addResponse->assertJsonFragment(['error_message'=>"Category already exists"]);
    }

    public function testLocaleNameNotExists(): void
    {
        $addResponse = $this->postJson('http://localhost:82/api/categories/', [
            'category_name' => 'drzewa',
            'locale' => 'wpt',
        ]);

        $addResponse->assertStatus(400);
        $addResponse->assertJsonFragment(['error_message'=>"Locale name don't exists"]);
    }
}
