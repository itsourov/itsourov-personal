<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SiteSettings extends Settings
{

    public string $site_title;
    public string $site_tagline;
    public string $site_description;
    public bool $site_active;
    public static function group(): string
    {
        return 'siteSettings';
    }
}