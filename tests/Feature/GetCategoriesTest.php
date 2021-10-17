<?php

namespace Tests\Feature;

use Tests\TestCase;

class GetCategoriesTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @dataProvider dataProvider
     */
    public function testGetCategories(string $locale, array $expectedResult)
    {
        $response = $this->get('http://localhost:82/api/categories/'.$locale);

        $response->assertJsonFragment($expectedResult);
        $response->assertStatus(200);
    }

    public function dataProvider(): array
    {
        return [
                 [
                    'locale' => 'pl',
                    'expectedResult' => [
                        'categories' => [
                            ['category_name' => 'ksiazki'],
                            ['category_name' => 'ludzie'],
                            ['category_name' => 'pojazdy'],
                        ]
                    ],
                ],
                 [
                    'locale' => 'unknown',
                    'expectedResult' => [
                        'categories' => []
                    ],
                ],
                 [
                    'locale' => 'en',
                    'expectedResult' => [
                        'categories' => [
                            ['category_name' => 'books'],
                            ['category_name' => 'people'],
                            ['category_name' => 'vehicles'],
                        ]
                    ],
                ],
        ];
    }
}
