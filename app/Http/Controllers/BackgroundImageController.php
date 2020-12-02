<?php

namespace App\Http\Controllers;

use App\Models\BackgroundImage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BackgroundImageController extends Controller
{
    public function index()
    {
        $rows = BackgroundImage::all();

        return view('background_image.index', compact('rows'));
    }

    
    public function create()
    {
        return view('background_image.create');
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $file = request()->file('file');
        $extensions = $file->getClientOriginalExtension();
        $folder = 'background_image';

        $randomFileName = Str::random(20);
        $newName = $randomFileName . '.' . $extensions;
        $file->move($folder, $newName);

        BackgroundImage::create([
            'title' => request('title'),
            'file' => $newName
        ]);

        noty()->flash('Yeay!', 'Data has been created successfully');
        return redirect()->route('background_images.index');
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        $row = BackgroundImage::find($id);
        return view('background_image.edit', compact('row'));
    }

   
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'file' => 'required|image'
        ]);

        $row = BackgroundImage::find($id);

        if(request()->hasFile('file')) {
            $file = request()->file('file');
            $folder = 'background_image';
            
            unlink($folder. '/' . $row->file);
                
            $extensions = $file->getClientOriginalExtension();

            $randomFileName = Str::random(20);
            $newName = $randomFileName . '.' . $extensions;
            $file->move($folder, $newName);

            $row->file = $newName;
        }

        $row->title = request('title');
        $row->save();


        noty()->flash('Yeay!', 'Data has been updated successfully');
        return redirect()->route('background_images.index');
    }

    
    public function destroy($id)
    {
        $row = BackgroundImage::find($id);

        $folder = 'background_image';
        unlink($folder. '/' . $row->file);

        $row->delete();

        noty()->flash('Yeay!', 'Data has been deleted successfully');
        return redirect()->route('background_images.index');
    }
}
