<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Str;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $input = request()->input('sort');
        if($input=='name') $images =  Image::orderBy('filename','asc')->get();
        elseif($input=='date') $images =  Image::orderBy('created_at','asc')->get();
        else $images = Image::all();
        return view('index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    if($request->hasFile('images')) {
        $request->validate([
            'images' => 'required|array|max:5',
            'images.*' => 'mimes:jpeg,png,jpg,gif'
        ],[
            'images.max'=> 'Максимальное количество картинок для загрузки 5',
            'images.*.mimes'=>'Изображение должен быть картинком формате jpeg, png, jpg, gif'
        ]);

        foreach($request->file('images') as $image) {

            $imag= Str::transliterate($image->getClientOriginalName());
    
            $imageName = strtolower(str_replace(' ', '_', $imag));
            $check = Image::where('filename', $imageName)->get()[0] ?? null;

            if(!empty($check)) $imageName = time() . '_' . strtolower(str_replace(' ', '_', $imag));
            
            while(file_exists(public_path('images/' . $imageName))) {
                $imageName = time() . '_' . strtolower(str_replace(' ', '_', $image->getClientOriginalName()));
            }
            
            $image->move(storage_path('app/public/images'), $imageName);
            
            Image::create([
                'filename' => $imageName,
            ]);
        }
        return redirect('images')->with('message', 'Изображение успешно добавлено!'); 
    } 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $filename = Image::find($id);
        $filename->delete();
        $path = storage_path() . 'app/public/images/' . $filename->filename;
        if (file_exists($path)) {
            unlink($path);
        }
        return redirect()->route('images.index')->with('message','Успешно удалено!');
    }

    public function download()
    {
        $files = storage_path('app/public/images/*');
        $zipname = 'images.zip';
        
        $zip = new \ZipArchive;
        $zip->open($zipname, \ZipArchive::CREATE);
        
        foreach (glob($files) as $file) {
            $zip->addFile($file);
        }
        
        $zip->close();
        
        return response()->download($zipname);
    }
}