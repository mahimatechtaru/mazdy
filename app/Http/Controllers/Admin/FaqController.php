<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Frontend\FaqCategory;
use App\Models\Frontend\FaqItem;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FaqController extends Controller
{
    // ===========================================
    //               FAQ CATEGORY CRUD
    // ===========================================

    /**
     * Display a listing of the FAQ categories. (READ)
     */
    public function categoryIndex()
    {
        // Fetch all categories ordered by their display_order
        $categories = FaqCategory::orderBy('display_order', 'asc')->get();

        // Return the view for managing categories
        return view('admin.faq.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category. (CREATE)
     */
    public function categoryCreate()
    {
        return view('admin.faq.categories.create');
    }

    /**
     * Store a newly created category in storage. (CREATE)
     */
    public function categoryStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|unique:faq_categories,slug|max:100',
            'display_order' => 'nullable|integer|min:0',
        ]);

        $category = FaqCategory::create([
            'name' => $request->name,
            // Slug field is optional, if null, a common practice is to auto-generate it
            'slug' => $request->slug ?? \Str::slug($request->name),
            'display_order' => $request->display_order ?? (FaqCategory::max('display_order') + 1),
        ]);

        return redirect()->route('admin.faq.category.index')
                         ->with('success', 'FAQ Category created successfully!');
    }

    /**
     * Show the form for editing the specified category. (UPDATE)
     */
    public function categoryEdit(FaqCategory $category)
    {
        return view('admin.faq.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage. (UPDATE)
     */
    public function categoryUpdate(Request $request, FaqCategory $category)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            // Ensure the slug is unique, but ignore the current category's slug
            'slug' => ['nullable', 'string', 'max:100', Rule::unique('faq_categories', 'slug')->ignore($category->id)],
            'display_order' => 'nullable|integer|min:0',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => $request->slug ?? \Str::slug($request->name),
            'display_order' => $request->display_order,
        ]);

        return redirect()->route('admin.faq.category.index')
                         ->with('success', 'FAQ Category updated successfully!');
    }

    /**
     * Remove the specified category from storage. (DELETE)
     */
    public function categoryDestroy(FaqCategory $category)
    {
        // PREVENT DELETION: Check if the category has associated items
        if ($category->items()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete category: Please reassign or delete the associated FAQ items first.');
        }
        
        $category->delete();

        return redirect()->route('admin.faq.category.index')
                         ->with('success', 'FAQ Category deleted successfully!');
    }


    // ===========================================
    //                 FAQ ITEM CRUD
    // ===========================================

    /**
     * Display a listing of the FAQ items. (READ)
     */
    public function itemIndex()
    {
        // Fetch items ordered by category then by item sort_order
        $items = FaqItem::with('category')->orderBy('category_id')->orderBy('sort_order', 'asc')->get();
        $categories = FaqCategory::orderBy('name', 'asc')->get();
        // Return the view for managing items
        return view('admin.sections.FAQs.index', compact('items','categories'));
    }

    /**
     * Show the form for creating a new FAQ item. (CREATE)
     */
    public function itemCreate()
    {
        // Need categories to assign the item
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.faq.items.create', compact('categories'));
    }

    /**
     * Store a newly created FAQ item in storage. (CREATE)
     */
    public function itemStore(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        FaqItem::create([
            'category_id' => $request->category_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order ?? (FaqItem::where('category_id', $request->category_id)->max('sort_order') + 1),
            'is_published' => $request->is_published ?? false,
        ]);

        return redirect()->route('admin.sections.FAQs.index')
                         ->with('success', 'FAQ Item created successfully!');
    }

    /**
     * Show the form for editing the specified FAQ item. (UPDATE)
     */
    public function itemEdit(FaqItem $item)
    {
        // Need categories for the dropdown selector
        $categories = FaqCategory::orderBy('name')->get();

        return view('admin.faq.items.edit', compact('item', 'categories'));
    }

    /**
     * Update the specified FAQ item in storage. (UPDATE)
     */
    public function itemUpdate(Request $request, FaqItem $item)
    {
        $request->validate([
            'category_id' => 'required|exists:faq_categories,id',
            'question' => 'required|string|max:500',
            'answer' => 'required|string',
            'sort_order' => 'nullable|integer|min:0',
            'is_published' => 'boolean',
        ]);

        $item->update([
            'category_id' => $request->category_id,
            'question' => $request->question,
            'answer' => $request->answer,
            'sort_order' => $request->sort_order,
            // Cast 'is_published' to a boolean correctly
            'is_published' => $request->has('is_published') ? true : false, 
        ]);

        return redirect()->route('admin.faq.item.index')
                         ->with('success', 'FAQ Item updated successfully!');
    }

    /**
     * Remove the specified FAQ item from storage. (DELETE)
     */
    public function itemDestroy(FaqItem $item)
    {
        $item->delete();

        return redirect()->route('admin.faq.item.index')
                         ->with('success', 'FAQ Item deleted successfully!');
    }
}