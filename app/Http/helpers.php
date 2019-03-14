<?php

use App\Category;
use App\Item;
use App\SubCategory;
use App\User;

/**
 * Created by IntelliJ IDEA.
 * User: pawankumar
 * Date: 30/11/18
 * Time: 12:52 AM
 */

function get_item_details($itemId,$fieldName)
{
    $details = Item::where('id',$itemId)->value($fieldName);

    return $details;
}

function get_user_details($userId,$fieldName)
{
    $details = User::where('id',$userId)->value($fieldName);

    return $details;
}

/**
 * @return mixed
 * @description dashboard details
 */

function category_count()
{
    $categorycount = Category::count();

    return $categorycount;
}

function sub_category_count()
{
    $subcategorycount = SubCategory::count();

    return $subcategorycount;
}

function total_items()
{
    $totalitems = Item::count();

    return $totalitems;
}

function get_category_name($category_id)
{
    $count = Category::where('id',$category_id)->count();
    if($count > 0)
    {
        $categoryName = Category::where('id',$category_id)->value('category_name');

        return $categoryName;
    }else{
        return '-';
    }


}
