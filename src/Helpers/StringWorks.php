<?php
namespace Exigo\Helpers;

class StringWorks
{
    /**
     * @description 
     **/
    public static function wordToAbbrev(string $word, int $max = 2)
    {
        $split = array_filter(explode(' ', strtoupper(str_replace('-', ' ', $word))));
        if(count($split) > 1) {
            $abbrev = substr(implode(array_map(fn($v) => substr($v, 0, 1), $split)), 0, $max);
        } else {
            $abbrev = substr(array_shift($split), 0, $max);
        }
        return $abbrev;
    }
}