<?php

use App\Livewire\Tickets\EditTicket;
use App\Models\Category;
use App\Models\Label;
use App\Models\Ticket;
use App\Models\User;
use function Pest\Laravel\get;

beforeEach(function () {
    login();
});

it('has component on edit page', function () {
    $ticket = Ticket::factory()->create();

    get(route('tickets.edit', $ticket))
        ->assertSeeLivewire(EditTicket::class)
        ->assertOk();
});

it('can edit a ticket', function () {
    $user = User::factory()->create();
    $ticket = Ticket::factory()->create([
        'title' => 'Test Title',
        'priority' => 'low',
        'description' => 'Test Description for ticket',
        'status' => 'open',
        'user_id' => $user->id,
    ]);

    $category = Category::whereName('Uncategorized')->first();
    $ticket->categories()->attach($category);

    $label = Label::whereName('Bug')->first();
    $ticket->labels()->attach($label);

    $newCategory = Category::whereName('Profile')->first();
    $newLabel = Label::whereName('Question')->first();
    Livewire::test(EditTicket::class, ['ticket' => $ticket])
        ->set('form.title', 'New Title')
        ->set('form.priority', 'high')
        ->set('form.status', 'closed')
        ->set('form.description', 'New Description for ticket!!!!!!')
        ->set('form.selectedCategories', [$newCategory->id])
        ->set('form.selectedLabels', [$newLabel->id])
        ->call('save');

    $ticket->refresh();

    expect($ticket->title)->toEqual('New Title');
    expect($ticket->priority)->toEqual('high');
    expect($ticket->status)->toEqual('closed');
    expect($ticket->description)->toEqual('New Description for ticket!!!!!!');
    expect($ticket->user->name)->toEqual($user->name);
    expect($ticket->categories[0]->name)->toEqual($newCategory->name);
    expect($ticket->labels[0]->name)->toEqual($newLabel->name);
});

it('validates required fields', function (string $name, string $value) {
    $ticket = Ticket::factory()->create();

    Livewire::test(EditTicket::class, ['ticket' => $ticket])
        ->set($name, $value)
        ->call('save')
        ->assertHasErrors($name);
})->with([
    'title' => ['form.title', ''],
    'priority' => ['form.priority', ''],
    'description' => ['form.description', ''],
]);

it('is not allowed to reach this endpoint when logged in as default user', function () {
    login(User::factory()->create());

    $ticket = Ticket::factory()->create();

    // TODO: Not working yet on livewire 3 beta 7
    // Livewire::test(CreateTicket::class, ['label' => $ticket])
    //     ->set('name', 'test')
    //     ->call('save')
    //     ->assertForbidden();

    get(route('tickets.edit', $ticket))
        ->assertForbidden();
});

it('is allowed to reach this endpoint as agent when assigned to the ticket', function () {
    $user = User::factory()->create();
    $user->assignRole('Agent');
    login($user);

    $ticket = Ticket::factory()->create([
        'agent_id' => $user->id,
    ]);

    get(route('tickets.edit', $ticket))
        ->assertOk();
});

it('is not allowed to reach this endpoint as agent when not assigned to the ticket', function () {
    $user = User::factory()->create();
    $user->assignRole('Agent');
    login($user);

    $ticket = Ticket::factory()->create();

    get(route('tickets.edit', $ticket))
        ->assertForbidden();
});
