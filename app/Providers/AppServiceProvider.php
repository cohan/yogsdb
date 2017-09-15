<?php

namespace App\Providers;

use Auth;
use Horizon;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider {
	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot() {
		//
		Schema::defaultStringLength(191);

		Horizon::auth(function ($request) {
				if (Auth::user()) {
					$user = Auth::user();
					if ($user->email == "cohan@icnerd.com") {
						return true;
					}
				}

				return false;
			});
	}

	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register() {
		//
		if ($this->app->environment() == 'local') {
			$this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
		}

	}
}
