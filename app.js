let now_playing = document.querySelector('.now-playing');
let track_art = document.querySelector('.track-art');

let playpause_btn = document.querySelector('.playpause-track');
let next_btn = document.querySelector('.next-track');
let prev_btn = document.querySelector('.prev-track');

let seek_slider = document.querySelector('.seek-slider');
let curr_time = document.querySelector('.current-time');
let total_duration = document.querySelector('.total-duration');

let curr_track = document.createElement('audio');

let randomIcon = document.querySelector('.fa-random');

let track_index = 0;
let isPlaying = false;
let isRandom = false;
let updateTimer;

function loadTrack(trackIndex) {
    clearInterval(updateTimer);
    reset();

    curr_track.src = musicList[trackIndex].url;   

    curr_track.load();

    track_art.style.backgroundImage = "url(" + musicList[trackIndex].cover + ")";
    track_art.style.backgroundSize = "cover";

    updateTimer = setInterval(setUpdate, 1000);
}

function handleTrackEnded() {
    nextTrack();
}

function reset() {
    curr_time.textContent = "00:00";
    total_duration.textContent = "00:00";
    seek_slider.value = 0;
}

function randomTrack() {
    isRandom ? pauseRandom() : playRandom();
}

function playRandom() {
    isRandom = true;
    randomIcon.classList.add('randomActive');
}

function pauseRandom() {
    isRandom = false;
    randomIcon.classList.remove('randomActive');
}

function playpauseTrack() {
    isPlaying ? pauseTrack() : playTrack();
}

function playTrack() {
    curr_track.play();
    isPlaying = true;
    playpause_btn.innerHTML = '<i class="fa fa-pause-circle fa-2x"></i>';
}

function pauseTrack() {
    curr_track.pause();
    isPlaying = false;
    playpause_btn.innerHTML = '<i class="fa fa-play-circle fa-2x"></i>';
}

function nextTrack() {
    if (track_index < musicList.length - 1 && !isRandom) {
        track_index += 1;
    } else if (track_index < musicList.length && isRandom) {
        let random_index = Math.floor(Math.random() * musicList.length);
        track_index = random_index;
    } else {
        track_index = 0;
    }
    loadTrack(track_index);
    playTrack();
}

function prevTrack() {
    if (track_index > 0) {
        track_index -= 1;
    } else {
        track_index = musicList.length - 1;
    }
    loadTrack(track_index);
    playTrack();
}

function seekTo() {
    let seekToTime = curr_track.duration * (seek_slider.value / 100);
    curr_track.currentTime = seekToTime;
}

function setUpdate() {
    if (!isNaN(curr_track.duration)) {
        let seekPosition = (curr_track.currentTime / curr_track.duration) * 100;
        seek_slider.value = seekPosition;

        let currentMinutes = Math.floor(curr_track.currentTime / 60);
        let currentSeconds = Math.floor(curr_track.currentTime % 60);

        let durationMinutes = Math.floor(curr_track.duration / 60);
        let durationSeconds = Math.floor(curr_track.duration % 60);

        curr_time.textContent = `${currentMinutes}:${currentSeconds.toString().padStart(2, '0')}`;
        total_duration.textContent = `${durationMinutes}:${durationSeconds.toString().padStart(2, '0')}`;
    }
}

loadTrack(track_index);


