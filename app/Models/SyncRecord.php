<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SyncRecord extends Model
{
    protected $table = 'DSyncDownloadUploadStatus';
    protected $guarded=[];
    public $timestamps = false;
}
