<?php

namespace Metrique\Building;

use Metrique\Building\Contracts\BuildingInterface;
use Stringy\Stringy;

class Building implements BuildingInterface {

    /**
     * Laravel application
     * 
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new Building instance
     * 
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    public function __construct(\Illuminate\Foundation\Application $app)
    {
        $this->app = $app;
    }

    /**
     * Converts a string to the Building slug format.
     * 
     * Underscore represents a path seperator.
     * Dash is used as a word seperator.
     * 
     * @param  string $string
     * @return string
     */
    public function slugify($string, $delimiter = '-', $directorySeperator = '_')
    {
        // Allowed character list
        $allowed = "/[^a-zA-Z\d\s-_\/" . preg_quote($delimiter) . "]/u";

        // Convert to closest ASCII
        $string = Stringy::create($string)->toAscii();

        // Remove non allowed characters
        $string = preg_replace($allowed, '', $string);

        // Lowercase, delimit and trim!
        $string = Stringy::create($string)->toLowerCase()->delimit($delimiter)->removeLeft($delimiter)->removeRight($delimiter);

        // Convert path seperators to underscores.
        $string = str_replace('/', '_', $string);

        return $string;
    }

    /**
     * Converts a slug back to a path.
     * 
     * @param  string $string
     * @return string
     */
    public function unslugify($string, $directorySeperator = '_')
    {
        return str_replace($directorySeperator, '/', $string);
    }

    /**
     * Gets the relevant input type
     * 
     * @param  string $type
     * @param  string $name
     * @param  string $title
     * @param  string $value
     * @return string 
     */
    public function input($type, $name, $title, $value)
    {
        $label = sprintf('<label for="%s">%s</label>', $name, $title);

        switch($type)
        {
            case 'text-area':
                $input = sprintf('<div id="%s" style="height: 200px;" data-ace></div><textarea class="ace" name="%s">%s</textarea>', $name, $name, $value);
            break;

            default:
                $input = sprintf('<input name="%s" type="text" value="%s">', $name, $value);
            break;
        }

        return $label.$input;
    }
}