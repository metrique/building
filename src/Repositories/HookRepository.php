<?php

namespace Metrique\Building\Repositories;

use Metrique\Building\Repositories\Contracts\HookRepositoryInterface;

class HookRepository implements HookRepositoryInterface
{
    public $map = [
    ];

    public function hook($pointer)
    {
        if (array_key_exists(get_class($pointer), $this->map)) {
            if (method_exists($this, $this->map[get_class($pointer)])) {
                $this->{$this->map[get_class($pointer)]}($pointer);
            }
        }

        return false;
    }
}
