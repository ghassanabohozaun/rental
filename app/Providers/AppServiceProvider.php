<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\TenantService::class, function ($app) {
            return new \App\Services\TenantService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        // Dynamic Flasher Position (Check URL segment as fallback if locale is not yet set by middleware)
        $currentLocale = request()->segment(1);
        if (!in_array($currentLocale, ['ar', 'en'])) {
            $currentLocale = app()->getLocale();
        }

        $position = $currentLocale == 'ar' ? 'top-left' : 'top-right';

        // Update configuration for multiple adapters
        config([
            // Default flasher (notyf/native)
            'flasher.options.position' => $position,

            // SweetAlert2
            'flasher.plugins.sweetalert.position' => $currentLocale == 'ar' ? 'top-start' : 'top-end',

            // Toastr (if used)
            'flasher.plugins.toastr.positionClass' => 'toast-' . $position,
        ]);

        // super user
        Gate::before(function ($user, $ability) {
            if ($user->id === 1 || $user->role_id === 1) {
                return true;
            }
        });

        $modules = config('global.modules');
        $operations = config('global.crud_operations');

        if ($modules && $operations) {
            foreach ($modules as $moduleKey => $moduleLangKey) {
                // Register a base gate for the module (e.g., 'roles') to check if user has ANY permission in it
                Gate::define($moduleKey, function ($auth) use ($moduleKey, $operations) {
                    foreach (array_keys($operations) as $opKey) {
                        if ($auth->hasAbility($moduleKey . '_' . $opKey)) {
                            return true;
                        }
                    }
                    return false;
                });

                // Register detailed CRUD gates (e.g., 'roles_read', 'roles_create')
                foreach (array_keys($operations) as $opKey) {
                    $ability = $moduleKey . '_' . $opKey;
                    Gate::define($ability, function ($auth) use ($ability) {
                        return $auth->hasAbility($ability);
                    });
                }
            }
        }

        \Illuminate\Http\Request::macro('hasValidSignature', function ($absolute = true) {
            if ('livewire/upload-file' || 'livewire/preview-file' == request()->path()) {
                return true;
            }
            return \Illuminate\Support\Facades\URL::hasValidSignature($this, $absolute);
        });
    }
}
