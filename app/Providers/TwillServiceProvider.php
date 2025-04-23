<?php

namespace App\Providers;

use A17\Twill\Facades\TwillAppSettings;
use A17\Twill\Facades\TwillConfig;
use A17\Twill\Facades\TwillNavigation;
use A17\Twill\Services\Settings\SettingsGroup;
use A17\Twill\View\Components\Navigation\NavigationLink;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class TwillServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        TwillConfig::maxRevisions(5);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        URL::defaults(['locale' => locale()]);

        /**
         * Settings
         */
        TwillAppSettings::registerSettingsGroups(
            SettingsGroup::make()
                ->name('site')
                ->label('Splošno'),
        );

        /**
         * Public posts - mews
         */
        TwillNavigation::addLink(
            NavigationLink::make()
                ->forModule('news')
                ->title('Aktualno')
                ->doNotAddSelfAsFirstChild()
                ->setChildren([
                    NavigationLink::make()
                        ->forModule('news')
                        ->title('Novice')
                        ->setChildren([
                            NavigationLink::make()
                                ->forModule('newsCategories')
                                ->title('Kategorije'),
                        ]),
                ]),
        );
    }
}
