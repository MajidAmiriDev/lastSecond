<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use App\Http\Requests\ActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Activity::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActivityRequest $request)
    {

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image_path'] = $path;
        }

        $activity = Activity::create($data);
        return response()->json($activity, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Activity::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActivityRequest $request, string $id)
    {
        $data = $request->validated();

        $activity = Activity::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($activity->image_path) {
                Storage::disk('public')->delete($activity->image_path);
            }

            // Store the new image
            $path = $request->file('image')->store('images', 'public');
            $data['image_path'] = $path;
        }

        $activity->update($data);

        return response()->json($activity, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $activity = Activity::findOrFail($id);
        $activity->delete();

        return response()->json(null, 204);
    }


    public function search(Request $request)
    {
        $query = Activity::query();

        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%' . $request->input('name') . '%');
        }

        if ($request->has('location')) {
            $query->where('location', 'LIKE', '%' . $request->input('location') . '%');
        }

        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->input('price_min'));
        }

        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->input('price_max'));
        }

        $activities = $query->paginate(10);

        return response()->json($activities);
    }
    
}
