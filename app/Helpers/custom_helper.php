<?php


function asset_url($path = '')
{
    return base_url(PUBLIC_PATH . $path);
}


function temp_lang(string $line, array $args = [], ?string $locale = null)
{
    $cache = \Config\Services::cache();
    $cacheKey = $line;
    if (!$cache->get($cacheKey)) {
        $data = lang($line, $args, $locale);
        $cache->save('lang_' . $cacheKey . '_' . service('request')->getLocale(), $data, CACHE_TTL); // Cache for 60 minutes
    } else {
        $data = $cache->get($cacheKey);
    }

    return $data;
}
