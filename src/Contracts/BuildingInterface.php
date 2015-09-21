<?php

namespace Metrique\Building\Contracts;

interface BuildingInterface {
    public function slugify($string, $delimiter = '-', $directorySeperator = '_');
    public function unslugify($string, $directorySeperator = '_');
    public function input($type, $name, $title, $value);
}