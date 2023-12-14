<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Article;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        return view("back.categories.index",compact("categories"));
    }


    public function create(Request $request){
       $isExist=Category::whereSlug(str_slug($request->category))->first();
       if($isExist){
        return redirect()->back()->withErrors($request->category.' Adında Bir Kategori Zaten Mevcut.');
       }else{
        $category = new Category;
        $category->name= $request->category;
        $category->slug = str_slug($request->category);
        $category->save();
       }
        return redirect()->back()->with('success', 'Kategori Başarılı Bir Şeklide Oluşturuldu.');
    }

    
    public function update(Request $request){
         $category = Category::findOrFail($request->id);
         $category->name= $request->category;
         $category->slug = str_slug($request->category);
         $category->save();
        
         return redirect()->back()->with('success', 'Kategori Başarılı Bir Şekilde Güncellendi.');
     }

    public function getData(Request $request){
        $category = Category::findOrFail($request->id);
        return response()->json($category);
    }



    public function delete(Request $request){
        $category = Category::findOrFail($request->id);
        $count=$category->articleCount();
        $defaultCategory= Category::find(1);
        if($category->id===1){
            return redirect()->back()->withErrors($request->category.' Adında Bir Kategori Silinemez.');
        }
        if($count>0){
            Article::where('category_id',$category->id)->update(['category_id'=>1]);
            $category->delete();
            return redirect()->back()->with('success', 'Kategori Başarılı Bir Şekilde Silindi. ve Bu Kategoriye ait '.$count.' makale '.$defaultCategory->name.' Kategorisine Taşındı. ');
       
        }else{
            $category->delete();
            return redirect()->back()->with('success', 'Kategori Başarılı Bir Şekilde Silindi.');
       
        }
             
   }
    public function status(Request $request)
    {
        $category = Category::findOrFail($request->id);
        $category->status = $request->statu==="true" ? 1 : 0;
        $category->save();
    }
}
