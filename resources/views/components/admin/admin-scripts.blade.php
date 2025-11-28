r<script>
    lucide.createIcons();

    // Enhanced Tab Switching Logic
    function showSection(sectionId, updateHistory = true) {
        // List of all possible section IDs
        const sections = ['hero', 'metrics', 'experience', 'education', 'certifications', 'projects', 'categories', 'contact', 'skills', 'skill-categories', 'messages'];

        // Hide all
        sections.forEach(id => {
            const el = document.getElementById(id + '-section');
            if(el) el.classList.add('hidden');
        });

        // Remove active class from all links
        document.querySelectorAll('.sidebar-link').forEach(link => {
            link.classList.remove('active');
        });

        // Show selected
        const target = document.getElementById(sectionId + '-section');
        if(target) {
            target.classList.remove('hidden');
            // Simple fade in
            target.animate([
                { opacity: 0, transform: 'translateY(10px)' },
                { opacity: 1, transform: 'translateY(0)' }
            ], { duration: 300, easing: 'ease-out' });
        }

        // Update Title
        const titles = {
            'hero': 'Hero & Animation',
            'metrics': 'Key Metrics',
            'experience': 'Professional Experience',
            'education': 'Education History',
            'certifications': 'Certifications',
            'projects': 'Projects List',
            'categories': 'Project Categories',
            'contact': 'Contact Settings',
            'skills': 'Technical Skills',
            'skill-categories': 'Skill Categories',
            'messages': 'Inbox'
        };
        document.getElementById('pageTitle').innerText = titles[sectionId] || 'Admin Panel';

        // Add active class to clicked link
        if (event && event.currentTarget) {
            event.currentTarget.classList.add('active');
        } else {
            // Find and activate the corresponding sidebar link
            const link = document.querySelector(`a[onclick*="showSection('${sectionId}'"]`);
            if (link) {
                link.classList.add('active');
            }
        }

        // Update URL hash without page reload
        if (updateHistory) {
            history.pushState({section: sectionId}, '', '#' + sectionId);
        }

        // Show/hide main save button based on section
        const saveButton = document.getElementById('saveChanges');
        if (sectionId === 'hero') {
            saveButton.classList.remove('hidden');
        } else {
            saveButton.classList.add('hidden');
        }

        // Add section-specific save buttons
        if (sectionId === 'metrics') {
            console.log('Adding Save Key Metrics button for metrics section');
            const metricsSection = document.getElementById('metrics-section');
            if (metricsSection) {
                const adminCard = metricsSection.querySelector('.admin-card');
                if (adminCard) {
                    // Check if button already exists
                    if (!adminCard.querySelector('button[onclick*="saveKeyMetrics"]')) {
                        const saveBtn = document.createElement('button');
                        saveBtn.textContent = 'Save Key Metrics';
                        saveBtn.className = 'bg-gold-400 hover:bg-gold-500 text-black font-bold py-2 px-6 rounded-lg text-sm transition-colors shadow-[0_0_15px_rgba(255,215,0,0.2)] mt-4';
                        saveBtn.onclick = saveKeyMetrics;
                        adminCard.appendChild(saveBtn);
                        console.log('Save Key Metrics button added to metrics section');
                    }
                }
            }
        }
    }

    // Handle browser back/forward navigation
    window.addEventListener('popstate', function(event) {
        if (event.state && event.state.section) {
            showSection(event.state.section, false);
        }
    });

    // Save Changes Handler
    document.getElementById('saveChanges').addEventListener('click', function(e) {
        e.preventDefault();

        // Show notification
        showNotification('Changes saved successfully!', 'success');
    });

    function showNotification(message, type) {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg text-white z-50 ${
            type === 'success' ? 'bg-green-500' : 'bg-red-500'
        }`;
        notification.textContent = message;

        document.body.appendChild(notification);

        // Remove after 3 seconds
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    // Experience Modal Logic
    const modal = document.getElementById('experienceModal');
    const modalContent = document.getElementById('modalContent');
    const companyFields = document.getElementById('companyFields');
    const modalTitle = document.getElementById('modalTitle');

    function openModal(type, isEdit = false) {
        modal.classList.remove('hidden');
        // Animation frame to allow display:block to apply
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modalContent.classList.remove('scale-95');
            modalContent.classList.add('scale-100');
        }, 10);

        if (type === 'company') {
            companyFields.classList.remove('hidden');
            modalTitle.innerText = isEdit ? 'Edit Company & Role' : 'Add New Company';
        } else {
            companyFields.classList.add('hidden');
            modalTitle.innerText = isEdit ? 'Edit Role' : 'Add New Role';
        }
    }

    function closeModal() {
        modal.classList.add('opacity-0');
        modalContent.classList.remove('scale-100');
        modalContent.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function toggleEndDate(checkbox) {
        const input = document.getElementById('endDateInput');
        if (checkbox.checked) {
            input.disabled = true;
            input.value = '';
        } else {
            input.disabled = false;
        }
    }

    // Bullet Point Logic for Experience Description
    const textarea = document.getElementById('desc-input');
    if (textarea) {
        textarea.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                const cursorPosition = this.selectionStart;
                const textBefore = this.value.substring(0, cursorPosition);
                const textAfter = this.value.substring(cursorPosition);
                this.value = textBefore + "• " + textAfter;
                this.selectionStart = this.selectionEnd = cursorPosition + 2;
            }
        });
    }

    // Education Modal Logic
    const educationModal = document.getElementById('educationModal');
    const educationModalContent = document.getElementById('educationModalContent');
    const educationModalTitle = document.getElementById('educationModalTitle');

    function openEducationModal(isEdit = false) {
        educationModal.classList.remove('hidden');
        // Animation frame
        setTimeout(() => {
            educationModal.classList.remove('opacity-0');
            educationModalContent.classList.remove('scale-95');
            educationModalContent.classList.add('scale-100');
        }, 10);

        educationModalTitle.innerText = isEdit ? 'Edit Education' : 'Add New Education';
    }

    function closeEducationModal() {
        educationModal.classList.add('opacity-0');
        educationModalContent.classList.remove('scale-100');
        educationModalContent.classList.add('scale-95');
        setTimeout(() => {
            educationModal.classList.add('hidden');
        }, 300);
    }

    function toggleEducationEndDate(checkbox) {
        const input = document.getElementById('educationEndDateInput');
        if (checkbox.checked) {
            input.disabled = true;
            input.value = '';
        } else {
            input.disabled = false;
        }
    }

    // Certification Modal Logic
    const certificationModal = document.getElementById('certificationModal');
    const certificationModalContent = document.getElementById('certificationModalContent');
    const certificationModalTitle = document.getElementById('certificationModalTitle');

    function openCertificationModal(isEdit = false) {
        certificationModal.classList.remove('hidden');
        setTimeout(() => {
            certificationModal.classList.remove('opacity-0');
            certificationModalContent.classList.remove('scale-95');
            certificationModalContent.classList.add('scale-100');
        }, 10);

        certificationModalTitle.innerText = isEdit ? 'Edit Certification' : 'Add Certification';

        // Reset form if adding new
        if (!isEdit) {
            const form = document.getElementById('certificationForm');
            form.reset();

            // Reset icon selection
            document.querySelectorAll('#certIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
            const firstIcon = document.querySelector('#certIconPicker .icon-option');
            if (firstIcon) {
                firstIcon.classList.add('selected');
                document.getElementById('selectedIcon').value = firstIcon.getAttribute('data-icon') || 'award';
            }

            // Reset view type to default
            const viewTypeSelector = document.getElementById('certViewTypeSelector');
            if (viewTypeSelector) {
                viewTypeSelector.value = 'link';
            }

            toggleCertViewType();
        }
    }

    function closeCertificationModal() {
        certificationModal.classList.add('opacity-0');
        certificationModalContent.classList.remove('scale-100');
        certificationModalContent.classList.add('scale-95');
        setTimeout(() => {
            certificationModal.classList.add('hidden');
        }, 300);
    }

    // Toggle View Type Logic
    function toggleCertViewType() {
        const type = document.getElementById('certViewTypeSelector').value;
        const linkGroup = document.getElementById('certLinkInputGroup');
        const imageGroup = document.getElementById('certImageInputGroup');

        if (type === 'link') {
            linkGroup.classList.remove('hidden');
            imageGroup.classList.add('hidden');
        } else {
            linkGroup.classList.add('hidden');
            imageGroup.classList.remove('hidden');
        }
    }

    // Icon Selection Logic
    function selectCertIcon(element) {
        if (!element) return; // Safety check

        // Remove selected class from all
        document.querySelectorAll('#certIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
        // Add to clicked
        element.classList.add('selected');
        // Update hidden input
        const iconValue = element.getAttribute('data-icon');
        const hiddenInput = document.getElementById('selectedIcon');
        if (hiddenInput) {
            hiddenInput.value = iconValue;
        }
    }

    // Project Modal Logic
    const projectModal = document.getElementById('projectModal');
    const projectModalContent = document.getElementById('projectModalContent');
    const projectModalTitle = document.getElementById('projectModalTitle');

    function openProjectModal(isEdit = false) {
        projectModal.classList.remove('hidden');
        setTimeout(() => {
            projectModal.classList.remove('opacity-0');
            projectModalContent.classList.remove('scale-95');
            projectModalContent.classList.add('scale-100');
        }, 10);

        projectModalTitle.innerText = isEdit ? 'Edit Project' : 'Add New Project';
    }

    function closeProjectModal() {
        projectModal.classList.add('opacity-0');
        projectModalContent.classList.remove('scale-100');
        projectModalContent.classList.add('scale-95');
        setTimeout(() => {
            projectModal.classList.add('hidden');
        }, 300);
    }

    // Global variables for edit mode
    let currentEditId = null;
    let currentEditType = null;

    // Certification modal save function (global scope)
    function saveCertificationFromModal() {
        console.log('saveCertificationFromModal called');
        const form = document.getElementById('certificationForm');
        if (!form) {
            console.error('Certification form not found');
            return;
        }

        const formData = new FormData(form);
        console.log('Form data entries:');
        for (let [key, value] of formData.entries()) {
            console.log(key, value);
        }

        const isEdit = currentEditType === 'certification';
        console.log('isEdit:', isEdit, 'currentEditId:', currentEditId);

        saveCertification(formData, isEdit);
        currentEditId = null;
        currentEditType = null;
    }


    async function saveEducation(formData, isEdit = false) {
        try {
            const url = isEdit ? `/admin/educations/${currentEditId}` : '/admin/educations';
            const method = isEdit ? 'PATCH' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                showNotification(`Education ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                closeEducationModal();
                location.reload(); // Refresh to show new data
            } else {
                showNotification(`Failed to ${isEdit ? 'update' : 'add'} education`, 'error');
            }
        } catch (error) {
            showNotification(`Error ${isEdit ? 'updating' : 'adding'} education`, 'error');
        }
    }

    async function saveCertification(formData, isEdit = false) {
        try {
            const url = isEdit ? `/admin/certificates/${currentEditId}` : '/admin/certificates';
            const method = isEdit ? 'PATCH' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                showNotification(`Certification ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                closeCertificationModal();
                location.reload(); // Refresh to show new data
            } else {
                showNotification(`Failed to ${isEdit ? 'update' : 'add'} certification`, 'error');
            }
        } catch (error) {
            showNotification(`Error ${isEdit ? 'updating' : 'adding'} certification`, 'error');
        }
    }

    async function saveProject(formData, isEdit = false) {
        try {
            const url = isEdit ? `/admin/projects/${currentEditId}` : '/admin/projects';
            const method = isEdit ? 'PATCH' : 'POST';

            const response = await fetch(url, {
                method: method,
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                showNotification(`Project ${isEdit ? 'updated' : 'added'} successfully!`, 'success');
                closeProjectModal();
                location.reload(); // Refresh to show new data
            } else {
                showNotification(`Failed to ${isEdit ? 'update' : 'add'} project`, 'error');
            }
        } catch (error) {
            showNotification(`Error ${isEdit ? 'updating' : 'adding'} project`, 'error');
        }
    }

    async function deleteItem(type, id) {
        if (!confirm('Are you sure you want to delete this item?')) return;

        try {
            const response = await fetch(`/admin/${type}/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                showNotification('Item deleted successfully!', 'success');
                location.reload(); // Refresh to show updated data
            } else {
                showNotification('Failed to delete item', 'error');
            }
        } catch (error) {
            showNotification('Error deleting item', 'error');
        }
    }

    // Edit functions
    async function editEducation(id) {
        try {
            const response = await fetch(`/admin/educations/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const education = await response.json();
                currentEditId = id;
                currentEditType = 'education';

                // Populate modal with existing data
                document.querySelector('#educationModal input[placeholder*="Master"]').value = education.degree || '';
                document.querySelector('#educationModal input[placeholder*="Graphic"]').value = education.institution || '';
                document.querySelector('#educationModal input[type="date"]:first-of-type').value = education.start_date ? education.start_date.split('T')[0] : '';
                document.querySelector('#educationModal input[type="date"]:nth-of-type(2)').value = education.end_date ? education.end_date.split('T')[0] : '';
                document.querySelector('#educationModal input[type="checkbox"]').checked = education.is_present || false;
                document.querySelector('#educationModal input[placeholder*="Dehradun"]').value = education.location || '';
                document.querySelector('#educationModal select').value = education.icon_style || 'grad-cap';
                document.querySelector('#educationModal textarea').value = education.description || '';

                openEducationModal(true);
            }
        } catch (error) {
            showNotification('Error loading education data', 'error');
        }
    }

    async function editCertification(id) {
        console.log('editCertification called with id:', id);
        try {
            const response = await fetch(`/admin/certificates/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            console.log('Response status:', response.status);
            if (response.ok) {
                const certification = await response.json();
                console.log('Certification data:', certification);
                currentEditId = id;
                currentEditType = 'certification';

                // Populate modal with existing data
                document.querySelector('#certificationForm input[name="name"]').value = certification.name || '';
                document.querySelector('#certificationForm input[name="issuing_organization"]').value = certification.issuing_organization || '';
                document.querySelector('#certificationForm input[name="issue_date"]').value = certification.issue_date ? certification.issue_date.split('T')[0] : '';
                document.querySelector('#certificationForm select[name="view_type"]').value = certification.view_type || 'link';
                document.querySelector('#certificationForm input[name="credential_url"]').value = certification.credential_url || '';
                document.querySelector('#certificationForm input[name="certificate_image"]').value = certification.certificate_image || '';

                // Set selected icon
                document.querySelectorAll('#certIconPicker .icon-option').forEach(el => el.classList.remove('selected'));
                const selectedIcon = document.querySelector(`#certIconPicker [data-icon="${certification.icon}"]`);
                if (selectedIcon) {
                    selectedIcon.classList.add('selected');
                    document.getElementById('selectedIcon').value = certification.icon;
                }

                toggleCertViewType(); // Update visibility
                openCertificationModal(true);
            } else {
                console.error('Response not ok:', response);
                const errorText = await response.text();
                console.error('Error response:', errorText);
            }
        } catch (error) {
            console.error('Error in editCertification:', error);
            showNotification('Error loading certification data', 'error');
        }
    }

    async function editProject(id) {
        try {
            const response = await fetch(`/admin/projects/${id}`, {
                headers: {
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                const project = await response.json();
                currentEditId = id;
                currentEditType = 'project';

                // Populate modal with existing data
                document.querySelector('#projectModal input[placeholder*="Smart"]').value = project.title || '';
                document.querySelector('#projectModal select').value = project.category || 'web';
                document.querySelector('#projectModal textarea').value = project.description || '';
                document.querySelector('#projectModal input[placeholder*="Python"]').value = project.technologies || '';
                document.querySelector('#projectModal input[type="url"]:first-of-type').value = project.github_url || '';
                document.querySelector('#projectModal input[type="url"]:last-of-type').value = project.live_url || '';

                openProjectModal(true);
            }
        } catch (error) {
            showNotification('Error loading project data', 'error');
        }
    }

    // Inline edit functionality for sections without modals
    async function saveKeyMetrics() {
        console.log('=== saveKeyMetrics STARTED ===');
        console.log('Save Key Metrics button clicked');

        const metricsSection = document.getElementById('metrics-section');
        const inputs = metricsSection.querySelectorAll('input[data-metric-id]');

        console.log('Found inputs:', inputs.length);

        // Group inputs by metric ID
        const metricsData = {};
        inputs.forEach(input => {
            const metricId = input.getAttribute('data-metric-id');
            const field = input.getAttribute('data-field');
            const value = input.value.trim();

            console.log(`Input - ID: ${metricId}, Field: ${field}, Value: "${value}"`);

            if (!metricsData[metricId]) {
                metricsData[metricId] = {};
            }
            metricsData[metricId][field] = value;
        });

        console.log('Grouped data:', metricsData);

        // Send update requests for each metric
        const promises = Object.keys(metricsData).map(async (metricId) => {
            console.log(`Sending update for metric ${metricId}:`, metricsData[metricId]);

            const data = {
                value: metricsData[metricId].value || '',
                label: metricsData[metricId].label || '',
                order: metricsData[metricId].order || ''
            };

            console.log(`JSON data for ${metricId}:`, data);

            return fetch(`/admin/key-metrics/${metricId}`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(data)
            });
        });

        try {
            const responses = await Promise.all(promises);
            console.log('All responses:', responses.map(r => ({ status: r.status, ok: r.ok })));

            const allSuccessful = responses.every(response => response.ok);

            if (allSuccessful) {
                showNotification('Key metrics updated successfully!', 'success');
            } else {
                showNotification('Failed to update some key metrics', 'error');
            }
        } catch (error) {
            console.log('Error:', error);
            showNotification('Error updating key metrics', 'error');
        }
    }

    async function saveContactInfo() {
        const formData = new FormData();
        const contactSection = document.getElementById('contact-section');
        const inputs = contactSection.querySelectorAll('input');
        const textarea = contactSection.querySelector('textarea');

        formData.append('contact_email', inputs[0].value);
        formData.append('display_email', inputs[1].value);
        formData.append('heading_text', inputs[2].value);
        formData.append('subtext', textarea.value);

        try {
            const response = await fetch('/admin/contacts/1', {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: formData
            });

            if (response.ok) {
                showNotification('Contact info updated successfully!', 'success');
            } else {
                showNotification('Failed to update contact info', 'error');
            }
        } catch (error) {
            showNotification('Error updating contact info', 'error');
        }
    }

    // Form submission handlers
    document.addEventListener('DOMContentLoaded', function() {
        // Check for hash in URL on page load
        const hash = window.location.hash.substring(1); // Remove the '#'
        if (hash && ['hero', 'metrics', 'experience', 'education', 'certifications', 'projects', 'categories', 'contact', 'skills', 'skill-categories', 'messages'].includes(hash)) {
            showSection(hash, false);
        } else {
            // Default to hero section and set initial state
            history.replaceState({section: 'hero'}, '', '#hero');
        }

        // Show save button for hero section (default active)
        document.getElementById('saveChanges').classList.remove('hidden');

        // Hero save button
        document.getElementById('saveChanges').addEventListener('click', saveHeroData);


        const contactSection = document.getElementById('contact-section');
        if (contactSection) {
            const saveBtn = document.createElement('button');
            saveBtn.textContent = 'Save Contact Info';
            saveBtn.className = 'bg-gold-400 hover:bg-gold-500 text-black font-bold py-2 px-6 rounded-lg text-sm transition-colors shadow-[0_0_15px_rgba(255,215,0,0.2)] mt-4';
            saveBtn.onclick = saveContactInfo;
            contactSection.querySelector('.admin-card').appendChild(saveBtn);
        }

        // Education modal save
        document.querySelector('#educationModal button:last-child').addEventListener('click', function(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('degree', document.querySelector('#educationModal input[placeholder*="Master"]').value);
            formData.append('institution', document.querySelector('#educationModal input[placeholder*="Graphic"]').value);
            formData.append('start_date', document.querySelector('#educationModal input[type="date"]:first-of-type').value);
            formData.append('end_date', document.querySelector('#educationModal input[type="date"]:nth-of-type(2)').value);
            formData.append('is_present', document.querySelector('#educationModal input[type="checkbox"]').checked ? '1' : '0');
            formData.append('location', document.querySelector('#educationModal input[placeholder*="Dehradun"]').value);
            formData.append('icon_style', document.querySelector('#educationModal select').value);
            formData.append('description', document.querySelector('#educationModal textarea').value);
            const isEdit = currentEditType === 'education';
            saveEducation(formData, isEdit);
            currentEditId = null;
            currentEditType = null;
        });


        // Project modal save
        document.querySelector('#projectModal button:last-child').addEventListener('click', function(e) {
            e.preventDefault();
            const formData = new FormData();
            formData.append('title', document.querySelector('#projectModal input[placeholder*="Smart"]').value);
            formData.append('category', document.querySelector('#projectModal select').value);
            formData.append('description', document.querySelector('#projectModal textarea').value);
            formData.append('technologies', document.querySelector('#projectModal input[placeholder*="Python"]').value);
            formData.append('github_url', document.querySelector('#projectModal input[type="url"]:first-of-type').value);
            formData.append('live_url', document.querySelector('#projectModal input[type="url"]:last-of-type').value);
            const isEdit = currentEditType === 'project';
            saveProject(formData, isEdit);
            currentEditId = null;
            currentEditType = null;
        });

        // Edit button handlers
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-edit-type="education"]')) {
                const id = e.target.closest('[data-edit-type="education"]').getAttribute('data-id');
                editEducation(id);
            } else if (e.target.closest('[data-edit-type="certification"]')) {
                const id = e.target.closest('[data-edit-type="certification"]').getAttribute('data-id');
                editCertification(id);
            } else if (e.target.closest('[data-edit-type="project"]')) {
                const id = e.target.closest('[data-edit-type="project"]').getAttribute('data-id');
                editProject(id);
            }
        });

        // Delete button handlers
        document.addEventListener('click', function(e) {
            if (e.target.closest('[data-delete-type]')) {
                e.preventDefault();
                const deleteBtn = e.target.closest('[data-delete-type]');
                const type = deleteBtn.getAttribute('data-delete-type');
                const id = deleteBtn.getAttribute('data-id');
                deleteItem(type, id);
            }
        });
    });
</script>