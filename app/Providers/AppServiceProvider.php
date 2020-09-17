<?php

namespace App\Providers;


use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Add this custom validation rule.
        Validator::extend('alpha_spaces', function ($attribute, $value) {

            // This will only accept alpha and spaces.
            // If you want to accept hyphens use: /^[\pL\s-]+$/u.
            return preg_match('/^[\pL\s-]+$/u', $value);

        });

        Validator::extend('cif', function($attribute, $value){
            if(!is_int($value)){
                $value = strtoupper($value);
                if(strpos($value, 'RO') === 0){
                    $value = substr($value, 2);
                }
                $value = (int) trim($value);
            }
            if(strlen($value) > 10 || strlen($value) < 2){
                return false;
            }
            $v = 753217532;
            $c1 = $value % 10;
            $value = (int) ($value / 10);
            $t = 0;
            while($value > 0){
                $t += ($value % 10) * ($v % 10);
                $value = (int) ($value / 10);
                $v = (int) ($v / 10);
            }
            $c2 = $t * 10 % 11;
            if($c2 == 10){
                $c2 = 0;
            }
            return $c1 === $c2;
        });
    }
}
