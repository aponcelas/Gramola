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

const music_list = [
    {
        title : "Monkey Island Theme",
        artist : "Michael Land",
        url : "https://scummbar.com/mi2/MI1-CD/01%20-%20Opening%20Themes%20-%20Introduction.mp3",
        cover : "https://i.pinimg.com/736x/a0/ab/a3/a0aba31e914af8e98b040578a09e6f64--lucas-arts-power-glove.jpg"
    },

    {
        title : "The SCUMM Bar",
        artist : "Michael Land",
        url : "https://scummbar.com/mi2/MI1-CD/03%20-%20The%20Scumm%20Bar.mp3",
        cover : "https://static.wikia.nocookie.net/fictionalcompanies/images/4/4f/The-secret-of-monkey-island-bar-ship-vector-wallpaper.jpg"
    },
    
    {
        title : "LeChuck's Theme",
        artist : "Michael Land",
        url : "https://scummbar.com/mi2/MI1-CD/04%20-%20LeChuck's%20Theme.mp3",
        cover : "https://i1.sndcdn.com/artworks-a9B54x3Cyl2IDH1U-J3T1YA-t500x500.jpg"
    }
];

function loadTrack(trackIndex) {
    clearInterval(updateTimer);
    reset();

    curr_track.src = music_list[trackIndex].url;

    curr_track.addEventListener('loadedmetadata', handleMetadataLoaded);
    curr_track.load();

    track_art.style.backgroundImage = "url(" + music_list[trackIndex].cover + ")";

    updateTimer = setInterval(setUpdate, 1000);
    
    curr_track.addEventListener('ended', handleTrackEnded);
}

function handleMetadataLoaded() {
    let durationMinutes = Math.floor(curr_track.duration / 60);
    let durationSeconds = Math.floor(curr_track.duration % 60);

    if (!isNaN(durationMinutes) && !isNaN(durationSeconds)) {
        total_duration.textContent = `${durationMinutes}:${durationSeconds.toString().padStart(2, '0')}`;
    }
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
    if (track_index < music_list.length - 1 && !isRandom) {
        track_index += 1;
    } else if (track_index < music_list.length && isRandom) {
        let random_index = Math.floor(Math.random() * music_list.length);
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
        track_index = music_list.length - 1;
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


