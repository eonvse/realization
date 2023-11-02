<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;
    protected $fillable = ['author_id','initiator_id','name','content','zni','dateZni','doi','dateDoi','isDone','dateDone'];
    protected $primaryKey = 'id';

    public function initiator()
    {
        return $this->hasOne(Initiator::class,'id','initiator_id');
    }

}
