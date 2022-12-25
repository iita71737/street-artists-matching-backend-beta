<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;
use App\Http\Services\CartService;
use App\Http\Repositories\CartRepository;

class CartController extends Controller
{
    protected $cartService;
    protected $cartRepository;
    // public function __construct(CartService $cartService, CartRepository $cartRepository)
    // {
    //     $this->cartService = $cartService;
    //     $this->cartRepository = $cartRepository;
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        // $cart = $this->cartRepository->scopeBelongsUser($user)->firstOrCreate(['user_id' => $user->id]);
        $cart = Cart::with(['cartItems'])->where('user_id', $user->id)
                                        ->where('checkouted', false)
                                        ->firstOrCreate(['user_id' => $user->id]);
        
        return response($cart);
    }
 
    public function checkout()
    {
        $user = auth()->user();
        // $cart = $this->cartRepository->scopeChecked($user)->first();
        $cart = $user->carts()->where('checkouted', false)->with('cartItems')->first();
        if ($cart) {
            // $result = $this->cartService->checkout($cart);
            $result = $cart->checkout();
            return response(['result' => $result]);
        } else {
            return response('empty cart', 400);
        }
    }
}
