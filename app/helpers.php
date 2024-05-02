<?php

use App\Models\Category;
use App\Models\Post;
use App\Models\Setting;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Support\Str;

/** PHP MAILER */

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!function_exists('blogInfo')) {
    function blogInfo()
    {
        return Setting::find(1);
    }
}

/**
 * Date Format eg: March 15, 2020
 */
if (!function_exists('date_formatter')) {
    function date_formatter($date)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $date)->isoFormat('LL');
    }
}

/**
 * Strip Words
 */
if (!function_exists('words')) {
    function words($value, $words = 15, $end = "...")
    {
        return Str::words(strip_tags($value), $words, $end);
    }
}

/**
 * Check if user is online/have an internet connection
 */
if (!function_exists('isOnline')) {
    function isOnline($site = "https://www.youtube.com/")
    {
        if (fopen($site, 'r')) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * Reading article duration
 */
if (!function_exists('readDuration')) {
    function readDuration(...$text)
    {
        Str::macro('timeCounter', function ($text) {
            $totalWords = str_word_count(implode(" ", $text));
            $minutesToRead = round($totalWords / 200);
            return (int)max(1, $minutesToRead);
        });
        return Str::timeCounter($text);
    }
}

/**
 * Display Home Main Latest Posts
 */
if (!function_exists('latest_posts')) {
    function latest_posts()
    {
        return Post::with('author')->with('subcategory')->limit(4)->orderBy('created_at', 'DESC')->get();
    }
}

/**
 * Display 7 Latest Posts On Home Page
 */
if (!function_exists('latest_home_posts')) {
    function latest_home_posts()
    {
        return Post::with('author')->with('subcategory')->limit(8)->orderBy('created_at', 'DESC')->get();
    }
}


/**
 * RANDOM RECOMMENDED POSTS
 */
if (!function_exists('recommended_posts')) {
    function recommended_posts()
    {
        return Post::with('author')->with('subcategory')->limit(4)->inRandomOrder()->get();
    }
}

/**
 * CATEGORY WITH NUMBER OF POSTS
 */
if (!function_exists('categories')) {
    function categories()
    {
        return SubCategory::whereHas('posts')->with('posts')->orderBy('subcategory_name', 'ASC')->get();
    }
}

/**
 * PARENT CATEGORY
 */
if (!function_exists('category')) {
    function category()
    {
        return Category::whereHas('subcategories')->orderBy('category_name', 'ASC')->get();
    }
}

/**
 * SIDEBAR LATEST POSTS
 */
if (!function_exists('latest_sidebar_posts')) {
    function latest_sidebar_posts($except = null, $limit = 4)
    {
        return Post::where('id', '!=', $except)
            ->limit($limit)
            ->orderBy('created_at', 'DESC')
            ->get();
    }
}

/** SEND EMAIL USING PHP MAILER */
if (!function_exists('sendMail')) {
    function sendMail($mailConfig)
    {
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host = env('EMAIL_HOST');
        $mail->SMTPAuth = true;
        $mail->Username = env('EMAIL_USERNAME');
        $mail->Password = env('EMAIL_PASSWORD');
        $mail->SMTPSecure = env('EMAIL_ENCRYPTION');
        $mail->Port = env('EMAIL_PORT');
        $email = "blog@gmail.com";
        $mail->setFrom($email, $mailConfig['mail_from_name']);
        $mail->addAddress($mailConfig['mail_recipient_email'], $mailConfig['mail_recipient_name']);
        $mail->isHTML(true);
        $mail->Subject = $mailConfig['mail_subject'];
        $mail->Body = $mailConfig['mail_body'];

        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
    }
}

/**
 * ALL TAGS
 */
if (!function_exists('tags_posts')) {
    function tags_posts()
    {
        return Post::where('post_tags', '!=', null)->distinct()->pluck('post_tags')->join(',');
    }
}

/**
 *  Display a date in the format of "X hours ago"
 */
if (!function_exists('formatTimeAgo')) {
    function formatTimeAgo($date)
    {
        $timeAgo = Carbon::parse($date)->diffForHumans();
        return $timeAgo;
    }
}
