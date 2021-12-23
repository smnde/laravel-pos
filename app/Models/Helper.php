<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Helper extends Model
{
    use HasFactory;

    public function autocode($val, $long)
    {
        $invoice = '';
        for($i = 0; $i < ($long - strlen($val)); $i++) {
            $invoice .= '0';
        }
        return $invoice . $val;
    }
}
