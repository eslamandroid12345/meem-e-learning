<?php

namespace App\Http\Controllers\Dashboard\Cart;

use App\Http\Controllers\Controller;
use App\Http\Services\Dashboard\Carts\CartService;
use App\Http\Services\Mutual\ExportService;
use App\Repository\CartRepositoryInterface;
use App\Repository\CourseBookRepositoryInterface;
use App\Repository\CourseRepositoryInterface;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartRepositoryInterface $cartRepository;
    private CourseRepositoryInterface $courseRepository;
    private CartService $cartService;
    private ExportService $export;

    public function __construct(CartRepositoryInterface $cartRepository, CourseRepositoryInterface $courseRepository , CartService $cartService , ExportService $export){
        $this->cartRepository = $cartRepository;
        $this->courseRepository = $courseRepository;
        $this->cartService = $cartService;
        $this->export = $export;

        $this->middleware('permission:carts-read')->only('index' , 'show');
    }

    public function index(){
        $courses = $this->courseRepository->getAll(['id' , 'name_ar' , 'name_en']);
        $carts = $this->cartRepository->getLeftCarts()->paginate(25);
        return view('dashboard.site.carts.index' , ['carts' => $carts , 'courses' => $courses]);
    }

    public function show($id){
        $cart = $this->cartRepository->getById($id , ['*'] , ['user' , 'items']);
        return view('dashboard.site.carts.show' , ['cart' => $cart]);
    }


    public function export(string $type)
    {
        $carts = $this->cartRepository->getLeftCarts()->get();
        $data = [
            'carts' => $carts
        ];

        return $this->export->handle('carts', 'dashboard.site.carts.export', $data, 'carts', $type);
    }
}
