<x-app-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-r from-gray-800 via-gray-900 to-black py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-gray-800 p-8 rounded-lg shadow-md">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-white">Upload an Image to Detect Your Mood</h2>
                <p class="mt-2 text-sm text-gray-300">Upload an image to detect your mood and get a recommended playlist.</p>
            </div>
            <form id="moodForm" class="mt-8 space-y-6" enctype="multipart/form-data" action="#" method="POST">
                @csrf

                <!-- Image Upload Section -->
                <div>
                    <label for="image" class="block text-sm font-medium text-gray-300">Upload Your Image</label>
                    <input type="file" id="image" name="image" required class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-700 bg-gray-700 text-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>

                <!-- Mood-Based Playlist Display -->
                <div id="playlistDisplay" class="hidden mt-4">
                    <h3 class="text-lg font-medium text-white">Recommended Playlist:</h3>
                    <p id="playlistLink" class="mt-2 text-sm text-gray-300"></p>
                    <img id="playlistImage" src="" alt="" class="mt-2 rounded-lg hidden" />
                </div>

                <button type="submit" class="w-full py-2 px-4 bg-indigo-600 text-white rounded-md">Detect Mood</button>
            </form>
        </div>
    </div>

    <!-- JavaScript to handle image upload and mood detection -->
    <script>
        // Listen for form submission
        document.getElementById('moodForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent normal form submission

            const formData = new FormData();
            const image = document.getElementById('image').files[0];
            formData.append('image', image);

            // Perform the fetch request to the server to detect the mood
            fetch('{{ route("mood.detect") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const mood = data.mood; // Assuming the server sends a 'mood' key
                showPlaylist(mood);
            })
            .catch(error => {
                console.error('Error detecting mood:', error);
            });
        });

        function showPlaylist(mood) {
            const playlistDisplay = document.getElementById('playlistDisplay');
            const playlistLink = document.getElementById('playlistLink');
            const playlistImage = document.getElementById('playlistImage');

            // Define playlists and images based on moods
            const playlists = {
                happy: {
                    link: 'https://open.spotify.com/playlist/0RH319xCjeU8VyTSqCF6M4',
                    image: 'https://rachelziv.com.au/wp-content/uploads/2020/01/happy.jpg' // Happy playlist image
                },
                sad: {
                    link: 'https://open.spotify.com/playlist/37i9dQZF1EIh4v230xvJvd', // Sad playlist link
                    image: 'https://static.vecteezy.com/system/resources/thumbnails/034/381/072/small_2x/blue-toy-and-alone-a-sad-emotion-on-a-rainy-day-with-a-natural-background-ai-generated-photo.jpg' // Sad playlist image
                },
                energetic: {
                    link: 'https://open.spotify.com/playlist/37i9dQZF1DX0vHZ8elq0UK',
                    image: 'https://www.indiancurrents.org/files/issue/energetic.jpg' // Replace with actual image URL
                },
                relaxed: {
                    link: 'https://open.spotify.com/playlist/6EIVswdPfoE9Wac7tB6FNg',
                    image: 'https://synctuition.com/wp-content/uploads/2021/08/Webp.net-compress-image-35.jpg' // Replace with actual image URL
                },
            };

            if (playlists[mood]) {
                // Set the link to open in a new tab
                playlistLink.innerHTML = `<a href="${playlists[mood].link}" target="_blank" class="text-blue-400 underline">${playlists[mood].link}</a>`;
                
                playlistImage.src = playlists[mood].image;
                playlistImage.alt = `${mood.charAt(0).toUpperCase() + mood.slice(1)} Playlist Cover`;
                playlistImage.classList.remove('hidden'); // Show the image
                playlistDisplay.classList.remove('hidden');
            } else {
                playlistDisplay.classList.add('hidden');
                playlistImage.classList.add('hidden'); // Hide the image if no mood is selected
            }
        }
    </script>
</x-app-layout>
