<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperClasseUser
 */
class ClasseUser extends Model
{
    use HasFactory;

    
    protected $table = "classe_users";

    public function classe() {
        return $this->hasOne('App\Models\Classe','id','classe_id');
    }

}
