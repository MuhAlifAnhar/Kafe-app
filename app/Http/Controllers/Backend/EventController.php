<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\Backend\Event;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Backend\EventRequest;
use App\Http\Services\Backend\EventService;
use App\Http\Services\Backend\CategoryService;

class EventController extends Controller
{
    public function __construct(
        private EventService $eventService,
        private CategoryService $categoryService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('backend.event.index', [
            'events' => $this->eventService->select(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.event.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui data event.');
        }
        return view('backend.event.create', [
            'categories' => $this->categoryService->select(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('events', 'public');
        }

        try {
            Event::create($data);

            return redirect()->route('panel.event.index')->with('success', 'Event successfully saved');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        return view('backend.event.show', [
            'event' => $this->eventService->selectFirstBy('uuid', $uuid),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.event.index')->with('error', 'Anda tidak memiliki izin untuk mengedit data event.');
        }

        return view('backend.event.edit', [
            'event' => $this->eventService->selectFirstBy('uuid', $uuid),
            'categories' => $this->categoryService->select(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return redirect()->route('panel.event.index')->with('error', 'Anda tidak memiliki izin untuk memperbarui data event.');
        }

        $data = $request->validated();

        try {
            $event = $this->eventService->selectFirstBy('uuid', $uuid);

            if ($request->hasFile('image')) {
                if ($event->image) {
                    Storage::disk('public')->delete($event->image);
                }
                $data['image'] = $request->file('image')->store('events', 'public');
            }

            $event->update($data);
            return redirect()->route('panel.event.index')->with('success', 'Event successfully updated');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $uuid)
    {
        if (auth()->user()->role === 'owner') {
            return response()->json([
                'message' => 'Anda tidak memiliki izin untuk menghapus data event.'
            ], 403);
        }

        $event = $this->eventService->selectFirstBy('uuid', $uuid);

        if ($event->image) {
            Storage::disk('public')->delete($event->image);
        }

        $event->delete();

        return response()->json([
            'message' => 'Event successfully deleted',
        ]);
    }
}
