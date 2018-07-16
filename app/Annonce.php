<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $desc
 * @property string $photo
 * @property string $price
 * @property int $id_author
 * @property string $created_at
 * @property string $updated_at
 */
class Annonce extends Model
{
   
    /**
     * @var array
     */
    protected $fillable = ['title', 'desc', 'photo', 'price', 'id_author', 'created_at', 'updated_at'];

}
