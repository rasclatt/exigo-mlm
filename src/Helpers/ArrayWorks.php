<?php
namespace Exigo\Helpers;

class ArrayWorks
{
    /**
     *	@description	Recurse trim all values
     */
    public static function trimAll($value)
    {
        if(is_iterable($value)) {
            foreach($value as $k => $v) {
                if(is_object($value))
                    $value->{$k} = self::trimAll($v);
                else
                    $value[$k] = self::trimAll($v);
            }
        } else {
            if(is_string($value)) {
                return trim($value);
            }
        }
        return $value;
    }

    public static function buildNestedArray($rows, $parentId = null)
    {
        $nestedArray = [];
        foreach ($rows as $row) {
            if ($row['ParentID'] == $parentId ) {
                $child = [
                    $row['WebCategoryDescription'] => [
                        'id' => (int) $row['WebCategoryID'],
                        'children' => self::buildNestedArray($rows, $row['WebCategoryID'])
                    ]
                ];
    
                $nestedArray[] = $child;
            }
        }
    
        return $nestedArray;
    }

    public static function findChildCategoryIds($data, $match, &$result = [])
    {
        foreach($data as $k => $v) {
            if(!is_numeric($k)) {
                $current = (!empty($match))? array_shift($match) : null;
                if($k == $current) {
                    if(empty($data[$k]['children'])) {
                        $result[] = $data[$k]['id'];
                    } else {
                        self::findChildCategoryIds($data[$k]['children'], $match, $result);
                    }
                    break;
                } elseif(empty($current)) {
                    $result[] = $data[$k]['id'];
                    if(!empty($data[$k]['children'])) {
                        self::findChildCategoryIds($data[$k]['children'], $match, $result);
                    }
                }
            } else {
                self::findChildCategoryIds($data[$k], $match, $result);
            }
        }
    }
}