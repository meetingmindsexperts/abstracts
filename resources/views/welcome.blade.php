@extends('layouts.main')

@section('content')
<style>
progress {
    height: 10px;
    margin-top: 10px;
}
</style>

<!-- Submission Form -->
<form class="py-5" id="submitForm" method="POST" action="{{ route('submit.form') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email:</label>
        <input type="email" class="form-control" id="email" name="email" required placeholder="Enter the email used while submitting the abstract">
    </div>

    <div class="mb-3">
        <label for="paper_number" class="form-label">Paper Number:</label>
        <input type="number" class="form-control" id="paper_number" name="paper_number" required placeholder="Enter Paper number">
    </div>

    <div class="mb-3">
        <label for="video" class="form-label">Video Upload:</label>
        <input type="file" class="form-control" id="video" name="video" accept="video/*" required placeholder="Upload the video file" onchange="handleFileSelect(event)">
        <progress id="fileProgress" value="0" max="100" style="display: none;"></progress>
        <span id="progressPercent" style="display: none;">0%</span>
    </div>

    <button type="submit" class="btn btn-primary px-4 my-2">Submit</button>
</form>

@endsection

@section('scripts')
<script>
function handleFileSelect(event) {
    const file = event.target.files[0];
    const progressBar = document.getElementById('fileProgress');
    const progressPercent = document.getElementById('progressPercent');

    if (file) {
        const formData = new FormData();
        formData.append('video', file);
        formData.append('email', document.getElementById('email').value);
        formData.append('paper_number', document.getElementById('paper_number').value);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', "{{ route('submit.form') }}", true);
        xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');

        xhr.upload.addEventListener('progress', function(e) {
            if (e.lengthComputable) {
                const percentComplete = Math.round((e.loaded / e.total) * 100);
                progressBar.value = percentComplete;
                progressPercent.textContent = percentComplete + '%';
            }
        }, false);

        xhr.addEventListener('load', function() {
            if (xhr.status === 200) {
                console.log('Success:', JSON.parse(xhr.responseText));
                // Redirect or show thank you message as needed
            } else {
                console.error('Error:', xhr.statusText);
            }
        });

        xhr.addEventListener('error', function() {
            console.error('Error:', xhr.statusText);
        });

        xhr.addEventListener('abort', function() {
            console.error('Upload aborted.');
        });

        progressBar.style.display = 'block'; // Show progress bar
        progressPercent.style.display = 'inline'; // Show progress percent
        xhr.send(formData);
    }
}

// Function to reset progress bar on page load or when needed
function resetProgressBar() {
    const progressBar = document.getElementById('fileProgress');
    const progressPercent = document.getElementById('progressPercent');
    progressBar.style.display = 'none';
    progressBar.value = 0;
    progressPercent.style.display = 'none';
    progressPercent.textContent = '0%';
}

// Reset progress bar when page loads
document.addEventListener('DOMContentLoaded', resetProgressBar);
</script>
@endsection