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
