<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Quotation;

class Celline extends Model
{

    protected $fillable=['name'];

    public function datasets()
    {
        return $this->belongsToMany('App\Dataset');
    }

    public function vanderbilts()
    {
        return $this->belongsToMany('App\Vanderbilt');
    }

    public function citbcmsts()
    {
        return $this->belongsToMany('App\Citbcmst');
    }

    public function expressionlevels()
    {
        return $this->hasManyThrough('App\Expressionlevel', 'App\Celline_dataset');
    }

     public function enrichementscores()
    {
        return $this->hasManyThrough('App\Enrichementscore','App\Celline_dataset');
    }


    public static function liste_cell_dataset() 
    //Plus besoin de faire les jointures à la main après, y penser !
    {
    	$data = DB::table('cellines')
            ->join('cellinedatasets', 'cellines.id', '=', 'cellinedatasets.cellines_id')
            ->join('datasets', 'datasets.id', '=', 'cellinedatasets.datasets_id')
            ->select('cellines.id','cellines.name', 'cellines.replicate', DB::raw('group_concat(datasets.name SEPARATOR ", ") as list_dataset'))
            ->groupBy('cellines.id')
            ->get();
            //->toJson();
           // var_dump($data);
           // exit;

    	return $data;
    }

    //public static function infos_cell_lines() {
    //	$datum = DB::table
    //}

    public static function query_data()
    {
        #$query = DB::table('cellines')->select('name as value') ->get()->toJson();
    }


}

