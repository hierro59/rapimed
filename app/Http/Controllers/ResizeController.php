<?php

namespace App\Http\Controllers;

use App\Models\UserUploadImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ResizeController extends Controller
{

    public function index()
    {
        return view('home');
    }
    public function resizeImage(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ]);

        $type = ($request->type == 'avatar' ? 'avatar' : 'portada');

        $user = Auth::user()->id;
        $code = bin2hex(random_bytes(10));

        $image = $request->file('file');
        $input['file'] = $type . '-' . $user . '-' . $code . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail/profile');
        $imgFile = Image::make($image->getRealPath());
        if ($type == 'avatar') {
            $imgFile->fit(400)->save($destinationPath . '/' . $input['file']);
            //$imgFile->save($destinationPath . '/' . $input['file']);
        } else {
            $imgFile->fit(900, 200)->save($destinationPath . '/' . $input['file']);
        }
        //$destinationPath = public_path('/uploads');
        //$image->move($destinationPath, $input['file']);
        $saveDB = [
            'customer_id' => $user,
            'type' => $type,
            'image_name' => $input['file']
        ];

        UserUploadImages::create($saveDB);

        return back()
            ->with('success', 'Image has successfully uploaded.')
            ->with('fileName', $input['file']);
    }

    public function uploadAvatarImage(Request $request)
    {
        $type = 'avatar';

        $user = Auth::user()->id;
        $code = bin2hex(random_bytes(10));

        $image = $request->file('file');
        $input['file'] = $type . '-' . $user . '-' . $code . '.' . $image->getClientOriginalExtension();

        $destinationPath = public_path('/thumbnail/profile');
        $imgFile = Image::make($image->getRealPath());
        if ($type == 'avatar') {
            $imgFile->fit(400)->save($destinationPath . '/' . $input['file']);
            //$imgFile->save($destinationPath . '/' . $input['file']);
        } else {
            $imgFile->fit(900, 200)->save($destinationPath . '/' . $input['file']);
        }
        //$destinationPath = public_path('/uploads');
        //$image->move($destinationPath, $input['file']);
        $saveDB = [
            'customer_id' => $user,
            'type' => $type,
            'image_name' => $input['file']
        ];

        UserUploadImages::create($saveDB);

        return true;
    }
}
