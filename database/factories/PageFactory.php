<?php

namespace Metrique\Building\Database\Factories;

use Metrique\Building\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'path' => sprintf(
                '/%s/%s',
                uniqid(),
                uniqid()
            ),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->sentences(2, true),
            'image' => $this->faker->imageUrl(random_int(320, 640), random_int(320, 640), 'cats'),
            'meta' => sprintf('{"og:title":"%s"}', $this->faker->sentence()),
            'params' => sprintf('{"share":true}'),
            'published_at' => now(),
        ];
    }

    public function english()
    {
        return $this->state(fn (array $attributes) => ['path' => sprintf('/en/%s', uniqid())]);
    }
    
    public function englishRoot()
    {
        return $this->state(fn (array $attributes) => ['path' => '/en']);
    }

    public function french()
    {
        return $this->state(fn (array $attributes) => ['path' => sprintf('/fr/%s', uniqid())]);
    }

    public function frenchRoot()
    {
        return $this->state(fn (array $attributes) => ['path' => '/fr']);
    }

    public function german()
    {
        return $this->state(fn (array $attributes) => ['path' => sprintf('/de/%s', uniqid())]);
    }

    public function germanRoot()
    {
        return $this->state(fn (array $attributes) => ['path' => '/de']);
    }

    public function root()
    {
        return $this->state(fn (array $attributes) => ['path' => '/']);
    }
}
