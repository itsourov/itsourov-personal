<?php

namespace App\Providers;

use App\Enums\UserRole;

use Livewire\Component;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::preventLazyLoading(!app()->isProduction());
        Blade::if ('admin', function () {
            return auth()?->user()?->role === UserRole::admin;
        });

        Builder::macro('toCsv', function () {
            $results = $this->get();

            if ($results->count() < 1)
                return;

            $titles = implode(',', array_keys((array) $results->first()->getAttributes()));

            $values = $results->map(function ($result) {
                return implode(',', collect($result->getAttributes())->map(function ($thing) {
                    return '"' . $thing . '"';
                })->toArray());
            });

            $values->prepend($titles);

            return $values->implode("\n");
        });



        Component::macro('notify', function ($message, $type = 'info') {
            $this->dispatchBrowserEvent('notify', ['message' => $message, 'type' => $type]);
        });
        Component::macro('flash', function ($message, $type = 'info') {
            session()->flash('notify', ['message' => $message, 'type' => $type]);
        });

        /* additional macro for easy accessing flash sessions */
        \Illuminate\Http\RedirectResponse::macro('withNotification', function ($message, $type = 'info') {
            return $this->with('notify', ['message' => $message, 'type' => $type]);
        });
    }
}