<?php

use App\Models\User;
use App\Models\Setting;

//  setting Helper Function
if (!function_exists('setting')) {
    function setting()
    {
        $companyId = user() ? user()->company_id : 1;
        return Setting::where('company_id', $companyId)->first() ?? Setting::where('company_id', 1)->first() ?? new Setting();
    }
}

// test
//  get language Helper Function
if (!function_exists('Lang')) {
    function Lang()
    {
        return app()->getLocale();
    }
}


//  get user Helper Function
if (!function_exists('user')) {
    function user()
    {
        return auth()->guard('web')->user();
    }
}

//  get employee Helper Function
if (!function_exists('employee')) {
    function employee()
    {
        return auth()->guard('employee');
    }
}

if (!function_exists('slug')) {
    function slug($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
        $stringToLower = strtolower($string);
        return preg_replace('/[^\w\s\-]+/u', '', $stringToLower);
    }
}

if (!function_exists('replaceHyphensWithSpaces')) {
    function replaceHyphensWithSpaces($string)
    {
        return $string = str_replace('-', ' ', $string); // Replaces all hyphens with spaces.
    }
}

//  get admin count Helper Function
if (!function_exists('adminCount')) {
    function adminCount()
    {
        return User::count();
    }
}





// month name  in arabic
if (!function_exists('monthNameArabic')) {
    function monthNameArabic($monthNumber)
    {
        $months = [
            1 => 'يناير',
            2 => 'فبراير',
            3 => 'مارس',
            4 => 'أبريل',
            5 => 'مايو',
            6 => 'يونيو',
            7 => 'يوليو',
            8 => 'أغسطس',
            9 => 'سبتمبر',
            10 => 'أكتوبر',
            11 => 'نوفمبر',
            12 => 'ديسمبر',
        ];
        return $months[$monthNumber] ?? null; // يعيد الاسم أو null إذا لم يكن الرقم صحيحاً
    }
}

// tafqeet function (Convert numbers to Arabic words)
if (!function_exists('tafqeet')) {
    function tafqeet($number, $currency = 'دولار', $subCurrency = 'سنت')
    {
        $before_comma = trim($number);
        if (strpos($before_comma, '.') !== false) {
            $after_comma = explode('.', $before_comma);
            $before_comma = $after_comma[0];
            $after_comma = $after_comma[1];
            if (strlen($after_comma) > 2) {
                $after_comma = substr($after_comma, 0, 2);
            }
        } else {
            $after_comma = "";
        }

        $obj = new \App\Helpers\TafqeetHelper();
        $result = $obj->convert($before_comma);

        $text = $result . ' ' . $currency;

        if ($after_comma != "" && intval($after_comma) > 0) {
            $result2 = $obj->convert($after_comma);
            $text .= ' و ' . $result2 . ' ' . $subCurrency;
        }

        return $text . ' فقط لا غير';
    }
}

if (!function_exists('greeting')) {
    function greeting()
    {
        $hour = date('H');
        if ($hour >= 5 && $hour < 12) {
            return __('dashboard.good_morning');
        } elseif ($hour >= 12 && $hour < 17) {
            return __('dashboard.good_afternoon');
        } elseif ($hour >= 17 && $hour < 21) {
            return __('dashboard.good_evening');
        } else {
            return __('dashboard.good_night');
        }
    }
}

/**
 * Handle Arabic grammatical nuances for month counts
 * RLM (\u200F) is a Unicode Right-to-Left Mark that forces correct RTL ordering
 * in Word documents when mixing Arabic text with numbers.
 */
if (!function_exists('contract_duration_arabic')) {
    function contract_duration_arabic($months)
    {
        // Unicode Right-to-Left Mark — forces correct word order in RTL Word docs
        $rlm = "\u{200F}";

        if (Lang() === 'en') {
            return $months . ' ' . ($months == 1 ? __('employeeContracts.month') : __('employeeContracts.months_3_10'));
        }

        $months = (int)$months;
        if ($months == 1) {
            return __('employeeContracts.month');
        }
        if ($months == 2) {
            return __('employeeContracts.two_months');
        }
        if ($months >= 3 && $months <= 10) {
            return $rlm . $months . ' ' . __('employeeContracts.months_3_10');
        }
        return $rlm . $months . ' ' . __('employeeContracts.months_11');
    }
}
