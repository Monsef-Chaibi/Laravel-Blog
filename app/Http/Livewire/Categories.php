<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use Livewire\Component;
use Illuminate\Support\Str;

class Categories extends Component
{
    protected $listeners = [
        "deleteCategoryAction",
        "deleteSubCategoryAction",
        "updateCategoryOrdering",
        "updateSubCategoryOrdering"
    ];

    public $category_name;
    public $selected_category_id;
    public $updateCategoryMode = false;

    public $subcategory_name;
    public $parent_category = 0;
    public $selected_subcategory_id;
    public $updateSubCategoryMode = false;

    public function addCategory()
    {
        $this->validate([
            "category_name" => "required|unique:categories,category_name"
        ]);

        $category = new Category();
        $category->category_name = $this->category_name;
        $saved = $category->save();

        if ($saved) {
            toastr()->success('New Category has been successfully added');
            $this->category_name = null;
            $this->dispatchBrowserEvent('hideCategoryModal');
        } else {
            toastr()->error('Somthing Went Wrong..!');
        }
    }

    public function editCategory($id)
    {
        $category = Category::findOrFail($id);
        $this->selected_category_id = $category->id;
        $this->category_name = $category->category_name;
        $this->updateCategoryMode = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updateCategory()
    {
        if ($this->selected_category_id) {
            $this->validate([
                "category_name" => 'required|unique:categories,category_name,' . $this->selected_category_id
            ]);
            $category = Category::findOrFail($this->selected_category_id);
            $category->category_name = $this->category_name;
            $updated = $category->save();

            if ($updated) {
                $this->dispatchBrowserEvent('hideCategoryModal');
                toastr()->success('Category has been successfully updated');
                $this->updateCategoryMode = false;
            } else {
                toastr()->error('Somthing Went Wrong..!');
            }
        }
    }

    public function addSubCategory()
    {
        $this->validate([
            "parent_category" => 'required',
            "subcategory_name" => 'required|unique:sub_categories,subcategory_name',
        ]);

        $subcategory =  new SubCategory();
        $subcategory->subcategory_name = $this->subcategory_name;
        $subcategory->slug = Str::slug($this->subcategory_name);
        $subcategory->parent_category = $this->parent_category;
        $saved = $subcategory->save();

        if ($saved) {
            toastr()->success('New Sub-Category has been successfully added');
            $this->subcategory_name = null;
            $this->parent_category = null;
            $this->dispatchBrowserEvent('hideSubCategoryModal');
        } else {
            toastr()->error('Somthing Went Wrong..!');
        }
    }

    public function editSubCategory($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $this->selected_subcategory_id = $subcategory->id;
        $this->parent_category = $subcategory->parent_category;
        $this->subcategory_name = $subcategory->subcategory_name;
        $this->updateSubCategoryMode = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function resetInputForm()
    {
        $this->resetErrorBag();
        $this->category_name = null;
        $this->subcategory_name = null;
        $this->parent_category = null;
        $this->resetValidation();
    }

    public function updateSubCategory()
    {
        if ($this->selected_subcategory_id) {
            $this->validate([
                "subcategory_name" => 'required|unique:sub_categories,subcategory_name,' . $this->selected_subcategory_id
            ]);
            $subcategory = SubCategory::findOrFail($this->selected_subcategory_id);
            $subcategory->subcategory_name = $this->subcategory_name;
            $subcategory->parent_category = $this->parent_category;
            $subcategory->slug = Str::slug($this->subcategory_name);
            $updated = $subcategory->save();

            if ($updated) {
                $this->dispatchBrowserEvent('hideCategoryModal');
                toastr()->success('SubCategory has been successfully updated');
                $this->updateCategoryMode = false;
            } else {
                toastr()->error('Somthing Went Wrong..!');
            }
        }
    }

    public function deleteCategory($id)
    {
        $category = Category::find($id);
        $this->dispatchBrowserEvent("deleteCategory", [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $category->category_name . '</b> category.',
            'id' => $id,
        ]);
    }

    public function deleteCategoryAction($id)
    {
        $category = Category::where('id', $id)->first();
        $subcategories = SubCategory::where('parent_category', $category->id)->whereHas('posts')->with('posts')->get();
        if (!empty($subcategories) && count($subcategories) > 0) {
            $totalPosts = 0;
            foreach ($subcategories as $subcategory) {
                $totalPosts += Post::where('category_id', $subcategory->id)->get()->count();
            }
            toastr()->warning('This category has (' . $totalPosts . ') posts related to it, cannot be deleted.');
        } else {
            SubCategory::where('parent_category', $category->id)->delete();
            $category->delete();
            toastr()->success('Category has been successfully deleted.');
        }
    }

    public function deleteSubCategory($id)
    {
        $subcategory = SubCategory::find($id);
        $this->dispatchBrowserEvent("deleteSubCategory", [
            'title' => 'Are you sure?',
            'html' => 'You want to delete <b>' . $subcategory->category_name . '</b> category.',
            'id' => $id,
        ]);
    }

    public function deleteSubCategoryAction($id)
    {
        $subcategory = SubCategory::where('id', $id)->first();
        $posts = Post::where('category_id', $subcategory->id)->get()->toArray();
        if (!empty($posts) && count($posts) > 0) {
            toastr()->warning('This subcategory has (' . count($posts) . ') posts related to it, cannot be deleted.');
        } else {
            $subcategory->delete();
            toastr()->info('SubCategory has been successfully deleted.');
        }
    }

    public function updateCategoryOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            Category::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        toastr()->success('Categories ordering have been successfully updated.');
    }

    public function updateSubCategoryOrdering($positions)
    {
        foreach ($positions as $position) {
            $index = $position[0];
            $newPosition = $position[1];
            SubCategory::where('id', $index)->update([
                'ordering' => $newPosition
            ]);
        }
        toastr()->success('SubCategories ordering have been successfully updated.');
    }

    public function render()
    {
        return view('livewire.categories', [
            "categories" => Category::orderby('ordering', "ASC")->get(),
            "subcategories" => SubCategory::orderby('ordering', "ASC")->get()
        ]);
    }
}
