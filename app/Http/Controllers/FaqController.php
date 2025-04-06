<?php
namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index(Request $request)
{
    $query = Faq::query();

    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where('question', 'like', "%{$search}%")
              ->orWhere('answer', 'like', "%{$search}%");
    }

    $faqs = $query->get()->groupBy('category');

    return view('faq.index', compact('faqs'));
}


    public function create()
    {
        return view('faq.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::create($request->all());
        return redirect()->route('faq.index')->with('success', 'FAQ added successfully.');
    }

    public function edit($id)
    {
        $faq = Faq::findOrFail($id);
        return view('faq.edit', compact('faq'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
        ]);

        Faq::findOrFail($id)->update($request->all());
        return redirect()->route('faq.index')->with('success', 'FAQ updated successfully.');
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();
        return redirect()->route('faq.index')->with('success', 'FAQ deleted successfully.');
    }
}

