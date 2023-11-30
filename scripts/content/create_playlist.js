import { changeContent } from '../index.js'
import { setupHomepage } from './homepage.js'

const createPlaylist = (sender) => {
	const input = document.getElementById('picture-input')
	let file = input.files[0]
	if (!file) {
		file = 'default'
	}

	const playlistName = document.getElementById('text-input').value
	console.log(playlistName)
	if (!playlistName) return

	const formData = new FormData()
	formData.append('create-playlist', 1)
	formData.append('type', 'playlist')
	formData.append('picture', file)
	formData.append('playlist-name', playlistName)

	fetch('./php/db/playlists.php', {
		method: 'POST',
		body: formData,
	})
		.then((response) => response.text())
		.then((result) => console.log(result))
		.catch((err) => console.error(err))

	new Promise(async (resolve, reject) => {
		await changeContent('./php/content/homepage.php')
		await setupHomepage()
		resolve()
	})
}

const updatePlaylist = (sender) => {
	const playlistId = sender.getAttribute('data-playlist-id')
	console.log(playlistId)

	const playlistName = document.getElementById('text-input').value
	console.log('playlist-name: ', playlistName)
	if (!playlistName) {
		return
	}

	const pictureInput = document.getElementById('picture-input')
	const pictureFile = pictureInput.files[0]
	console.log('picture-path: ', pictureFile)

	const formData = new FormData()
	formData.append('update-playlist', 1)
	formData.append('type', 'playlist')
	if (!!pictureFile) {
		formData.append('picture', pictureFile)
	}
	formData.append('playlist-name', playlistName)
	formData.append('playlist-id', playlistId)

	console.dir(formData)

	fetch('./php/db/playlists.php', {
		method: 'POST',
		body: formData,
	})
		.then((response) => response.text())
		.then((result) => {
			console.log(result)
			return new Promise(async (resolve, reject) => {
				await changeContent('./php/content/homepage.php')
				await setupHomepage()
				resolve()
			})
		})
}

document.addEventListener('click', (event) => {
	const target = event.target

	if (target.id === 'create-playlist-button') {
		createPlaylist(target)
	} else if (target.id === 'update-playlist-button') {
		console.log('mre')
		updatePlaylist(target)
	}
})
