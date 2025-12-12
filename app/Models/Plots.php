<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plots extends Model
{
    protected $table = 'plots';
    protected $fillable = [
        'sector','street_number','plot_number','reg_no','plot_size','uri','plot_price','status','deleted_at' 
    ];
}
