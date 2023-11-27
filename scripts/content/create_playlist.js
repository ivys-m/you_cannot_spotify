import { changeContent } from '../index.js'
import { setupHomepage } from './homepage.js'

const createPlaylist = (sender) => {
	const input = document.getElementById('picture-input')
	const file = input.files[0]
	if (!file) {
		return
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

	new Promise(async () => {
		await changeContent('./php/content/homepage.php')
		await setupHomepage()
	})
}

document.addEventListener('click', (event) => {
	const target = event.target

	if (target.id === 'create-playlist-button') {
		createPlaylist(target)
	}
})
