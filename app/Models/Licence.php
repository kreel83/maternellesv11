<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Laravel\Cashier\Subscription;

class Licence extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'parent_id',
        'stripe_id',
        'expires_at',
        'name'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    private function getInternalName()
    {
        $name = uniqid();
        if ($this->internalNameExists($name)) {
            return $this->getInternalName();
        }
        return $name;
    }

    private function internalNameExists($name) {
        $existsInLicences = Licence::where('name', $name)->exists();
        $existsInSubscriptions = Subscription::where('name', $name)->exists();
        if($existsInLicences || $existsInSubscriptions) {
            return true;
        }
        return false;
    }

    public function createUserLicence($quantity, $stripe_id, $expires_at)
    {
        for($i = 0; $i < $quantity; $i++) {
            Licence::create([
                'parent_id' => Auth::id(),
                'stripe_id' => $stripe_id,
                'name' => $this->getInternalName(),
                'expires_at' => $expires_at
            ]);
        }
    }

    public function assignLicenceToUser($request, $user_id, $status)
    {        
        Licence::where('id', $request->licence_id)
               ->where('parent_id', Auth::id())
               ->update([
                    'user_id' => $user_id,
                    'status' => $status
                ]);

        /*
        Licence::where('id', $request->licence_id)
               ->where('parent_id', Auth::id())
               ->update(['user_id' => $request->user_id]);
        */
    }

    public function removeLicenceToUser($id)
    {
        Licence::where('id', $id)
               ->where('parent_id', Auth::id())
               ->update([
                    'user_id' => null,
                    'status' => null
                ]);
    }
}
