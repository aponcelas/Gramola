let curr_song = new Audio();
let track_art = document.querySelector('.track-art');
let repeat_btn = document.querySelector('.repeat-track');
let prev_btn = document.querySelector('.prev-track');
let playpause_btn = document.querySelector('.playpause-track');
let next_btn = document.querySelector('.next-track');
let random_btn = document.querySelector('.random-track');
let seek_slider = document.querySelector('.seek-slider');
let curr_time = document.querySelector('.current-time');
let total_duration = document.querySelector('.total-duration');
let selected_playlist = document.querySelector('#selected_playlist');
let selected_song = document.querySelector('#selected_track');
let song_index = 0;
let isPlaying = false;
let isRandom = false;
let updateTimer = 0;

//Funcions

function loadTrack(trackIndex) {
    clearInterval(updateTimer);
    reset();

    curr_song.src = musicList[trackIndex].url;   

    curr_song.load();

    track_art.style.backgroundImage = "url(" + musicList[trackIndex].cover + ")";
    track_art.style.backgroundSize = "250px 250px";

    updateTimer = setInterval(updateTimeSeekSlider, 1000);

}

function reset() {
    curr_time.textContent = "0:00";
    total_duration.textContent = "0:00";
    seek_slider.value = 0;
}

function updateTimeSeekSlider() {
    if (!isNaN(curr_song.duration)) {
        let seekPosition = (curr_song.currentTime / curr_song.duration) * 100;
        seek_slider.value = seekPosition;

        let currentMinutes = Math.floor(curr_song.currentTime / 60);
        let currentSeconds = Math.floor(curr_song.currentTime % 60);

        let durationMinutes = Math.floor(curr_song.duration / 60);
        let durationSeconds = Math.floor(curr_song.duration % 60);

        curr_time.textContent = currentMinutes + ":" + currentSeconds.toString().padStart(2,'0');
        total_duration.textContent = durationMinutes + ":" + durationSeconds.toString().padStart(2, '0');
    }
}

function prevTrack() {
    if (song_index > 0) {
        song_index -= 1;
    } else {
        song_index = musicList.length - 1;
    }
}



function nextTrack() {
    if (song_index < musicList.length - 1 && !isRandom) {
        song_index += 1;
    } else if (song_index < musicList.length && isRandom) {
        let random_index = Math.floor(Math.random() * musicList.length);
        song_index = random_index;
    } else {
        song_index = 0;
    }
}


function playTrack() {
    curr_song.play();
    isPlaying = true;
    playpause_btn.innerHTML = '<i class="fa fa-pause-circle fa-2x"></i>';
    document.querySelector('.boxContainer').classList.remove('hidden');
}

function pauseTrack() {
    curr_song.pause();
    isPlaying = false;
    playpause_btn.innerHTML = '<i class="fa fa-play-circle fa-2x"></i>';
    document.querySelector('.boxContainer').classList.add('hidden');
}



//Events

curr_song.addEventListener('ended', function() {
    nextTrack();
    loadTrack(song_index);
    playTrack();
});

selected_playlist.addEventListener('change', function () {
    let selectedPlaylist = selected_playlist.value;
    window.location.href = 'index.php?selected_playlist=' + selectedPlaylist;
});

selected_song.addEventListener('change', function () {
    let selectedSong = parseInt(selected_song.value);
    if (!isNaN(selectedSong)) {
        song_index = selectedSong;
        loadTrack(song_index);
        playTrack();
    }
});


repeat_btn.addEventListener('click', function() {
    if (isPlaying || !isPlaying) {
        curr_song.currentTime = 0;
        seek_slider.value = 0;
        curr_time.textContent = "0:00";
    }
});


random_btn.addEventListener('click', function() {
    if (isRandom) {
        isRandom = false;
        random_btn.classList.remove('randomActive');
    } else {
        isRandom = true;
        random_btn.classList.add('randomActive');
    }
});


playpause_btn.addEventListener('click', function() {
    if (isPlaying) {
        pauseTrack();
    } else {
        playTrack();
    }
});

prev_btn.addEventListener('click', function() {
    prevTrack();
    loadTrack(song_index);
    playTrack();
});

next_btn.addEventListener('click', function() {
    nextTrack();
    loadTrack(song_index);
    playTrack();
});

seek_slider.addEventListener('change', function() {
    let seekToTime = curr_song.duration * (seek_slider.value / 100);
    curr_song.currentTime = seekToTime;
})

loadTrack(song_index);