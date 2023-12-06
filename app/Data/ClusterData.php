<?php

namespace App\Data;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Builder;

use App\Models\Cluster;
use App\Models\Initiator;
use App\Models\File;


class ClusterData
{
	public static function indexWire($data)
	{	

        if (!empty($data['sortField'])) $zni=Cluster::orderBy($data['sortField'],$data['sortDirection']);
        else $zni = Cluster::orderBy('zni','desc');

        if (!empty($data['filter']['year'])) $zni->whereYear('dateZNI',$data['filter']['year']);
        if (!empty($data['filter']['status'])) $zni->where('isDone','=',$data['filter']['status']-1);


        if(!empty($data['search'])){
           $zni->where('zni','like',"%".$data['search']."%");
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

	public static function update($id,$data)
	{
		$initiator = Initiator::where('name','=',$data['initiator'])->first();
		if (empty($initiator)) $initiator = Initiator::create(['name'=>$data['initiator']]);
		$dataForUpdate = array(
            'name'=>$data['name'],
            'content'=>$data['content'],
            'author_id'=>Auth::id(),
            'initiator_id'=>$initiator->id,
            'dateZni'=>$data['dateZni'],
            'doi'=>!empty($data['doi']) ? $data['doi'] : NULL,
            'dateDoi'=>!empty($data['dateDoi']) ? $data['dateDoi'] : NULL
		);

		Cluster::find($id)->update($dataForUpdate);
	}

	public static function get($id)
	{
		return Cluster::find($id);
	}

	public static function destroy($id)
	{
		Cluster::find($id)->delete();
	}

	public static function executed($id)
	{
		$dataForUpdate = array(
					'isDone'=>1,
					'dateDone'=>date('Y-m-d')
			);
		Cluster::find($id)->update($dataForUpdate);
	}

	public static function getFileList($id)
	{
		return File::where('cluster_id','=',$id)->orderBy('name')->get();
	}

	public static function saveFile($data)
	{
		$data['author_id']=Auth::id();

		File::create($data);
	}

   public static function deleteFile($fileId)
   {
    	$del=File::find($fileId);
    	Storage::disk('public')->delete($del->url);
    	$del->delete();
   }

   public static function getFileArray($fileId)
   {
    	return File::where('id','=',$fileId)->get(['id','name','url'])->first()->toArray();
   }

   public static function getYearsZNI()
   {
		return DB::table('ZNI_year')
            ->pluck('yearZni')
            ->toArray();
   }


}