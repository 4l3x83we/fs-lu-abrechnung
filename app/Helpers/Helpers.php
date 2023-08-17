<?php
/**
 * Copyright (c) Alexander Guthmann.
 *
 * File: Helpers.php
 * User: aguth
 * Date: 16.August.2023
 * Time: 10:10
 */


use Intervention\Image\Facades\Image;
use Intervention\Image\ImageManagerStatic;

if (! function_exists('canonical_url')) {
    function canonical_url(): array|string
    {
        if (\Illuminate\Support\Str::startsWith($current = url()->current(), 'https://www')) {
            return str_replace('https://www.', 'https://', $current);
        }

        return str_replace('https://', 'https://www.', $current);
    }
}

function initials($query)
{
    $name = explode(' ', trim($query->name));

    $first = $name[0];
    $last = $name[count($name) - 1];

    return mb_substr($first[0], 0, 1).''.mb_substr($last[0], 0, 1);
}

function initialsAll($query)
{
    $name = explode(' ', trim($query));

    $first = $name[0];
    if (count($name) - 1 > 0) {
        $last = $name[count($name) - 1];
        return mb_substr($first[0], 0, 1).''.mb_substr($last[0], 0, 1);
    }

    if (auth()->user()->current_project_id) {
        return mb_substr($first[0], 0, 1);
    } else {
        return null;
    }
}

function bytesToHuman($bytes): string
{
    $units = ['B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

    $step = 1024;
    $i = 0;
    while (($bytes / $step) > 0.9) {
        $bytes /= $step;
        $i++;
    }

    return round($bytes, 2).' '.$units[$i];
}

function allFileSize($path)
{
    $fileSize = 0;
    foreach (File::allFiles(public_path($path)) as $file) {
        $fileSize += $file->getSize();
    }

    return bytesToHuman($fileSize);
}

function replaceStrToLower($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return strtolower(str_replace($search, $replace, $item));
}

function replaceStrToUpper($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return strtoupper(str_replace($search, $replace, $item));
}

function replaceBlank($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', '-'];

    return str_replace($search, $replace, $item);
}

function replaceBlankMinus($item): string
{
    $search = ['Ä', 'Ö', 'Ü', 'ä', 'ö', 'ü', 'ß', '´', ' ', '-', '_'];
    $replace = ['Ae', 'Oe', 'Ue', 'ae', 'oe', 'ue', 'ss', '', '-', ' ', '-'];

    return str_replace($search, $replace, $item);
}

function replaceImagesDatei($item): string
{
    $search = ['.jpg', '.jpeg', '.gif', '.png', '.tiff', '.raw', '.psd', '.JPG', '.JPEG', '.GIF', '.PNG', '.TIFF', '.RAW', '.PSD'];
    $replace = [''];

    return str_replace($search, $replace, $item);
}

function image($image, $path)
{
    if (! $image) {
        return null;
    }

    $path = replaceBlank($path);
    $name = getName($image, $path);

    $image = Image::make($image->getRealPath())->encode('webp', 75)->stream();

    File::put(public_path($path.$name), $image);

    return $path.$name;
}

function getName($image1, $path): string
{
    $img = ImageManagerStatic::make($image1)->encode('webp', 75);
    $name = Str::random(40).'.webp';

    if (File::exists(public_path($path))) {
        File::delete(public_path($path));
    }

    if (! File::isDirectory(public_path($path))) {
        File::makeDirectory(public_path($path), 0777, true, true);
    }

    return $name;
}
