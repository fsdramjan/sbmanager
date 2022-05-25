<?php

namespace App\Http\Controllers\Backend\MainMenu;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {
    public function category() {
        $categories = Category::withCount('subcategories')->paginate(50);

        return view('backend.main_menu.category.index', compact('categories'));
    }

    public function createCategory() {
        return view('backend.main_menu.category.create');
    }

    public function storeCategory(Request $request) {
        $validator = Validator::make($request->all(), [
            'name'  => 'required|unique:categories',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/category/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name    = $img_gen . '.' . $image_ext;
                $final_image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
            }

        }

        $category           = new Category();
        $category->name     = $request->name;
        $category->image    = $final_image;
        $category->status   = 1;
        $category->on_front = 0;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category added successfully!!');
    }

    public function editCategory($id) {
        $category = Category::where('id', $id)->first();

        return view('backend.main_menu.category.edit', compact('category'));
    }

    public function updateCategory(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:categories,name,' . $id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        if ($validator->fails()) {
            return back()->with('toast_error', $validator->messages()->all())->withInput();
        }

        $category = Category::findOrFail($id);

        if ($request->hasFile('image')) {

            $image_file = $request->file('image');

            if ($image_file) {

                if ($category->image) {
                    $image_image_path = public_path($category->image);
        
                    if (File::exists($image_image_path)) {
                        File::delete($image_image_path);
                    }
        
                }

                $img_gen   = hexdec(uniqid());
                $image_url = 'images/category/';
                $image_ext = strtolower($image_file->getClientOriginalExtension());

                $img_name       = $img_gen . '.' . $image_ext;
                $image = $image_url . $img_gen . '.' . $image_ext;

                $image_file->move($image_url, $img_name);
                $category->update(['image' => $image]);
            }

        }

        $category->update([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.category')->withToastSuccess('Category updated successfully!!');
    }

    public function activeCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->status = 1;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category activated successfully!!');
    }

    public function inactiveCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->status = 0;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category inactivated successfully!!');
    }

    public function onFrontCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->on_front = 1;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category added to main menu successfully!!');
    }

    public function removeOnFrontCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->on_front = 0;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category remove from main menu successfully!!');
    }

    public function onFrontPageCourseCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->on_front_page = 1;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category courses added to front page successfully!!');
    }

    public function removeOnFrontPageCourseCategory(Request $request, $id) {
        $category = Category::findOrFail($id);

        $category->on_front_page = 0;
        $category->save();

        return redirect()->route('admin.category')->withToastSuccess('Category courses remove from front page successfully!!');
    }

}
