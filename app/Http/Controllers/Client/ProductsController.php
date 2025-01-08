<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Transactions;
use App\Models\User;
use App\Utils\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use PhpOption\None;

class ProductsController extends Controller
{
    protected $product;

    public function __construct (Product $product) {
        $this->product = $product;
    }

    public function index(Request $request) {
        $role = $request->session()->get('role');
        if ($role !== "user") {
            return redirect()->route('adminDashboard');
        }

        $products = $this->product->get_products_latest();
        $context = [
            "products" => $products
        ];
        return view("index", $context);
    }

    public function singleUserProduct(Request $request, $id) {
        $role = $request->session()->get('role');
        if ($role !== "user") {
            return redirect()->route('adminDashboard');
        }

        $product = Products::find($id);
        $context = [
            "product" => $product
        ];
        return view("singleUserProduct", $context);
    }

    public function productSorting(Request $request, $price) {
        $role = $request->session()->get('role');
        if ($role !== "user") {
            return redirect()->route('adminDashboard');
        }

        if ($price === "0") {
            // $products = Products::orderByRaw('CAST(price AS UNSIGNED) ASC')->paginate(3);
            $products = Products::orderByRaw('CAST(price as DECIMAL(8,2)) ASC')->paginate(3);
        }
        else if ($price === "1") {
            $products = Products::orderByRaw('CAST(price as DECIMAL(8,2)) DESC')->paginate(3);
        }

        $context = [
            "products" => $products
        ];
        return view("index", $context);
    }

    public function userPurchasingProcess(Request $request, $id) {
        $request->validate([
            'userId' => 'required',
        ]);

        try {
            $product = Products::find($id);
            $currentQuantity = $product->quantityAvailable;
            if ($currentQuantity <= 0) {
                return Redirect::back()->withErrors(['msg' => 'No Quantity Available!']);
            }
            else {
                $product->quantityAvailable = $currentQuantity - 1;
                $product->save();
            }
            $transaction = Transactions::create([
                'userId' => Auth::user()->id,
                'productId' => $id,
            ]);
            $this->loggingTransactions($request, $transaction);
        }
        catch (\Exception $e) {
            $this->loggingTransactions($request, $e);
            return Redirect::back()->withErrors(['msg' => 'Please purchase again!']);
        }
        return redirect()->route('index')->with('success', 'Successfully Purchased!');
    }

    public function loggingTransactions(Request $request, $message) {
        Log::info($message);
    }

    public function adminDashboard(Request $request) {
        $role = $request->session()->get('role');
        if ($role !== "admin") {
            return redirect()->route('index');
        }

        $products = Products::all();
        $context = [
            "products" => $products
        ];
        return view("adminDashboard", $context);
    }

    public function adminDashboardUser(Request $request) {
        $role = $request->session()->get('role');
        if ($role !== "admin") {
            return redirect()->route('index');
        }

        $users = User::all();
        $context = [
            "users" => $users
        ];
        return view("adminDashboardUser", $context);
    }

    public function adminDashboardTransaction(Request $request) {
        $role = $request->session()->get('role');
        if ($role !== "admin") {
            return redirect()->route('index');
        }

        $transations = Transactions::all();
        $context = [
            "transations" => $transations
        ];
        return view("adminDashboardTransaction", $context);
    }

    public function post_ui(Request $request) {
        $role = $request->session()->get('role');
        if ($role !== "admin") {
            return redirect()->route('index');
        }

        return view("product.create");
    }

    public function post_product(Request $request) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantityAvailable' => 'required'
        ]);

        try {
            if (str_contains($request->price, '-') || str_contains($request->quantityAvailable, '-')) {
                return Redirect::back()->withErrors(['msg' => 'Something wrong! Please create again!']);
            }
            $decimal_price = (float) $request->price;
            $product = Products::create([
                'name' => $request->name,
                'price' => $decimal_price,
                'quantityAvailable' => $request->quantityAvailable
            ]);
        }
        catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => 'Please create again!']);
        }
        return redirect()->route('adminDashboard');
    }

    public function put_ui(Request $request, $id) {
        $role = $request->session()->get('role');
        if ($role !== "admin") {
            return redirect()->route('index');
        }
        
        $product = Products::find($id);
        if (!$product) {
            return redirect()->route('adminDashboard');
        }
        $context = [
            "product" => $product
        ];
        return view("product.update", $context);
    }

    // included to implement for updating product quantity
    public function put_product(Request $request, $id) {
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'quantityAvailable' => 'required'
        ]);

        try {
            if (str_contains($request->price, '-') || str_contains($request->quantityAvailable, '-')) {
                return Redirect::back()->withErrors(['msg' => 'Something wrong! Please create again!']);
            }
            $decimal_price = (float) $request->price;
            $product = Products::find($id);
            $created_product = $product->update([
                'name' => $request->name,
                'price' => $decimal_price,
                'quantityAvailable' => $request->quantityAvailable
            ]);
        }
        catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => 'Something wrong! Please update again!']);
        }
        return redirect()->route('adminDashboard');
    }

    public function delete_product(Request $request, $id) {
        try {
            $product = Products::find($id);
            $product->delete();
        }
        catch (\Exception $e) {
            return Redirect::back()->withErrors(['msg' => 'Please delete again!']);
        }
        return redirect()->route('adminDashboard');
    }
}
