<?
namespace AdminKacana;

use Illuminate\Support\Facades\Auth;

class Util {
    public static function getCurrentUser(){
        return Auth::user();
    }
}