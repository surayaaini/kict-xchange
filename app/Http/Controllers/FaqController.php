<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;



class FaqController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // If search exists, filter FAQs
        $faqs = Faq::when($search, function ($query, $search) {
            return $query->where('question', 'like', '%' . $search . '%')
                        ->orWhere('answer', 'like', '%' . $search . '%')
                        ->orWhere('category', 'like', '%' . $search . '%');
        })->get();

        // Group by category
        $groupedFaqs = $faqs->groupBy('category');

        return view('faq.index', compact('groupedFaqs'));
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

    public function admin()
    {
        // Only allow Admins
        if (auth()->user()->role_id !== 1) {
            abort(403, 'Unauthorized');
        }

        $faqs = Faq::latest()->get();
        return view('faq.admin', compact('faqs'));
    }


}
