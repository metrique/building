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
    public static function slugify($string, $delimiter = '-', $directorySeparator = '_')
    {
        
        // Allowed character list
        $allowed = "/[^a-zA-Z\d\s\/" . preg_quote($delimiter) . preg_quote($directorySeparator) . "]/u";

        // Convert to closest ASCII
        $string = Stringy::create($string)->toAscii();

        // Remove non allowed characters
        $string = preg_replace($allowed, '', $string);

        
        // Get directory separators.
        $string = collect(explode($directorySeparator, $string))->reduce(
            function ($carry, $item) use ($delimiter, $directorySeparator) {
                return $carry . $directorySeparator . Stringy::create($item)->delimit($delimiter);
            }
        );

        // Lowercase, delimit and trim!
        if (strlen($string) > 1) {
            $string = Stringy::create($string)
                ->removeLeft($delimiter)
                ->removeLeft($directorySeparator)
                ->removeRight($delimiter)
                ->removeRight($directorySeparator);
        }

        // Convert path separators to underscores.
        $string = str_replace('/', '_', $string);
        
        return empty($string) ? '_' : $string;
    }

    /**
     * Converts a slug back to a path.
     *
     * @param  string $string
     * @return string
     */
    public static function unslugify($string, $directorySeparator = '_')
    {
        return str_replace($directorySeparator, '/', $string);
    }
}
