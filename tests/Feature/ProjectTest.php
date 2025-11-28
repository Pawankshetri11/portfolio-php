<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_project()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $category = ProjectCategory::factory()->create();
        $file = UploadedFile::fake()->image('project.jpg');

        $response = $this->post(route('admin.projects.store'), [
            'title' => 'New Project',
            'content' => 'Project content',
            'category_id' => $category->id,
            'image' => $file,
            'description' => 'Project description',
            'technologies' => 'Laravel, Vue.js',
            'github_url' => 'https://github.com/test/new-project',
            'live_url' => 'https://new-project.com',
            'published_at' => now(),
        ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', ['title' => 'New Project']);
        Storage::disk('public')->assertExists('projects/' . $file->hashName());
    }

    public function test_admin_can_update_project()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create();
        $category = ProjectCategory::factory()->create();
        $file = UploadedFile::fake()->image('updated_project.jpg');

        $response = $this->put(route('admin.projects.update', $project->id), [
            'title' => 'Updated Project',
            'content' => 'Updated content',
            'category_id' => $category->id,
            'image' => $file,
            'description' => 'Updated description',
            'technologies' => 'React, Node.js',
            'github_url' => 'https://github.com/test/updated-project',
            'live_url' => 'https://updated-project.com',
            'published_at' => now(),
        ]);

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseHas('projects', ['title' => 'Updated Project']);
        Storage::disk('public')->assertExists('projects/' . $file->hashName());
    }

    public function test_admin_can_delete_project()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $project = Project::factory()->create();

        $response = $this->delete(route('admin.projects.destroy', $project->id));

        $response->assertRedirect(route('admin.projects.index'));
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
