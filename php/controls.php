<div class="controls">
    <div class="current-content">
        <div class="current">
            <div class="current-details" id="current-details">
                <!-- <img src="" alt=""> -->
                <!-- <i class="bx bx-music"></i> -->
                <div class="image-container">
                    <img src="" alt="song picture" id="song-image">
                </div>
                <div class="current-name-author">
                    <div class="current-name" id="song-name">current-song</div>
                    <div class="current-author" id="song-artist">current-artist</div>
                </div>
            </div>
        </div>
    </div>

    <input type="range" id="song-time-slider" min="0" value="0" max="0">

    <div class="controls-container">
        <i class='bx bx-skip-previous' id="play-prev-button"></i>
        <i class='bx bx-play' id="play-pause-button"></i>
        <i class='bx bx-skip-next' id="play-next-button"></i>
    </div>

    <audio id="audio-player" controls>
        <source type="audio/mp3">
        Your browser does not support the audio element.
    </audio>
</div>
</div>