<div id="certification-modal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add/Edit Certificate</h3>
            <div class="mt-2 px-7 py-3">
                <form id="certification-form" method="POST" action="">
                    @csrf
                    <!-- This will be dynamically set by JS for PUT method -->
                    <input type="hidden" name="_method" value="POST" id="certification-method">

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700 text-left">Certificate Name</label>
                        <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        @error('name')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="issuing_organization" class="block text-sm font-medium text-gray-700 text-left">Issuing Organization</label>
                        <input type="text" name="issuing_organization" id="issuing_organization" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        @error('issuing_organization')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="issue_date" class="block text-sm font-medium text-gray-700 text-left">Issue Date</label>
                        <input type="date" name="issue_date" id="issue_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        @error('issue_date')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="icon" class="block text-sm font-medium text-gray-700 text-left">Icon (e.g., Font Awesome class)</label>
                        <input type="text" name="icon" id="icon" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        @error('icon')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="view_type" class="block text-sm font-medium text-gray-700 text-left">View Type</label>
                        <select name="view_type" id="view_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                            <option value="link">Link</option>
                            <option value="image">Image</option>
                        </select>
                        @error('view_type')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="credential_url" class="block text-sm font-medium text-gray-700 text-left">Credential URL (if link)</label>
                        <input type="url" name="credential_url" id="credential_url" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @error('credential_url')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="mb-4">
                        <label for="certificate_image" class="block text-sm font-medium text-gray-700 text-left">Certificate Image URL (if image)</label>
                        <input type="text" name="certificate_image" id="certificate_image" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        @error('certificate_image')<p class="text-red-500 text-xs mt-1">{{ $message }}</p>@enderror
                    </div>

                    <div class="items-center px-4 py-3">
                        <button type="submit" id="modal-submit-button" class="px-4 py-2 bg-gold-400 text-black text-base font-medium rounded-md w-full shadow-sm hover:bg-gold-500 focus:outline-none focus:ring-2 focus:ring-gold-300">
                            Save Certificate
                        </button>
                        <button type="button" onclick="closeCertificationModal()" class="mt-3 px-4 py-2 bg-gray-200 text-gray-800 text-base font-medium rounded-md w-full shadow-sm hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-300">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const certificationModal = document.getElementById('certification-modal');
    const certificationForm = document.getElementById('certification-form');
    const certificationMethod = document.getElementById('certification-method');
    const modalTitle = document.getElementById('modal-title');
    const modalSubmitButton = document.getElementById('modal-submit-button');
    const csrfToken = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '';

    // Function to clear previous validation errors
    function clearValidationErrors() {
        document.querySelectorAll('.text-red-500').forEach(el => el.remove());
        document.querySelectorAll('.border-red-500').forEach(el => el.classList.remove('border-red-500'));
    }

    // Function to display validation errors
    function displayValidationErrors(errors) {
        clearValidationErrors();
        for (const field in errors) {
            const input = document.getElementById(field);
            if (input) {
                input.classList.add('border-red-500');
                const errorElement = document.createElement('p');
                errorElement.classList.add('text-red-500', 'text-xs', 'mt-1', 'text-left');
                errorElement.textContent = errors[field][0];
                input.parentNode.appendChild(errorElement);
            }
        }
    }

    function openCertificationModal(isEdit = false, certificateData = {}) {
        clearValidationErrors();
        certificationModal.classList.remove('hidden');

        // Reset form
        certificationForm.reset();

        if (isEdit) {
            modalTitle.textContent = 'Edit Certificate';
            modalSubmitButton.textContent = 'Update Certificate';
            certificationMethod.value = 'PUT';
            certificationForm.action = `/admin/certificates/${certificateData.id}`;

            // Populate form fields
            document.getElementById('name').value = certificateData.name;
            document.getElementById('issuing_organization').value = certificateData.issuing_organization;
            document.getElementById('issue_date').value = certificateData.issue_date; // Assuming YYYY-MM-DD format
            document.getElementById('icon').value = certificateData.icon;
            document.getElementById('view_type').value = certificateData.view_type;
            document.getElementById('credential_url').value = certificateData.credential_url || '';
            document.getElementById('certificate_image').value = certificateData.certificate_image || '';

        } else {
            modalTitle.textContent = 'Add New Certificate';
            modalSubmitButton.textContent = 'Add Certificate';
            certificationMethod.value = 'POST';
            certificationForm.action = "{{ route('admin.certificates.store') }}";
        }
    }

    function closeCertificationModal() {
        certificationModal.classList.add('hidden');
        clearValidationErrors(); // Clear errors on close
    }

    // Handle form submission via Fetch API
    certificationForm.addEventListener('submit', async (event) => {
        event.preventDefault(); // Prevent default form submission
        clearValidationErrors(); // Clear previous errors

        const formData = new FormData(certificationForm);
        const method = certificationMethod.value; // GET, POST, PUT, DELETE

        // Manually add _method if it's PUT
        if (method === 'PUT') {
            formData.set('_method', 'PUT'); // Ensure _method is correctly set for PUT
        } else {
            formData.delete('_method'); // Remove if not PUT
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch(certificationForm.action, {
                method: method === 'PUT' ? 'POST' : method, // Laravel expects POST for PUT/PATCH/DELETE with _method hidden input
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    // 'Content-Type': 'application/json', // FormData sets this automatically
                },
                body: formData
            });

            const result = await response.json();

            if (response.ok) {
                alert(result.message);
                closeCertificationModal();
                window.location.reload(); // Reload to show new/updated data
            } else if (response.status === 422) {
                displayValidationErrors(result.errors);
            } else {
                alert(result.message || 'An unexpected error occurred.');
            }
        } catch (error) {
            console.error('Submission error:', error);
            alert('An error occurred during submission. Please check the console.');
        }
    });

    // Event listener for edit buttons
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('[data-edit-type="certification"]').forEach(button => {
            button.addEventListener('click', async (event) => {
                const certificateId = event.currentTarget.dataset.id;
                try {
                    const response = await fetch(`/admin/certificates/${certificateId}/edit`, {
                        headers: {
                            'Accept': 'application/json'
                        }
                    });
                    if (response.ok) {
                        const certificate = await response.json();
                        // Format issue_date to YYYY-MM-DD for input[type="date"]
                        if (certificate.issue_date) {
                            certificate.issue_date = new Date(certificate.issue_date).toISOString().split('T')[0];
                        }
                        openCertificationModal(true, certificate);
                    } else {
                        alert('Failed to load certificate data for editing.');
                        console.error('Edit fetch error:', await response.text());
                    }
                } catch (error) {
                    console.error('Error fetching certificate for edit:', error);
                    alert('An error occurred while fetching certificate data.');
                }
            });
        });

        // Event listener for delete buttons
        document.querySelectorAll('[data-delete-type="certificates"]').forEach(button => {
            button.addEventListener('click', async (event) => {
                if (confirm('Are you sure you want to delete this certificate?')) {
                    const certificateId = event.currentTarget.dataset.id;
                    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    try {
                        const response = await fetch(`/admin/certificates/${certificateId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json'
                            }
                        });

                        const result = await response.json();

                        if (response.ok) {
                            alert(result.message);
                            window.location.reload();
                        } else {
                            alert(result.message || 'Failed to delete certificate.');
                            console.error('Delete error:', result);
                        }
                    } catch (error) {
                        console.error('Error during delete:', error);
                        alert('An error occurred during deletion. Please check the console.');
                    }
                }
            });
        });
    });
</script>