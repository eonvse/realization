<?php

namespace App\Data;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

use App\Models\Cluster;
use App\Models\Initiator;


class ClusterData
{
	public static function indexWire($data)
	{	

        if (!empty($data['sortField'])) $zni=Cluster::orderBy($data['sortField'],$data['sortDirection']);
        else $zni = Cluster::orderBy('zni','desc');

        if(!empty($data['search'])){
           $zni->orWhere('name','like',"%".$data['search']."%");
           $zni->orWhere('surname','like',"%".$data['search']."%");
           $zni->orWhere('patronymic','like',"%".$data['search']."%");
        }


		return $zni;
	}

	public static function getInitiatorsList()
	{
		return Initiator::orderBy('name')->get();
	}

	public static function create($data)
	{
		$initiator = Initiator::where('name','=',$data['initiator'])->first();
		if (empty($initiator)) $initiator = Initiator::create(['name'=>$data['initiator']]);
		$dataForCreate = array(
            'name'=>$data['name'],
            'content'=>$data['content'],
            'author_id'=>Auth::id(),
            'initiator_id'=>$initiator->id,
            'zni'=>$data['zni'],
            'dateZni'=>$data['dateZni'],
            'doi'=>!empty($data['doi']) ? $data['doi'] : NULL,
            'dateDoi'=>!empty($data['dateDoi']) ? $data['dateDoi'] : NULL
		);

		Cluster::create($dataForCreate);
	}
}