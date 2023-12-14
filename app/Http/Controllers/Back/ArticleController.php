<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\File;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy("created_at", "asc")->get();
        return view("back.articles.index", compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::orderBy('created_at', 'asc')->get();
        return view('back.articles.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3|required',
            'image' => 'required|mimes:jpeg,png,jpg|max:4096',

        ]);
        $article = new Article;
        $article->title = $request->title;
        $article->slug = str_slug($request->title);
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->status = $request->status;
        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = $imageName;
        }
        ;
        $article->save();
        return redirect()->route('admin.articles.index')->with('success', 'Makale Başarılı Bir Şeklide Oluşturuldu.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::orderBy('created_at', 'asc')->get();
        $article = Article::findOrFail($id);
        return view('back.articles.update', compact('category', 'article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3|required',
            'image' => 'mimes:jpeg,png,jpg|max:4096',

        ]);
        $article = Article::findOrFail($id);
        $article->title = $request->title;
        $article->slug = str_slug($request->title);
        $article->category_id = $request->category;
        $article->content = $request->content;
        $article->status = $request->status;
        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $article->image = $imageName;
        }
        ;
        $article->save();
        return redirect()->route('admin.articles.index')->with('success', 'Makale Başarılı Bir Şeklide Güncellendi.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $id;
    }

    public function delete($id)
    {
        Article::findOrFail($id)->delete();
        return redirect()->route('admin.articles.index')->with('success', 'Makale Başarılı Bir Şeklide Geri Dönüşüm Kuttusuna Gönderildi.');

    }

    public function switch (Request $request)
    {
        $article = Article::findOrFail($request->id);
        $article->status = $request->statu==="true" ? 1 : 0;
        $article->save();
    }


    

    public function removed(){
        $articles = Article::onlyTrashed()->orderBy('deleted_at', 'asc')->get();
        return view("back.articles.removed", compact('articles'));
     
    }

public function recover($id){
    Article::onlyTrashed()->find($id)->restore();
    return redirect()->back()->with('success', 'Makale Başarılı Bir Şeklide Kurtarıldı.');
}

public function hardDelete($id)
{
    $article=Article::onlyTrashed()->find($id);
    if(File::exists('uploads/'.$article->image)){
        File::delete(public_path('uploads/'.$article->image));
    }
  $article->forceDelete();
   return redirect()->route('admin.articles.index')->with('success', 'Makale Başarılı Bir Şeklide Silindi.');

}
}
