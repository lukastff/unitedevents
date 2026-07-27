<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        foreach (glob(public_path('img/events/*.jpg')) as $file) {
            @unlink($file);
        }

        parent::tearDown();
    }

    public function test_guests_can_view_the_events_index(): void
    {
        Event::factory()->count(3)->create();

        $this->get(route('events.index'))->assertStatus(200);
    }

    public function test_index_can_be_filtered_by_search(): void
    {
        Event::factory()->create(['title' => 'Rock in the Park']);
        Event::factory()->create(['title' => 'Jazz Night']);

        $response = $this->get(route('events.index', ['search' => 'Rock']));

        $response->assertSee('Rock in the Park');
        $response->assertDontSee('Jazz Night');
    }

    public function test_guests_cannot_access_the_create_page(): void
    {
        $this->get(route('events.create'))->assertRedirect(route('login'));
    }

    public function test_guests_cannot_create_an_event(): void
    {
        $response = $this->post(route('events.store'), [
            'title' => 'My Event',
        ]);

        $response->assertRedirect(route('login'));
        $this->assertDatabaseCount('events', 0);
    }

    public function test_store_requires_valid_data(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('events.store'), []);

        $response->assertSessionHasErrors(['title', 'date', 'city', 'private', 'description', 'image']);
        $this->assertDatabaseCount('events', 0);
    }

    public function test_authenticated_user_can_create_an_event(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('events.store'), [
            'title' => 'My Event',
            'date' => '2027-01-01',
            'city' => 'São Paulo',
            'private' => '0',
            'description' => 'A great event',
            'items' => ['Cadeiras', 'Palco'],
            'image' => UploadedFile::fake()->create('event.jpg', 100)->mimeType('image/jpeg'),
        ]);

        $response->assertRedirect(route('events.index'));

        $this->assertDatabaseHas('events', [
            'title' => 'My Event',
            'city' => 'São Paulo',
            'user_id' => $user->id,
        ]);

        $event = Event::first();
        $this->assertSame(['Cadeiras', 'Palco'], $event->items);
        $this->assertFileExists(public_path('img/events/'.$event->image));
    }

    public function test_created_event_cannot_have_its_user_id_overridden(): void
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($user)->post(route('events.store'), [
            'title' => 'My Event',
            'date' => '2027-01-01',
            'city' => 'São Paulo',
            'private' => '0',
            'description' => 'A great event',
            'image' => UploadedFile::fake()->create('event.jpg', 100)->mimeType('image/jpeg'),
            'user_id' => $otherUser->id,
        ]);

        $this->assertDatabaseHas('events', [
            'title' => 'My Event',
            'user_id' => $user->id,
        ]);
    }

    public function test_show_displays_the_event(): void
    {
        $event = Event::factory()->create(['title' => 'My Event']);

        $this->get(route('events.show', $event))
            ->assertStatus(200)
            ->assertSee('My Event');
    }

    public function test_owner_can_view_the_edit_page(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->get(route('events.edit', $event))->assertStatus(200);
    }

    public function test_non_owner_cannot_view_the_edit_page(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($intruder)->get(route('events.edit', $event))->assertStatus(403);
    }

    public function test_owner_can_update_their_event(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('events.update', $event), [
            'title' => 'Updated Title',
            'date' => '2027-02-02',
            'city' => 'Rio de Janeiro',
            'private' => '1',
            'description' => 'Updated description',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'title' => 'Updated Title',
            'private' => true,
        ]);
    }

    public function test_non_owner_cannot_update_someone_elses_event(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $owner->id, 'title' => 'Original Title']);

        $response = $this->actingAs($intruder)->put(route('events.update', $event), [
            'title' => 'Hijacked Title',
            'date' => '2027-02-02',
            'city' => 'Rio de Janeiro',
            'private' => '0',
            'description' => 'Hijacked description',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'title' => 'Original Title',
        ]);
    }

    public function test_non_owner_cannot_delete_someone_elses_event(): void
    {
        $owner = User::factory()->create();
        $intruder = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $owner->id]);

        $this->actingAs($intruder)->delete(route('events.destroy', $event))->assertStatus(403);
        $this->assertDatabaseHas('events', ['id' => $event->id]);
    }

    public function test_owner_can_delete_their_event(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['user_id' => $user->id]);

        $this->actingAs($user)->delete(route('events.destroy', $event))->assertRedirect(route('dashboard'));
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    public function test_user_can_join_an_event(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        $this->actingAs($user)->post(route('events.join', $event))->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('event_user', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_joining_an_event_twice_does_not_duplicate_participation(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        $this->actingAs($user)->post(route('events.join', $event));
        $this->actingAs($user)->post(route('events.join', $event));

        $this->assertDatabaseCount('event_user', 1);
    }

    public function test_user_can_leave_an_event(): void
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();
        $user->eventsAsParticipants()->attach($event->id);

        $this->actingAs($user)->delete(route('events.leave', $event))->assertRedirect(route('dashboard'));

        $this->assertDatabaseMissing('event_user', [
            'event_id' => $event->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_dashboard_lists_owned_and_participating_events(): void
    {
        $user = User::factory()->create();
        $ownedEvent = Event::factory()->create(['user_id' => $user->id]);
        $participatingEvent = Event::factory()->create();
        $user->eventsAsParticipants()->attach($participatingEvent->id);

        $response = $this->actingAs($user)->get(route('dashboard'));

        $response->assertStatus(200);
        $response->assertSee($ownedEvent->title);
        $response->assertSee($participatingEvent->title);
    }
}
