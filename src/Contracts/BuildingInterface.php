<?php

namespace Metrique\Building\Contracts;

interface BuildingInterface {
    public function slugify($string, $delimiter = '-', $directorySeperator = '_');
    public function unslugify($string, $directorySeperator = '_');
}