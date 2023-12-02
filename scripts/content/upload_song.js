import { setHeaderMessage } from '../header.js'
import { changeContent } from '../index.js'
import { setupYourSongsPage } from './your_songs.js'

const uploadSong = (sender) => {
	const fileInput = document.getElementById('file-input')
	const file = fileInput.files[0]
	console.log('file: ', file)
	if (!file) {
		return
	}

	const songName = document.getElementById('text-input').value
	console.log('song-name: ', songName)
	if (!songName) {
		return
	}

	const pictureInput = document.getElementById('picture-input')
	let pictureFile = pictureInput.files[0]
	if (!pictureFile) {
		pictureFile = 'default'
	}
	console.log('picture-path: ', pictureFile)

	const formData = new FormData()
	formData.append('create-song', 1)
	formData.append('type', 'song')
	formData.append('picture-file', pictureFile)
	formData.append('song-file', file)
	formData.append('song-name', songName)

	fetch('./php/db/songs.php', {
		method: 'POST',
		body: formData,
	})
		.then((response) => response.text())
		.then((result) => console.log(result))
		.catch((error) => console.error(error))

	return new Promise((resolve, reject) => {
		changeContent('./php/content/your_songs.php').then((response) => {
			setupYourSongsPage()
		})
		resolve()
	})
}

const updateSong = async (sender) => {
	const songId = sender.getAttribute('data-song-id')
	console.log(songId)

	const songName = document.getElementById('text-input').value
	console.log('song-name: ', songName)
	if (!songName) {
		return
	}

	const pictureInput = document.getElementById('picture-input')
	const pictureFile = pictureInput.files[0]
	console.log('picture-path: ', pictureFile)

	let songFile = document.getElementById('file-input').files[0]
	if (!songFile) songFile = null

	const formData = new FormData()
	formData.append('update-song', 1)
	formData.append('type', 'song')
	if (!!pictureFile) {
		formData.append('picture-file', pictureFile)
	}
	if (!!songFile) {
		formData.append('song-file', songFile)
	}
	formData.append('song-name', songName)
	formData.append('song-id', songId)

	console.dir(formData)

	fetch('./php/db/songs.php', {
		method: 'POST',
		body: formData,
	})
		.then((response) => response.text())
		.then((result) => {
			console.log(result)
		})
		.then(async (_) => {
			await changeContent('./php/content/your_songs.php')
			setupYourSongsPage()
		})
		.catch((err) => console.error(err))
}

document.addEventListener('click', (event) => {
	const target = event.target

	if (target.id === 'upload-song-button') {
		uploadSong(target)
	} else if (target.id === 'update-song-button') {
		console.log('click')
		updateSong(target)
	}
})
