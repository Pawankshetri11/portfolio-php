<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Project;
use App\Models\ProjectCategory;
use Tests\TestCase;

class ProjectDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_can_be_deleted()
    {
        // Create a user and log them in
        $user = User::factory()->create();
        $this->actingAs($user);

        // Create a project category
        $category = ProjectCategory::factory()->create();

        // Create a project
        $project = Project::factory()->create(['category_id' => $category->id]);

        // Send a DELETE request to the destroy endpoint
        $response = $this->delete(route('admin.projects.destroy', $project->id));

        // Assert that the response is a redirect to the projects index page
        $response->assertRedirect(route('admin.projects.index'));

        // Assert that the success message is in the session
        $response->assertSessionHas('success', 'Project deleted successfully.');

        // Assert that the project is no longer in the database
        $this->assertDatabaseMissing('projects', ['id' => $project->id]);
    }
}
