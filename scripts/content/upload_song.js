import { setHeaderMessage } from '../header.js'
import { changeContent } from '../index.js'
import { setupHomepage } from './homepage.js'

const uploadSong = (target) => {
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

	new Promise(async () => {
		await changeContent('./php/content/homepage.php')
		await setupHomepage()
	})
}

document.addEventListener('click', (event) => {
	const target = event.target

	if (target.id === 'upload-song-button') {
		uploadSong(target)
	}
})
