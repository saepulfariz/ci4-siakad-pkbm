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


function get_notifications()
{
    $model_notification = new \App\Models\NotificationModel();

    $cache = \Config\Services::cache();
    $cacheKey = 'notifications_' . auth()->id();
    if (!$cache->get($cacheKey)) {
        $data =  $model_notification->select('notifications.*, users.username as user_name')->join('users', 'users.id = notifications.user_id', 'left')->where('user_id', auth()->id())->orderBy('id', 'DESC')->findAll();
        $cache->save($cacheKey, $data, 360);
    } {
        $data = $cache->get($cacheKey);
    }

    return array_slice($data, 0, 3);
}
