<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InboundStudent;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;

class InboundStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = InboundStudent::query();

        // Search logic
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('program_type', 'like', '%' . $request->search . '%')
                ->orWhere('received_date', 'like', '%' . $request->search . '%')
                ->orWhere('program', 'like', '%' . $request->search . '%');
            });
        }

        // Sortable columns
        $sortable = ['full_name', 'university_origin', 'program', 'program_type', 'responsible_lecturer', 'duration', 'received_date', 'departure_date'];
        $sort = $request->get('sort');
        $direction = $request->get('direction') === 'desc' ? 'desc' : 'asc';

        if (in_array($sort, $sortable)) {
            $query->orderBy($sort, $direction);
        } else {
            $query->orderBy('received_date', 'desc'); // default sort
        }

        $students = $query->get();

        $count = $students->count();

        return view('admin.inbound.index', compact('students', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.inbound.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'university_origin' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'program_type' => 'required|string|max:255',
            'responsible_lecturer' => 'required|string|max:255',
            'duration_value' => 'required|integer|min:1',
            'duration_unit' => 'required|string|in:day,week,month',
            'received_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:received_date',
        ]);

        InboundStudent::create([
            'full_name' => $request->input('full_name'),
            'university_origin' => $request->input('university_origin'),
            'program' => $request->input('program'),
            'program_type' => $request->input('program_type'),
            'responsible_lecturer' => $request->input('responsible_lecturer'),
            'duration_value' => $request->input('duration_value'),
            'duration_unit' => $request->input('duration_unit'),
            'received_date' => $request->input('received_date'),
            'departure_date' => $request->input('departure_date'),
        ]);


        return redirect()->route('inbounds.index')->with('success', 'Inbound student added successfully.');
    }

    private function parseDate($value)
{
    try {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value);
        } else {
            return new \DateTime($value);
        }
    } catch (\Exception $e) {
        return null; // or you could log the error
    }
}

    // Show Excel import form
    public function showImportForm()
    {
        return view('admin.inbound.import');
    }

    // Handle Excel import
    public function importExcel(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);

        $file = $request->file('excel_file');

        try {
            $spreadsheet = IOFactory::load($file->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Skip header row
            foreach (array_slice($rows, 1) as $row) {
                if (empty($row[0])) {
                    continue; // skip if no full name
                }

                // Safe date parsing
                $receivedDate = $this->parseDate($row[7]);
                $departureDate = $this->parseDate($row[8]);

                InboundStudent::create([
                    'full_name'             => $row[0],
                    'university_origin'     => $row[1],
                    'program'               => $row[2],
                    'program_type'          => $row[3],
                    'responsible_lecturer'  => $row[4],
                    'duration_value'        => (int) $row[5],
                    'duration_unit'         => strtolower(trim($row[6])),
                    'received_date'         => $receivedDate,
                    'departure_date'        => $departureDate,
                ]);
            }

            return redirect()->route('inbounds.index')->with('success', 'Inbound students imported successfully.');

        } catch (\Throwable $e) {
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    /**public function edit(string $id)
    {
        $student = InboundStudent::findOrFail($id);
        return view('admin.inbound.edit', compact('student'));
    }*/

    /**
     * Update the specified resource in storage.
     */
    /**public function update(Request $request, string $id)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'university_origin' => 'required|string|max:255',
            'program' => 'required|string|max:255',
            'program_type' => 'required|string|max:255',
            'responsible_lecturer' => 'required|string|max:255',
            'duration' => 'required|string|max:255',
            'received_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:received_date',
        ]);

        $student = InboundStudent::findOrFail($id);
        $student->update($request->all());

        return redirect()->route('inbound-students.index')->with('success', 'Inbound student updated successfully.');
    }*/

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $student = InboundStudent::findOrFail($id);
        $student->delete();

        return redirect()->route('inbounds.index')->with('success', 'Inbound student deleted successfully.');
    }


}
