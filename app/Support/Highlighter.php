<?php

namespace App\Support;

use Illuminate\Support\HtmlString;

class Highlighter
{
    public static function make(?string $text, string $query): HtmlString
    {
        $text = (string) $text;

        $words = collect(preg_split('/\s+/u', trim($query), -1, PREG_SPLIT_NO_EMPTY))
            ->filter(fn ($w) => mb_strlen($w) >= 2)
            ->unique()
            ->sortByDesc(fn ($w) => mb_strlen($w))
            ->map(fn ($w) => preg_quote($w, '/'))
            ->values()
            ->all();

        if (! $words) {
            return new HtmlString(e($text));
        }

        $parts = preg_split('/('.implode('|', $words).')/iu', $text, -1, PREG_SPLIT_DELIM_CAPTURE);

        if ($parts === false) {
            return new HtmlString(e($text));
        }

        $html = '';
        foreach ($parts as $i => $part) {
            $html .= $i % 2 === 1
                ? '<mark class="rounded bg-yellow px-0.5 text-inherit">'.e($part).'</mark>'
                : e($part);
        }

        return new HtmlString($html);
    }

    /** Фрагмент навколо першого збігу, щоб підсвічене слово було видно. */
    public static function snippet(?string $text, string $query, int $length = 160): string
    {
        $text = trim(preg_replace('/\s+/u', ' ', strip_tags((string) $text)));

        if (mb_strlen($text) <= $length) {
            return $text;
        }

        $word = collect(preg_split('/\s+/u', trim($query), -1, PREG_SPLIT_NO_EMPTY))
            ->first(fn ($w) => mb_stripos($text, $w) !== false);

        $pos = $word ? mb_stripos($text, $word) : 0;
        $start = max(0, $pos - (int) ($length / 3));
        $snippet = mb_substr($text, $start, $length);

        return ($start > 0 ? '…' : '').$snippet.(($start + $length) < mb_strlen($text) ? '…' : '');
    }
}