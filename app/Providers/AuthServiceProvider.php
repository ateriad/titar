<?php

namespace App\Providers;

use App\Models\Advertisement;
use App\Models\Event;
use App\Models\Image;
use App\Models\User;
use App\Models\Video;
use App\Policies\AdvertisementPolicy;
use App\Policies\EventPolicy;
use App\Policies\ImagePolicy;
use App\Policies\UserPolicy;
use App\Policies\VideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Video::class => VideoPolicy::class,
        Event::class => EventPolicy::class,
        Image::class => ImagePolicy::class,
        User::class => UserPolicy::class,
        Advertisement::class => AdvertisementPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function (User $user, $permission, array $models = null) {
            if ($user->isSuperAdmin()) {
                return true;
            }

            if ($models === null) {
                return $user->hasPermission($permission);
            }

            return null;
        });

        Gate::define('indexLogs', "App\Policies\LogPolicy@index");
        Gate::define('indexReport', "App\Policies\ReportPolicy@index");
        Gate::define('indexPayment', "App\Policies\PaymentPolicy@index");
    }
}
