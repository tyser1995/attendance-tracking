<?php

namespace App\Http\Controllers;

use App\Models\IdPattern;
use Illuminate\Http\Request;

class IdPatternController extends Controller
{
    // Show all patterns
    public function index()
    {
        $patterns = IdPattern::all();
        return view('patterns.index', compact('patterns'));
    }

    public function create()
    {
        //
        return view('patterns.create');
    }

    // Store a new pattern
   public function store(Request $request)
    {
        $request->validate([
            'pattern' => 'required|string',
        ]);

        // Convert any group of # into \d{N} dynamically
        $regex = preg_replace_callback('/#+/', function ($matches) {
            $count = strlen($matches[0]);   // how many # in a row
            return '\d{' . $count . '}';    // e.g. ## -> \d{2}, ### -> \d{3}
        }, $request->pattern);

        // Wrap with anchors
        $regex = '/^' . $regex . '$/';

        // ✅ Check if pattern OR regex already exists
        $exists = IdPattern::where('pattern', $request->pattern)
            ->orWhere('regex', $regex)
            ->exists();

        if ($exists) {
            return redirect()
                ->route('patterns')
                ->with('warning', '⚠️ Pattern already exists!');
        }

        // Insert if unique
        IdPattern::create([
            'pattern' => $request->pattern,
            'regex'   => $regex,
        ]);

        return redirect()
            ->route('patterns')
            ->with('status', '✅ Pattern added successfully!');
    }



    // Validate a given ID
    public function validateId(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
        ]);

        $patterns = IdPattern::all();
        foreach ($patterns as $pattern) {
            if (preg_match($pattern->regex, $request->id)) {
              return redirect()
                ->route('patterns')
                ->with('status', 'Pattern added successfully!');

            }
        }
        
        return redirect()
            ->route('patterns')
            ->with('error', "❌ ID '{$request->id}' does not match any pattern.");

    }

    public function validateIdLog(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
        ]);

        $patterns = IdPattern::all();
        foreach ($patterns as $pattern) {
            if (preg_match($pattern->regex, $request->id)) {
                return response()->json([
                    'success' => true,
                    'message' => "✅ ID '{$request->id}' matches pattern {$pattern->pattern}"
                ]);
            }
        }

        return response()->json([
            'success' => false,
            'message' => "❌ ID '{$request->id}' does not match any pattern."
        ]);

    }

    public function destroy($id)
    {
        $pattern = IdPattern::findOrFail($id);
        $pattern->delete();

       return redirect()
        ->route('patterns')
        ->with('status', "🗑️ Pattern '{$pattern->pattern}' deleted successfully.");
    }
}