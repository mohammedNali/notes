<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
//        Gate::define('update-note', function (User $user, Note $note) {
//            return $user->id === $note->user_id;
//        });

        Gate::define('update-note', function (User $user, Note $note) {
            return $user->id === $note->user_id
                ? Response::allow()
//                : Response::denyAsNotFound();
//                : Response::denyWithStatus(404);
                : Response::deny("You Are Not Allowed To Update Mustafa's Note");
        });
    }
}
