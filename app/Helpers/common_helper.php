<?php

if (!function_exists("rearrangeCategories")) {
    function rearrangeCategories($categories, $parentId = 0, &$weight = 0)
    {
        $result = [];

        foreach ($categories as $category) {
            $result[] = [
                'id' => $category['id'],
                'parent_id' => $parentId,
                'weight' => $weight++
            ];

            if (isset($category['children'])) {
                $result = array_merge($result, rearrangeCategories($category['children'], $category['id'], $weight));
            }
        }

        return $result;
    }
}

if (!function_exists("buildHierarchy")) {
    function buildHierarchy($categories, $parentId = 0)
    {
        $result = [];

        foreach ($categories as $category) {
            if ($category->parent_category_id == $parentId) {
                $children = buildHierarchy($categories, $category->id);
                if ($children) {
                    $category->children = $children;
                }
                $result[] = $category;
            }
        }

        return $result;
    }
}

if (!function_exists("encodeURL")) {
    function encodeURL($string)
    {
        if (!empty($string)) {
            $encrypted = str_replace('/', '__SLASH__', $string);
            $encrypted = str_replace('+', '__PLUS__', $encrypted);
        }
        return $encrypted;
    }
}

if (!function_exists("decodeURL")) {
    function decodeURL($string)
    {
        $string = str_replace('__SLASH__', '/', $string);
        $string = str_replace('__PLUS__', '+', $string);
        return $string;
    }
}
