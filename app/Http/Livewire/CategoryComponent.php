<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;
class CategoryComponent extends Component
{
    public $sorting;
    public $pagesize;
    public $category_slug;
    public $categoryChildren;
    public $popular_products;
    public function mount($category_slug){
        $this->sorting = "default";
        $this->pagesize = 12;
        $this->category_slug = $category_slug;
        //$this->fill(request()->only('search','product_cat','product_cat_id'));
    }
    public function store($product_id,$product_name,$product_price)
    {
        Cart::add($product_id,$product_name,1,$product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    
    }

    private function getLatest(){
        $categories = Category::all();
        $latestProducts = [];
        foreach ($categories as $category) {
            // Retrieve the latest product for each category
            $latestProduct = $category->products()->latest()->first();

            if ($latestProduct) {
                $latestProducts[] = $latestProduct;
            }
        }
        return $latestProducts;
    }

    use WithPagination;
    public function render()
    {
        $category = Category::where('slug',$this->category_slug)->first();
        $category_id = $category->id;
        $category_name = $category->name;
        if($this->sorting == 'date'){
            $products = Product::where('category_id',$category_id)->orderBy('created_at','desc')->paginate($this->pagesize);
        }
        else if ($this->sorting=='price')
        {
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','asc')->paginate($this->pagesize);
        }
        else if ($this->sorting=='price-desc'){
            $products = Product::where('category_id',$category_id)->orderBy('regular_price','desc')->paginate($this->pagesize);
        }
        else{
            $products = Product::where('category_id',$category_id)->paginate($this->pagesize);
        }
        $products = $category->allProducts();
        $categories = Category::where('parent_id', null)->get();
        $this->popular_products = $this->getLatest();
        $this->categoryChildren = $category->children;
        return view('livewire.category-component',['products'=>$products,'categories'=>$categories,'category_name'=>$category_name])->layout('layouts.base');
    }
}
