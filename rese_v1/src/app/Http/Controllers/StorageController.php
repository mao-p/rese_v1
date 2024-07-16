<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class StorageController extends Controller
{
    public function store(Request $request)
    {
        // ファイルのバリデーションを行う
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MBまでのjpeg、png、jpg、gifファイルを許可
        ]);

        // アップロードされたファイルを取得
        $image = $request->file('image');

        // ファイル名を生成（例：timestamp_image.jpg）
        $imageName = time() . '_' . $image->getClientOriginalName();

        // 画像を指定のディレクトリに保存
        $image->storeAs('public/images', $imageName);

        // 画像の情報を保存
        $imageModel = new Image();
        $imageModel->path = $imageName;
        $imageModel->restaurant_id = $request->restaurant_id; // レストランのIDを関連付ける
        $imageModel->save();

        // フラッシュメッセージを設定
        return redirect()->back()->with('success', '画像がアップロードされました。')->with('image_path', 'storage/images/' . $imageName);
    }
}