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


function isToday($date, $day)
{
    $timestamp = strtotime($date);

    $dayEnglish = date('l', $timestamp);

    $mapDays = [
        'Monday'    => 'Monday',
        'Tuesday'   => 'Tuesday',
        'Wednesday' => 'Wednesday',
        'Thursday'  => 'Thursday',
        'Friday'    => 'Friday',
        'Saturday'  => 'Saturday',
        'Sunday'    => 'Sunday',
    ];

    // $mapDays = [
    //     'Monday'    => 'Senin',
    //     'Tuesday'   => 'Selasa',
    //     'Wednesday' => 'Rabu',
    //     'Thursday'  => 'Kamis',
    //     'Friday'    => 'Jumat',
    //     'Saturday'  => 'Sabtu',
    //     'Sunday'    => 'Minggu',
    // ];

    return ($mapDays[$dayEnglish] === $day);
}


function checkTheDay()
{
    $result = false;
    if (auth()->user()->can('attendances.sunday')) {
        if (!isToday(date('Y-m-d'), 'Sunday')) {
            $result = true;
        }
    }

    if (auth()->user()->can('attendances.monday')) {
        if (!isToday(date('Y-m-d'), 'Monday')) {
            $result = true;
        }
    }

    if (auth()->user()->can('attendances.tuesday')) {
        if (!isToday(date('Y-m-d'), 'Tuesday')) {
            $result = true;
        }
    }

    if (auth()->user()->can('attendances.wednesday')) {
        if (!isToday(date('Y-m-d'), 'Wednesday')) {
            $result = true;
        }
    }

    if (auth()->user()->can('attendances.thursday')) {
        if (!isToday(date('Y-m-d'), 'Thursday')) {
            $result = true;
        }
    }

    if (auth()->user()->can('attendances.friday')) {
        if (!isToday(date('Y-m-d'), 'Friday')) {
            $result = true;
        }
    }

    if (auth()->user()->can('attendances.saturday')) {
        if (!isToday(date('Y-m-d'), 'Saturday')) {
            $result = true;
        }
    }

    return $result;
}
