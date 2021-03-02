<?php

// Controller
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Rinvex\Subscriptions\Models\Plan;
use Rinvex\Subscriptions\Models\PlanFeature;

class SettingsController extends Controller
{

    // you can override following methods from trait

    // to display the settings view
    public function index()
    {
        $settings = setting()->all();

        // * Set defaults
        // $plans = Plan::all();
        // foreach ($plans as $key => $plan) {
        //     if (!isset($settings[$plan->slug . '_commission_percentage'])) {
        //         $settings[$plan->slug . '_commission_percentage'] = Plan::where('slug', $plan->slug )->first()->features->firstWhere('name', 'commission_percentage')->value;
        //     }
        // }

        // dd($settings);


        return view('admin.settings', compact('settings'));
    }
    // to store settings changes
    public function update(Request $request)
    {
        $input = $request->all();
        // dd($input);

        // Get the store instance
        // setting();

        // Get values
        // setting('foo');
        // setting('foo.bar');
        // setting('foo', 'default value');
        // setting()->get('foo');

        // Set values
        foreach ($input as $key => $fieldValue) {
            if (strpos($key, '_token') !== false) {
                // * Dont save csrf token
                continue;
            }

            if (strpos($key, 'image') !== false || strpos($key, 'icon') !== false) {
                // *If IMAGE jsut get path
                if ($fieldValue) {
                    if (!isset(json_decode($fieldValue)->manuallyAdded) || !json_decode($fieldValue)->manuallyAdded) {
                        setting([
                            $key =>  url('storage/' . json_decode($fieldValue)->path)
                        ]);
                    }
                }
                continue;
            }

            // Handle plan commissions in PlanFeature model directly
            if (strpos($key, '_commission_percentage') !== false) {

                if ($fieldValue) {
                    // get slug from SLUG_commission_percentage
                    $slug = explode('_', $key)[0];
                    $plan = Plan::where('slug', $slug)->with('features')->first();

                    $feature = $plan->features->firstWhere('name', 'commission_percentage');
                    $feature->value = $fieldValue;
                    $feature->save();
                }
            }

            if (strpos($key, 'footer_links_column_') !== false) {
                // *If IMAGE jsut get path
                $formatted = collect(json_decode($fieldValue))->toArray();

                if ($fieldValue) {
                    setting([
                        $key =>  $formatted
                    ]);
                }
                continue;
            }

            // * Plain data
            setting([$key => $fieldValue]);
            // setting(['foo.bar' => 'baz']);
            // setting()->set('foo', 'bar');
        }

        // Method chaining
        // setting(['foo' => 'bar'])->save();

        // save settings
        // $appSettings->save($request);

        Cache::clear();
        alert()->success('Ajustes actualizados');
        return redirect('/admin/settings');
    }
}