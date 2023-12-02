export let songsQueue = []
export let currentSong = null
export let previousSongsQueue = []

export const audioPlayer = document.getElementById('audio-player')
export const controlsSlider = document.getElementById('song-time-slider')

export const controlsPlayPrevButton = document.getElementById('play-prev-button')
export const controlsPlayNextButton = document.getElementById('play-next-button')

export const songNameLabel = document.getElementById('song-name')
export const songAuthorLabel = document.getElementById('song-artist')
export const songImage = document.getElementById('song-image')

export const controlsPlayPauseButton = document.getElementById('play-pause-button')
controlsPlayPauseButton.addEventListener('click', () => {
	if (audioPlayer.readyState <= 0) return

	if (!audioPlayer.paused) {
		audioPlayer.pause()
	} else {
		audioPlayer.play()
	}
})

controlsSlider.addEventListener('input', () => {
	audioPlayer.currentTime = parseInt(controlsSlider.value)
})

audioPlayer.addEventListener('loadedmetadata', () => {
	controlsSlider.max = audioPlayer.duration
})

audioPlayer.addEventListener('timeupdate', () => {
	controlsSlider.value = audioPlayer.currentTime
})

export const updateControlsStatus = () => {
	controlsPlayPrevButton.className = 'bx bx-skip-previous '
	controlsPlayNextButton.className = 'bx bx-skip-next '
	if (songsQueue.length === 0) {
		controlsPlayNextButton.className += 'not-enabled'
	}
}

export const playPrevSong = () => {
	let previousSong = previousSongsQueue.pop()

	console.table(previousSong)

	if (previousSong !== undefined) {
		songsQueue = [previousSong, currentSong, ...songsQueue]
	} else if (currentSong !== null) {
		songsQueue = [currentSong, ...songsQueue]
	} else return

	currentSong = null
	playNextSong()
}

export const playNextSong = () => {
	document.getElementById('current-details').style.display = 'flex'

	if (songsQueue.length > 0) {
		if (currentSong !== null) previousSongsQueue.push(currentSong)
		currentSong = songsQueue.shift()
		playSong()
	}
}

audioPlayer.addEventListener('pause', () => {
	controlsPlayPauseButton.className = 'bx bx-play'
})

audioPlayer.addEventListener('play', () => {
	controlsPlayPauseButton.className = 'bx bx-pause'
})

export const playSong = () => {
	console.table('now playing: ', currentSong)

	audioPlayer.src = currentSong['song_path']
	audioPlayer.load()

	audioPlayer.play()

	updateControlsStatus()

	songNameLabel.innerText = currentSong['name']
	songAuthorLabel.innerText = currentSong['author']
	songImage.src = currentSong['picture_path']
}

audioPlayer.addEventListener('ended', () => {
	console.table(songsQueue)
	playNextSong()
})

export const enqueueSong = (id) => {
	fetch(`php/db/songs.php?song-id=${id}`, {
		method: 'GET',
	})
		.then((response) => response.text())
		.then((text) => {
			const song = JSON.parse(text)
			songsQueue.push(song)

			console.log('--active queue--')
			console.table(songsQueue)
			console.log('----------------')

			updateControlsStatus()

			if (audioPlayer.ended || isNaN(audioPlayer.duration) || audioPlayer.duration === audioPlayer.currentTime) {
				playNextSong()
			}
		})
		.catch((err) => console.error(err))
}

controlsPlayPrevButton.addEventListener('click', playPrevSong)
controlsPlayNextButton.addEventListener('click', playNextSong)

document.addEventListener('DOMContentLoaded', () => {
	updateControlsStatus()

	document.getElementById('current-details').style.display = 'none'
})
