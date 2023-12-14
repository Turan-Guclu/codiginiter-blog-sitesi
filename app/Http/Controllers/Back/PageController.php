<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view("back.pages.index", compact('pages'));
    }


    
    public function status (Request $request)
    {
        $page =Page::findOrFail($request->id);
        $page->status = $request->statu==="true" ? 1 : 0;
        $page->save();
    }

    public function create()
    {
        return view("back.pages.create", compact('pages'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3|required',
            'image' => 'required|mimes:jpeg,png,jpg|max:4096',
        ]);
        $last=Page::orderBy('order','DESC')->first('order');
        $page = new Page;
        $page->title = $request->title;
        $page->slug = str_slug($request->title);
        $page->content = $request->content;
        $page->order= intval($last->order)+1;
        $page->status = $request->status;
        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = $imageName;
        };

        $page->save();
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa Başarılı Bir Şeklide Oluşturuldu.');
    }

    public function edit($id)
    {

        $page = Page::findOrFail($id);
        return view('back.pages.update', compact('page'));
    }

 
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'min:3|required',
            'image' => 'mimes:jpeg,png,jpg|max:4096',

        ]);
        $page = Page::findOrFail($id);
        $page->title = $request->title;
        $page->slug = str_slug($request->title);
        $page->content = $request->content;
        $page->status = $request->status;
        if ($request->hasFile('image')) {
            $imageName = str_slug($request->title) . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $page->image = $imageName;
        };
        $page->save();
        return redirect()->route('admin.pages.index')->with('success', 'Sayfa Başarılı Bir Şeklide Güncellendi.');
    }


    public function delete($id)
{
    $page=Page::findOrFail($id);
    if(File::exists('uploads/'.$page->image)){
        File::delete(public_path('uploads/'.$page->image));
    }
  $page->forceDelete();
   return redirect()->route('admin.pages.index')->with('success', 'Sayfa Başarılı Bir Şeklide Silindi.');

}


public function orders(Request $request){

    foreach($request->get('page') as $key=>$order){
        Page::where('id',$order)->update(['order'=>$key]);
    }
}
}
