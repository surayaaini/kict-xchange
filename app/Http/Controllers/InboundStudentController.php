<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InboundStudent;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

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
            'received_date' => 'required|date',
            'departure_date' => 'required|date|after_or_equal:received_date',
        ]);

        $received = Carbon::parse($request->received_date);
        $departure = Carbon::parse($request->departure_date);

        $duration = $received->diffInDays($departure);

        $student = new InboundStudent();
        $student->full_name = $request->full_name;
        $student->university_origin = $request->university_origin;
        $student->program = $request->program;
        $student->program_type = $request->program_type;
        $student->responsible_lecturer = $request->responsible_lecturer;
        $student->received_date = $received;
        $student->departure_date = $departure;
        $student->duration_value = $duration;
        $student->duration_unit = 'days'; // or customize later
        $student->save();


        /*InboundStudent::create([
            'full_name' => $request->full_name,
            'university_origin' => $request->university_origin,
            'program' => $request->program,
            'program_type' => $request->program_type,
            'responsible_lecturer' => $request->responsible_lecturer,
            'duration_value' => $request->$duration['value'],
            'duration_unit' => $request->$duration['unit'],
            'received_date' => $request->received_date,
            'departure_date' => $request->departure_date,
        ]);*/


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

    /*private function calculateDuration($received_date, $departure_date)
    {
        $start = \Carbon\Carbon::parse($received_date);
        $end = \Carbon\Carbon::parse($departure_date);

        $days = $start->diffInDays($end);

        if ($days >= 30 && $days % 30 === 0) {
            return ['value' => $days / 30, 'unit' => 'month'];
        } elseif ($days >= 7 && $days % 7 === 0) {
            return ['value' => $days / 7, 'unit' => 'week'];
        } else {
            return ['value' => $days, 'unit' => 'day'];
        }
    }*/


    // Show Excel import form
    public function showImportForm()
    {
        return view('admin.inbound.import');
    }

    // Handle Excel import
   public function importExcel(Request $request)
{
    $request->validate([
        'excel_file' => 'required|file|mimes:xlsx,xls'
    ]);

    $file = $request->file('excel_file');
    $spreadsheet = IOFactory::load($file->getRealPath());
    $worksheet = $spreadsheet->getActiveSheet();
    $rows = $worksheet->toArray();

    // Extract header row (first row)
    $header = array_map('strtolower', array_map('trim', $rows[0]));

    foreach (array_slice($rows, 1) as $row) {
        $data = array_combine($header, $row);

        try {
            // Parse and convert dates
            $receivedDate = new \DateTime($data['received_date'] ?? 'now');
            $departureDate = new \DateTime($data['departure_date'] ?? 'now');

            // Validate required fields
            if (
                empty($data['full_name']) ||
                empty($data['university_origin']) ||
                empty($data['program']) ||
                empty($data['program_type']) ||
                empty($data['responsible_lecturer']) ||
                empty($data['received_date']) ||
                empty($data['departure_date'])
            ) {
                continue; // Skip this row if any required field is missing
            }

            $durationDays = $receivedDate->diff($departureDate)->days;

            InboundStudent::create([
                'full_name' => $data['full_name'],
                'university_origin' => $data['university_origin'],
                'program' => $data['program'],
                'program_type' => $data['program_type'],
                'responsible_lecturer' => $data['responsible_lecturer'],
                'received_date' => $receivedDate,
                'departure_date' => $departureDate,
                'duration_value' => $durationDays,
                'duration_unit' => 'days',
            ]);
        } catch (\Exception $e) {
            \Log::error("Failed to import row: " . $e->getMessage(), $data);
        }
    }

    return redirect()->route('inbounds.index')->with('success', 'Inbound students imported successfully.');
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
