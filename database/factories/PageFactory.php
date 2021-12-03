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
            'meta' => [
                'og:title' => $this->faker->sentence()
            ],
            'params' => [
                'share' => true
            ],
            'draft' => null,
            'live' => null,
            'published_at' => now(),
        ];
    }

    public function unpublished()
    {
        return $this->state(fn (array $attributes) => [
            'path' => sprintf('/unpublished/%s', uniqid()),
            'published_at' => null
        ]);
    }

    public function notYetPublished()
    {
        return $this->state(fn (array $attributes) => [
            'path' => sprintf('/not-yet-published/%s', uniqid()),
            'published_at' => now()->addYear(1),
        ]);
    }

    public function uk()
    {
        return $this->state(fn (array $attributes) => [
            'path' => sprintf('/uk/%s', uniqid())
        ]);
    }
    
    public function ukRoot()
    {
        return $this->state(fn (array $attributes) => [
            'path' => '/uk'
        ]);
    }

    public function fr()
    {
        return $this->state(fn (array $attributes) => [
            'path' => sprintf('/fr/%s', uniqid())
        ]);
    }

    public function frRoot()
    {
        return $this->state(fn (array $attributes) => [
            'path' => '/fr'
        ]);
    }

    public function de()
    {
        return $this->state(fn (array $attributes) => [
            'path' => sprintf('/de/%s', uniqid())
        ]);
    }

    public function deRoot()
    {
        return $this->state(fn (array $attributes) => [
            'path' => '/de'
        ]);
    }

    public function root()
    {
        return $this->state(fn (array $attributes) => [
            'path' => '/'
        ]);
    }
}
