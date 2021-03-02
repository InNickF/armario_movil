<?php

namespace App\Widgets;

use App\Models\Category;
use Arrilot\Widgets\AbstractWidget;

class ParentCategoryMenu extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'categoryId' => null
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $categories = Category::orderBy('order', 'asc')->parents()->get();

        $selectedCategory = Category::find($this->config['categoryId']);

        $subcategories = null;
        if($selectedCategory) {
            if($selectedCategory->parent_id == null) { // Only show subcategories if selected is parent of parents
                $subcategories = Category::where('parent_id', $selectedCategory->id)->get();
            } else {
                $subcategories = Category::where('parent_id', $selectedCategory->parent_id)->get();
            }
        }


        return view('widgets.parent_category_menu', [
            'config' => $this->config,
            'categories' => $categories,
            'subcategories' => $subcategories,
            'active' => $selectedCategory
        ]);
    }
}
