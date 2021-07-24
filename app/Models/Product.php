<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Catagory;

class Product extends Model
{
    use HasFactory;

    public static function getCatName($CatGroup)
    {
        $arrCat = explode(",",$CatGroup); 
        $cat = Catagory::select('catagory')->whereIn('id', $arrCat)->get();
        $nCat = array();
        foreach($cat as $row){
            $nCat[] = $row->catagory;
        }
        $catagory = implode(", ",$nCat);
        return $catagory;
    }

    public static function getPrice($id)
    {
        $Price = Product::select('price')->where('id', $id)->first();
        return $Price;
    }

}
