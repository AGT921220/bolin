<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Delivery;
use App\Order;
use App\Language;
use App\Text;
use App\Item;
use App\Plan;
use App\Store;
use App\StorePlan;

class StoreCategoryController extends Controller
{

	public function index(Request $request)
	{

		$res = Category::select('*');
		$storeId = $request->input('store_id');
		if ($storeId) {
			$res
				->where('store_id', $storeId)
				->orderBy('sort_no', 'ASC');
		}
		$categories = $res->get();
		return $categories;
		//		return View($this->folder.'index',['data' => $res->getAll(),'link' => env('store').'/category/']);

	}
	public function store(Request $request)
	{
		$category = new Category();
		$category->name = $request->input('category_name');
		$category->store_id = $request->input('user_id');
		$category->save();
		return $category->id;
	}
}
