// Creem l'instancia de l'objecte Audio
let curr_song = new Audio();

// Selecció dels elements per fer les diferents funcionalitats 
let track_art = document.querySelector('.track-art');
let repeat_btn = document.querySelector('.repeat-song');
let prev_btn = document.querySelector('.prev-song');
let playpause_btn = document.querySelector('.playpause-song');
let next_btn = document.querySelector('.next-song');
let random_btn = document.querySelector('.random-song');
let seek_slider = document.querySelector('.seek-slider');
let curr_time = document.querySelector('.current-time');
let total_duration = document.querySelector('.total-duration');
let selected_playlist = document.querySelector('#selected_playlist');
let selected_song = document.querySelector('#selected_song');

// Declaració de variables
let song_index = 0;
let isPlaying = false;
let updateTimer = 0;

function loadTrack(indexTrack) {
    clearInterval(updateTimer);
    reset();

    // Establim la cançó i la carreguem
    curr_song.src = musicList[indexTrack].url;   
    curr_song.load();

    // Cargar de cover per la art-box
    track_art.style.backgroundImage = "url(" + musicList[indexTrack].cover + ")";
    track_art.style.backgroundSize = "250px 250px";

    // Iniciem un nou temporitzador
    updateTimer = setInterval(updateTimeSeekSlider, 1000);

}

// Funció que restableix la informació del temps i de la barra de reproducció
function reset() {
    curr_time.textContent = "0:00";
    total_duration.textContent = "0:00";
    seek_slider.value = 0;
}

// Funció que actualitza el temps de la barra de reproducció
function updateTimeSeekSlider() {

    let seekPosition = (curr_song.currentTime / curr_song.duration) * 100; // Calculem la posició del reproductor
    seek_slider.value = seekPosition; // Actualitzem el valor de la barra de reproducció

    // Calculem els minuts i segons en temps real de la cançó
    let currentMinutes = Math.floor(curr_song.currentTime / 60);
    let currentSeconds = Math.floor(curr_song.currentTime % 60);

    // Calculem el minuts i segons totals de la cançó
    let durationMinutes = Math.floor(curr_song.duration / 60);
    let durationSeconds = Math.floor(curr_song.duration % 60);

    // Mostrem els temps real i total amb el format 0:00
    curr_time.textContent = currentMinutes + ":" + currentSeconds.toString().padStart(2,'0');
    total_duration.textContent = durationMinutes + ":" + durationSeconds.toString().padStart(2, '0');
}

// Funció per canviar l'index a l'anterior cançó
function prevSong() {

    // Si l'index es mes gran a 0, restem -1 a l'index, sino index = ultima posició de la playlist
    (song_index > 0) ? song_index -= 1 : song_index = musicList.length - 1;
}

// Funció per avançar a la següent cançó
function nextSong() {

    // Si l'index es mes petit a la longitud de la playlist, sumem +1 al index, sino index = primera posició de la playlist
    (song_index < musicList.length - 1) ? song_index += 1 : song_index = 0;
}

// Funció per iniciar la reproducció
function playSong() {
    curr_song.play(); // Iniciem la reproducció
    isPlaying = true; // Booleà per controlar el play-pause
    playpause_btn.innerHTML = '<i class="fa fa-pause-circle fa-2x"></i>'; // Canviem el botó de play pel de pausa
    document.querySelector('.boxContainer').classList.remove('hidden'); // Mostrem el Sound Wave
}

// Funció per para la reproducció
function pauseSong() {
    curr_song.pause(); // Parem la reproducció
    isPlaying = false; // Booleà per controlar el play-pause
    playpause_btn.innerHTML = '<i class="fa fa-play-circle fa-2x"></i>'; // Canviem el botó de pausa pel de play
    document.querySelector('.boxContainer').classList.add('hidden'); // Amagem el Sound Wave
}

// Event que al finalitzar una cançó canvii a la següent cançó
curr_song.addEventListener('ended', function() {
    nextSong();
    loadTrack(song_index);
    playSong();
});

// Event per poder canviar de playlis
selected_playlist.addEventListener('change', function () {
    let selectedPlaylist = selected_playlist.value;
    window.location.href = 'index.php?selected_playlist=' + selectedPlaylist;
});

// Event per poder canviar de cançó
selected_song.addEventListener('change', function () {
    song_index = parseInt(selected_song.value);
    loadTrack(song_index);
    playSong();
});

// Event que al fer click reinicia la cançó
repeat_btn.addEventListener('click', function() {
    curr_song.currentTime = 0;
    seek_slider.value = 0;
    curr_time.textContent = "0:00";  
});

// Event que al fer click canvia entre play i pausa
playpause_btn.addEventListener('click', function() {
    isPlaying ? pauseSong() : playSong();
});

// Event que al fer click canvia a la cancó anterior
prev_btn.addEventListener('click', function() {
    prevSong();
    loadTrack(song_index);
    playSong();
});

// Event que al fer click canvia a la següent cançó
next_btn.addEventListener('click', function() {
    nextSong();
    loadTrack(song_index);
    playSong();
});

// Event que al fer click posa una musica al atzar
random_btn.addEventListener('click', function() {
    song_index = Math.floor(Math.random() * musicList.length);
    loadTrack(song_index);
    playSong();
});

// Event que al modificar la posició de la barra de reproducció, l'audio s'ajusta a la posició de la barra de reproducció
seek_slider.addEventListener('change', function() {
    let seekToTime = curr_song.duration * (seek_slider.value / 100);
    curr_song.currentTime = seekToTime;
})

// Event per caregar la primera cançó
window.addEventListener("load", loadTrack(song_index));