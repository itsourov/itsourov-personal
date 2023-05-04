<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Settings\SiteSettings;
use Livewire\Component;
use Livewire\WithFileUploads;


class ManageSiteSettings extends Component
{
    use WithFileUploads;

    public $siteSettings;
    public $message;




    public function render()
    {
        return view('livewire.admin.settings.manage-site-settings');
    }

    public function mount(SiteSettings $siteSettings)
    {
        $this->siteSettings = $siteSettings->toArray();

    }

    protected function rules()
    {
        return [

            'siteSettings.site_title' => 'required',
            'siteSettings.site_tagline' => 'required',
            'siteSettings.site_description' => 'required',



        ];
    }


    public function save(siteSettings $settings)
    {
        $this->message = null;
        $this->validate();
        $settings->site_title = $this->siteSettings['site_title'];
        $settings->site_tagline = $this->siteSettings['site_tagline'];
        $settings->site_description = $this->siteSettings['site_description'];
        $settings->save();

        if ($this->siteSettings['site_logo'] ?? false) {


        }

        cache()->forget('siteSettings');
        $this->message = "Settings Updated";
    }
}