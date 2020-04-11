<?php

namespace Fytinnovations\UserConnect\Controllers;

use BackendMenu;
use  Fytinnovations\UserConnect\Models\Subscriber;
use DB;

class Subscribers extends \Backend\Classes\Controller
{

    public $implement = ['Backend.Behaviors.ListController', 'Backend.Behaviors.ImportExportController'];

    public $importExportConfig = 'config_import_export.yaml';

    public $listConfig = 'list_config.yaml';

    public $guarded = ['modifyForLineGraph'];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Fytinnovations.UserConnect', 'userconnect', 'subscribers');
    }

    public function index()
    {
        $this->vars['verified_subscribers'] = Subscriber::verified()->count();
        $this->vars['unverified_subscribers'] = Subscriber::unverified()->count();

        $datesOfOngoingWeek = [];

        for ($i = 0; $i < 7; $i++) {
            array_push($datesOfOngoingWeek, date('Y-m-d', strtotime("- {$i} day")));
        }

        $currentWeekSubscribers = Subscriber::whereIn(DB::raw('date(created_at)'), $datesOfOngoingWeek)->get();

        $grouped_subscribers = $currentWeekSubscribers->groupBy(function ($subcriber) {
            return $subcriber->created_at->format('Y-m-d');
        });

        foreach ($datesOfOngoingWeek as $date) {
            if (!isset($grouped_subscribers[$date])) {
                $grouped_subscribers[strtotime($date)] = collect();
            } else {
                $grouped_subscribers[strtotime($date)] = $grouped_subscribers[$date];
                unset($grouped_subscribers[$date]);
            }
        }

        $graph_array = [];

        foreach ($grouped_subscribers as $key => $subscriber) {

            $array = [$key * 1000, count($subscriber)];

            array_push($graph_array, $array);
        }

        //Convert the array into a string which can be passed to the view graph
        $this->vars['line_graph'] = substr(json_encode($graph_array), 1, -1);
        $this->asExtension('ListController')->index();
    }
}
