<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 商品一覧・検索・並び替え
    public function index(Request $request)
    {
        $query = Product::query();

        // 🔍 検索
        if ($request->filled('keyword')) {
            $query->where('name', 'like', '%' . $request->keyword . '%');
        }

        // 🔽 並び替え（価格順）
        if ($request->filled('sort')) {
            $query->orderBy('price', $request->sort);
        }

        $products = $query->paginate(6);

        return view('products.index', [
            'products' => $products,
            'keyword' => $request->keyword,
            'sort' => $request->sort
        ]);
    }

    // 商品登録フォーム
    public function create()
    {
        return view('products.create');
    }

    // 商品詳細
    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        return view('products.show', compact('product'));
    }

    //商品更新
    public function update(Request $request, $productId)
    {
        // 🔍 対象の商品を取得
    $product = Product::findOrFail($productId);

    // ✅ バリデーション（エラーメッセージつき）
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|integer|min:0',
        'description' => 'required|string',
        'season' => 'required|array|min:1',
        'season.*' => 'in:春,夏,秋,冬',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ], [
        'name.required' => '商品名を入力してください。',
        'price.required' => '値段を入力してください。',
        'price.integer' => '値段は数値で入力してください。',
        'description.required' => '商品説明を入力してください。',
        'season.required' => '季節を1つ以上選択してください。',
        'image.image' => '画像ファイルを選択してください。',
        'image.mimes' => '画像はjpgまたはpng形式でアップロードしてください。',
    ]);

    // ✅ seasonをカンマ区切りで保存（例："春,夏"）
    $validated['season'] = implode(',', $validated['season']);

    // ✅ 画像がアップロードされた場合
    if ($request->hasFile('image')) {
        // 古い画像を削除
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // 新しい画像を保存
        $imagePath = $request->file('image')->store('products', 'public');
        $validated['image'] = $imagePath;
    }

    // ✅ 商品情報を更新
    $product->update($validated);

    // ✅ 完了後、詳細ページにリダイレクト
    return redirect()
        ->route('products.show', $productId)
        ->with('success', '商品情報を更新しました！');
    }


    // 商品削除
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', '商品を削除しました。 ');
    }
}
