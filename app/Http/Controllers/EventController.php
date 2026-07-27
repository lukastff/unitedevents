<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $events = Event::query()
            ->withCount('users')
            ->when($search, fn ($query) => $query->where('title', 'like', '%'.$search.'%'))
            ->orderBy('date')
            ->paginate(12)
            ->withQueryString();

        return view('welcome', ['events' => $events, 'search' => $search]);
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateEvent($request);

        $event = Event::create([
            'title' => $validated['title'],
            'date' => $validated['date'],
            'city' => $validated['city'],
            'private' => $validated['private'],
            'description' => $validated['description'],
            'items' => $validated['items'] ?? [],
            'image' => $this->storeEventImage($request->file('image')),
            'user_id' => $request->user()->id,
        ]);

        return redirect()->route('events.index')->with('msg', 'Evento criado com sucesso!');
    }

    public function show(Request $request, Event $event)
    {
        $event->load('user')->loadCount('users');

        $user = $request->user();
        $hasUserJoined = $user
            ? $event->users()->whereKey($user->id)->exists()
            : false;

        return view('events.show', [
            'event' => $event,
            'hasUserJoined' => $hasUserJoined,
        ]);
    }

    public function dashboard(Request $request)
    {
        $user = $request->user();

        $events = $user->events()->withCount('users')->latest()->get();
        $eventsAsParticipants = $user->eventsAsParticipants()->withCount('users')->get();

        return view('events.dashboard', [
            'events' => $events,
            'eventsAsParticipants' => $eventsAsParticipants,
        ]);
    }

    public function destroy(Request $request, Event $event)
    {
        abort_if($event->user_id !== $request->user()->id, 403);

        $event->delete();

        return redirect()->route('dashboard')->with('msg', 'Evento removido com sucesso!');
    }

    public function edit(Request $request, Event $event)
    {
        abort_if($event->user_id !== $request->user()->id, 403);

        return view('events.edit', ['event' => $event]);
    }

    public function update(Request $request, Event $event)
    {
        abort_if($event->user_id !== $request->user()->id, 403);

        $validated = $this->validateEvent($request, forUpdate: true);

        $data = [
            'title' => $validated['title'],
            'date' => $validated['date'],
            'city' => $validated['city'],
            'private' => $validated['private'],
            'description' => $validated['description'],
            'items' => $validated['items'] ?? [],
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $this->storeEventImage($request->file('image'));
        }

        $event->update($data);

        return redirect()->route('dashboard')->with('msg', 'Evento editado com sucesso!');
    }

    public function joinEvent(Request $request, Event $event)
    {
        $request->user()->eventsAsParticipants()->syncWithoutDetaching([$event->id]);

        return redirect()->route('dashboard')->with('msg', 'Sua presença foi confirmada no evento ' . $event->title);
    }

    public function leaveEvent(Request $request, Event $event)
    {
        $request->user()->eventsAsParticipants()->detach($event->id);

        return redirect()->route('dashboard')->with('msg', 'Você saiu com sucesso do evento ' . $event->title);
    }

    private function validateEvent(Request $request, bool $forUpdate = false): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'date' => ['required', 'date'],
            'city' => ['required', 'string', 'max:255'],
            'private' => ['required', 'boolean'],
            'description' => ['required', 'string'],
            'items' => ['nullable', 'array'],
            'items.*' => ['string', 'max:100'],
            'image' => [$forUpdate ? 'nullable' : 'required', 'image', 'max:4096'],
        ]);
    }

    private function storeEventImage(UploadedFile $image): string
    {
        $imageName = $image->hashName();

        $image->move(public_path('img/events'), $imageName);

        return $imageName;
    }
}
