<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        view()->composer('Client.Layout.menu', function ($view) {

            $data = Category::join('subcategories', 'categories.id', 'subcategories.id_category')
                            ->where('categories.status', 1)
                            ->where('subcategories.status', 1)
                            ->select(
                                'categories.id',
                                'categories.name',
                                'categories.icon',
                                'subcategories.name as sub_name',
                                'subcategories.slug as sub_slug',
                            )
                            ->get()
                            ->groupBy('id');

            $ds_menu = [];

            foreach ($data as $items) {
                $menu = [
                    'name'          => $items[0]->name,
                    'icon'          => $items[0]->icon,
                    'subcategories' => [],
                ];

                foreach ($items as $sub) {
                    $menu['subcategories'][] = [
                        'sub_name' => $sub->sub_name,
                        'sub_slug' => $sub->sub_slug,
                    ];
                }

                $ds_menu[] = $menu;
            }

            $view->with('ds_menu', $ds_menu);
        });
    }
}
