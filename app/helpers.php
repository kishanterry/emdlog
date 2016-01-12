<?php
use Illuminate\Support\Str;

/**
 * @param null $date
 * @return \Carbon\Carbon
 */
function carbon($date = null)
{
    return app(Carbon\Carbon::class)->create($date);
}

/**
 * @param $value
 * @param int $words
 * @param string $end
 * @return string
 */
function str_words($value, $words = 100, $end = '...')
{
    return Str::words($value, $words, $end);
}

/**
 * @param $text
 * @return mixed
 */
function parsedown($text)
{
    $parsed = app(Parsedown::class)->text($text);

    return App\FontAwesomeDown::parse($parsed);
}

function get_home()
{
    return get_article('home');
}

function get_footer()
{
    return get_article('footer');
}

function get_article($slug)
{
    $article = app(App\Models\Article::class)->whereSlug($slug)->first();

    if (!$article) {
        return with(new App\Models\Article)->article;
    }

    return $article->article;
}