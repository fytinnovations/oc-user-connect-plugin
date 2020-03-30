<?php

namespace Fytinnovations\UserConnect\Controllers;
use BackendMenu;
use  Fytinnovations\UserConnect\Models\Subscriber;
use DB;
class Subscribers extends \Backend\Classes\Controller {

    public $implement = ['Backend.Behaviors.ListController','Backend.Behaviors.ImportExportController'];

    public $importExportConfig = 'config_import_export.yaml';
    
    public $listConfig = 'list_config.yaml';

    public $guarded= ['modifyForLineGraph'];

    public function __construct(){
        parent::__construct();
        BackendMenu::setContext('Fytinnovations.UserConnect', 'userconnect', 'subscribers');
    }

    public function index()
    {
        $this->vars['verified_subscribers'] = Subscriber::verified()->count();
        $this->vars['unverified_subscribers'] = Subscriber::unverified()->count();
        $weekly_subcribers = DB::table('fytinnovations_userconnect_subscribers')
            ->select(DB::raw('UNIX_TIMESTAMP(date(created_at)) as date'))
            ->where('created_at', '>', date('Y-m-d', strtotime('-7 days')))
            ->get();

        $grouped_subscribers = $weekly_subcribers->groupBy('date');
        $graph_array = [];
        foreach ($grouped_subscribers as $key => $subcriber) {
            $array = [$key * 1000, count($subcriber)];
            array_push($graph_array, $array);
        }

        //Convert the array into a string which can be passed to the view graph
        $this->vars['line_graph'] = substr(json_encode($graph_array), 1, -1);
        $this->asExtension('ListController')->index();
    }

}

?>
