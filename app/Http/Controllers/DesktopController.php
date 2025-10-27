<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class DesktopController extends Controller
{
    public function index()
    {
        // Fetch the desktop category along with its related products
        $category = Category::where('name', 'desktop')
            ->with('products')
            ->firstOrFail(); // ✅ ensures it fetches only one result and throws 404 if not found

        // Pass it to the view
        return view('FrontEnd.fcategory.desktop', compact('category'));
    }
}
