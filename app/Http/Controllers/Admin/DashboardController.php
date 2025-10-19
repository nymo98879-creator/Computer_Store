<?php



namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
public function index(){

return view("admin.dashboard");
}
    public function count()
    {
        $totalProduct = Product::count();
$totalCategories=Category::count();
$totalCustomer=Customer::count();
        return view('admin.dashboard', compact('totalProduct',"totalCategories","totalCustomer"));
    }


}
