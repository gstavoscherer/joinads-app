<?php

use App\Models\Domain;
use App\Models\Block;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\{getJson, postJson, putJson, deleteJson};

uses(RefreshDatabase::class);

// Domain Tests
test('can list all domains', function () {
    Domain::factory()->count(3)->create();

    getJson('/api/domains')
        ->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

test('can create new domain', function () {
    $domainData = ['name' => 'test.com'];

    postJson('/api/domains', $domainData)
        ->assertStatus(201)
        ->assertJsonFragment($domainData);
});

test('can update domain', function () {
    $domain = Domain::factory()->create();
    $updateData = ['name' => 'updated.com'];

    putJson("/api/domains/{$domain->id}", $updateData)
        ->assertStatus(200)
        ->assertJsonFragment($updateData);
});

test('can delete domain', function () {
    $domain = Domain::factory()->create();

    deleteJson("/api/domains/{$domain->id}")
        ->assertStatus(200);

    $this->assertDatabaseMissing('domains', ['id' => $domain->id]);
});

test('can list all blocks', function () {
    Block::factory()->count(3)->create();

    getJson('/api/blocks')
        ->assertStatus(200)
        ->assertJsonCount(3, 'data');
});

test('can create new block', function () {
    $domain = Domain::factory()->create();
    $blockData = [
        'name' => 'Test Block',
        'domain_id' => $domain->id
    ];

    postJson('/api/blocks', $blockData)
        ->assertStatus(201)
        ->assertJsonFragment($blockData);
});

test('cannot create block with invalid domain', function () {
    $blockData = [
        'name' => 'Test Block',
        'domain_id' => 999
    ];

    postJson('/api/blocks', $blockData)
        ->assertStatus(422)
        ->assertJsonValidationErrors(['domain_id']);
});

test('can delete block', function () {
    $block = Block::factory()->create();

    deleteJson("/api/blocks/{$block->id}")
        ->assertStatus(200);

    $this->assertDatabaseMissing('blocks', ['id' => $block->id]);
});

test('deleting domain cascades to blocks', function () {
    $domain = Domain::factory()->create();
    Block::factory()->count(3)->create(['domain_id' => $domain->id]);

    deleteJson("/api/domains/{$domain->id}")
        ->assertStatus(200);

    $this->assertDatabaseMissing('blocks', ['domain_id' => $domain->id]);
});

test('domain can have multiple blocks', function () {
    $domain = Domain::factory()->create();
    $blocks = Block::factory()->count(3)->create(['domain_id' => $domain->id]);

    expect($domain->blocks)->toHaveCount(3);
    expect($domain->blocks->first())->toBeInstanceOf(Block::class);
});