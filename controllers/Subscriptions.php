<?php

namespace Fytinnovations\UserConnect\Controllers;

use BackendMenu;
use Backend\Classes\Controller;
use Flash;
use Lang;
use DB;
use Fytinnovations\UserConnect\Models\Subscription;

/**
 * Subscriptions Back-end Controller
 */
class Subscriptions extends Controller
{
    public $implement = ['Backend.Behaviors.ListController', 'Backend.Behaviors.ImportExportController'];

    public $importExportConfig = 'config_import_export.yaml';

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('Fytinnovations.UserConnect', 'userconnect', 'subscriptions');
    }

    /**
     * Deleted checked subscriptions.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $subscriptionId) {
                if (!$subscription = Subscription::find($subscriptionId)) continue;
                $subscription->delete();
            }

            Flash::success(Lang::get('fytinnovations.userconnect::lang.subscriptions.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fytinnovations.userconnect::lang.subscriptions.delete_selected_empty'));
        }

        return $this->listRefresh();
    }

    public function index()
    {
        $this->vars['verified_subscriptions'] = Subscription::verified()->count();
        $this->vars['unverified_subscriptions'] = Subscription::unverified()->count();

        $datesOfOngoingWeek = [];

        for ($i = 0; $i < 7; $i++) {
            array_push($datesOfOngoingWeek, date('Y-m-d', strtotime("- {$i} day")));
        }

        $currentWeekSubscriptions = Subscription::whereIn(DB::raw('date(created_at)'), $datesOfOngoingWeek)->get();

        $grouped_subscriptions = $currentWeekSubscriptions->groupBy(function ($subcriber) {
            return $subcriber->created_at->format('Y-m-d');
        });

        foreach ($datesOfOngoingWeek as $date) {
            if (!isset($grouped_subscriptions[$date])) {
                $grouped_subscriptions[strtotime($date)] = collect();
            } else {
                $grouped_subscriptions[strtotime($date)] = $grouped_subscriptions[$date];
                unset($grouped_subscriptions[$date]);
            }
        }

        $graph_array = [];

        foreach ($grouped_subscriptions as $key => $subscription) {

            $array = [$key * 1000, count($subscription)];

            array_push($graph_array, $array);
        }

        //Convert the array into a string which can be passed to the view graph
        $this->vars['line_graph'] = substr(json_encode($graph_array), 1, -1);
        $this->asExtension('ListController')->index();
    }
}
