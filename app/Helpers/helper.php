<?php

if (!function_exists('sorting_link')) {
    /**
     * @param $field
     * @return \Illuminate\Contracts\Routing\UrlGenerator|string
     */
    function sorting_url($field)
    {
        $path = request()->getPathInfo();
        $query = request()->query->all() ?? [];
        $order = request('order', 'asc') == 'asc' ? 'desc' : 'asc';
        $parameters = array_merge($query, ['orderBy' => $field, 'order' => $order]);

        return url($path . '?' . http_build_query($parameters));
    }
}