<?php

namespace Metrique\Building\Support;

use Stringy\Stringy;

class Slug
{
    /**
     * Converts a string to slug/url format.
     * Underscore represents a path separator.
     * Dash is used as a word separator.
     *
     * @param  $string
     * @param  string $delimiter
     * @param  string $directorySeparator
     * @return string
     */
    public static function slugify($string, $delimiter = '-', $directorySeperator = '_')
    {
        // Allowed character list
        $allowed = "/[^a-zA-Z\d\s-_\/" . preg_quote($delimiter) . "]/u";

        // Convert to closest ASCII
        $string = Stringy::create($string)->toAscii();

        // Remove non allowed characters
        $string = preg_replace($allowed, '', $string);

        // Lowercase, delimit and trim!
        $string = Stringy::create($string)
            ->toLowerCase()
            ->delimit($delimiter)
            ->removeLeft($delimiter)
            ->removeRight($delimiter);

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
    public static function unslugify($string, $directorySeperator = '_')
    {
        return str_replace($directorySeperator, '/', $string);
    }
}
