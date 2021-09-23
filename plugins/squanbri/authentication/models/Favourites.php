<?php namespace Squanbri\Authentication\Models;

use Model;
use Request;
/**
 * Model
 */
class Favourites extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'squanbri_authentication_favorites';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

    public function getFavourites($email) {
        return Favourites::where('email', $email)->get();
    }

    public function addFavourite($email, $type, $target_id) {
        $favourit = Favourites::where('email', $email)->where('type', $type)->where('target_id', $target_id)->get();

        if (!isset($favourit[0])) {
            $favourit = new Favourites;
            $favourit->type = $type;
            $favourit->target_id = $target_id;
            $favourit->email = $email;
            $favourit->save();
        }
    }

    public function removeFavourite($email, $type, $target_id) {
        $favourit = Favourites::where('email', $email)->where('type', $type)->where('target_id', $target_id);
        
        if (!isset($favourit->id)) {
            $favourit->delete();
        }
    }

    public function checkSelfFavourite($email, $type, $target_id) {
        if (isset(Favourites::where('email', $email)->where('type', $type)->where('target_id', $target_id)->first()['target_id'])) {
            return true;
        }
        return  false;
    }
}
