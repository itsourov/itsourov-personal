<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {
    public function up(): void
    {
        $this->migrator->add('siteSettings.site_title', 'Website Title');
        $this->migrator->add('siteSettings.site_tagline', 'My New Website');
        $this->migrator->add('siteSettings.site_description', 'A very cool website');
        $this->migrator->add('siteSettings.site_active', true);
    }
};