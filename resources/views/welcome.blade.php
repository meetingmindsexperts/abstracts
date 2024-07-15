@extends('layouts.main')

@section('content')
<style>
progress {
    height: 10px;
    margin-top:10px;
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
    </div>

    <button type="submit" class="btn btn-primary px-4 my-2">Submit</button>
</form>

@endsection

@section('scripts')
<script>
    function handleFileSelect(event) {
        const file = event.target.files[0];
        const progressBar = document.getElementById('fileProgress');

        if (file) {
            const formData = new FormData();
            formData.append('video', file);

            fetch("{{ route('submit.form') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                // Optional: Show progress of upload
                onUploadProgress: function(progressEvent) {
                    const { loaded, total } = progressEvent;
                    const percentCompleted = Math.round((loaded / total) * 100);
                    progressBar.value = percentCompleted;
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Success:', data);
                // Redirect or show thank you message as needed
            })
            .catch((error) => {
                console.error('Error:', error);
            });

            progressBar.style.display = 'block'; // Show progress bar
        }
    }

    // Function to reset progress bar on page load or when needed
    function resetProgressBar() {
        const progressBar = document.getElementById('fileProgress');
        progressBar.style.display = 'none';
        progressBar.value = 0;
    }

    // Reset progress bar when page loads
    document.addEventListener('DOMContentLoaded', resetProgressBar);

</script>
@endsection