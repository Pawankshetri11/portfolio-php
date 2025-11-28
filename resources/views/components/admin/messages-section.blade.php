@php
    $messages = App\Models\ContactMessage::latest()->get();
@endphp
<div id="messages-section" class="space-y-8 max-w-6xl mx-auto hidden">
    <div class="flex justify-between items-center">
        <h3 class="text-xl font-bold text-white">Contact Form Messages</h3>
        <button class="text-sm text-zinc-400 hover:text-white flex items-center gap-2">
            <i data-lucide="download" class="w-4 h-4"></i> Export CSV
        </button>
    </div>

    <div class="admin-card overflow-hidden p-0">
        <table class="admin-table w-full">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message Preview</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $message)
                <tr>
                    <td class="font-medium text-white">{{ $message->name }}</td>
                    <td>{{ $message->email }}</td>
                    <td class="text-sm text-zinc-500 truncate max-w-xs">{{ $message->message }}</td>
                    <td class="text-sm">{{ $message->created_at->format('M d, Y') }}</td>
                    <td>
                        <div class="flex gap-2">
                            <button class="p-1.5 bg-blue-500/20 text-blue-400 rounded hover:bg-blue-500 hover:text-white" title="Reply"><i data-lucide="reply" class="w-4 h-4"></i></button>
                            <button class="p-1.5 bg-red-500/20 text-red-400 rounded hover:bg-red-500 hover:text-white" title="Delete" data-delete-type="messages" data-id="{{ $message->id }}"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center text-zinc-500 py-8">No messages yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>