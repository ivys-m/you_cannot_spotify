import { changeContent } from '../index.js'
import { setHeaderMessage } from '../header.js'
import { enqueueSong, songsQueue } from '../controls.js'

// bad, very bad
// i'm sorry
const allSongs = []

const resetUi = async () => {
	await changeContent('./php/content/playlist.php', {
		'id': document.getElementById('content-playlist-container').getAttribute('data-id'),
		'header-text': document.getElementById('playlist-name-label').innerText,
	})
	setupPlaylistPage()
}

const renderSong = (song) => {
	const songContainer = document.createElement('div')
	songContainer.className = 'song-container'

	const pictureContainer = document.createElement('div')
	pictureContainer.className = 'picture-container'

	const imageElement = document.createElement('img')
	imageElement.src = song['picture_path']
	imageElement.alt = song['name']

	pictureContainer.appendChild(imageElement)

	const textContainer = document.createElement('div')
	textContainer.className = 'text-container'

	const titleContainer = document.createElement('div')
	titleContainer.className = 'title-container'

	const titleElement = document.createElement('h4')
	titleElement.textContent = song['name']

	titleContainer.appendChild(titleElement)

	const authorContainer = document.createElement('div')
	authorContainer.className = 'author-container'

	const authorElement = document.createElement('h6')
	authorElement.textContent = song['author']

	authorContainer.appendChild(authorElement)

	textContainer.appendChild(titleContainer)
	textContainer.appendChild(authorContainer)

	const actionsContainer = document.createElement('div')
	actionsContainer.className = 'actions-container'

	const actionsIcon = document.createElement('i')
	actionsIcon.className = 'bx bx-list-plus'
	actionsIcon.id = 'song-actions'
	actionsIcon.setAttribute('data-song-id', song['id'])
	actionsIcon.onclick = () => {
		const playlistContainer = document.getElementById('content-playlist-container')
		const playlistId = playlistContainer.getAttribute('data-id')

		const formData = new FormData()
		formData.append('song-id', song['id'])
		formData.append('playlist-id', playlistId)
		formData.append('add', '1')

		fetch('./php/db/contains.php', {
			method: 'POST',
			body: formData,
		})
			.then((respose) => respose.text())
			.then((text) => {
				console.log(text)
				return text
			})
			.then((_) => resetUi())
	}

	actionsContainer.appendChild(actionsIcon)

	songContainer.appendChild(pictureContainer)
	songContainer.appendChild(textContainer)
	songContainer.appendChild(actionsContainer)

	document.getElementById('songs-outer-container').appendChild(songContainer)
}

export const setupPlaylistPage = () => {
	// very very bad
	// db di piccole dimensioni
	fetch('./php/db/songs.php?get-all=1', {
		method: 'GET',
	})
		.then((response) => response.text())
		.then((text) => {
			// console.log(text)
			return text
		})
		.then((text) => JSON.parse(text))
		.then((json) => {
			console.table(json)
			return json
		})
		.then((songs) => allSongs.push(...songs))

	playlistSetHeaderBackground()

	const deleteActions = document.querySelectorAll('#song-action-remove')
	deleteActions.forEach((deleteAction) =>
		deleteAction.addEventListener('click', () => {
			const songId = deleteAction.getAttribute('data-song-id')
			const playlistId = document.querySelector('.content-playlist-container').getAttribute('data-id')

			const formData = new FormData()
			formData.append('song-id', songId)
			formData.append('playlist-id', playlistId)
			formData.append('delete', '1')

			fetch('./php/db/contains.php', {
				method: 'POST',
				body: formData,
			})
				.then((response) => response.text())
				.then((text) => {
					console.log(text)
					return text
				})
				.then((_) => {
					const songsOuterContainer = document.getElementById('songs-outer-container')
					songsOuterContainer.removeChild(songsOuterContainer.querySelector(`[data-song-id="${songId}"]`))
				})
		}),
	)

	const header = document.querySelector('.content-playlist-container-header')

	const savedIcon = document.getElementById('saved-icons')
	savedIcon.addEventListener('click', () => {
		const saved = savedIcon.classList.contains('saved')
		const playlistContainer = document.querySelector('.content-playlist-container')
		const playlistId = playlistContainer.getAttribute('data-id')
		console.log(playlistId)

		const params = {
			'playlist-id': playlistId,
		}

		if (saved) {
			params['set-not-active'] = 1
		} else {
			params['set-active'] = 1
		}

		console.dir(params)

		fetch('php/db/saved.php', {
			method: 'POST',
			headers: {
				'Content-Type': 'application/json',
			},
			body: JSON.stringify(params),
		})
			.then((response) => response.text())
			.then((data) => {
				console.log(data)
				if (data === 'inactive') {
					savedIcon.classList = 'bx bx-heart'
				} else if (data === 'active') {
					savedIcon.classList = 'bx bxs-heart saved'
				}
			})
	})

	const editButton = document.getElementById('playlist-edit')
	editButton.addEventListener('click', async () => {
		const playlistId = editButton.getAttribute('data-playlist-id')

		await changeContent('./php/content/create_playlist.php', {
			'playlist-id': playlistId,
			'text-title': 'update playlist',
			'text-placeholder': 'playlist name',
			'playlist': '1',
		})
		setHeaderMessage(`update playlist`)
	})

	const searchButton = document.getElementById('playlist-search-box')
	searchButton.addEventListener('input', (event) => {
		console.log(searchButton.value)

		const searchValue = searchButton.value.toLowerCase()

		// debounce to avoid too many calls
		// it gets too jittery
		const debouncedSearch = _.debounce(() => {
			const filteredSongs = allSongs
				.filter((song) => song.name.toLowerCase().includes(searchValue))
				.filter((song, index, self) => index === self.findIndex((s) => s['id'] === song['id']))

			document.getElementById('songs-outer-container').innerHTML = ''
			filteredSongs.forEach(renderSong)
		}, 500)

		if (searchButton.value === '') {
			resetUi()
		} else {
			debouncedSearch()
		}
	})

	const playButtons = document.querySelectorAll('#song-action-play')
	playButtons.forEach(
		(playButton) =>
			(playButton.onclick = () => {
				const songId = playButton.getAttribute('data-song-id')
				enqueueSong(songId)
			}),
	)
}

export const playlistSetHeaderBackground = () => {
	const image = document.querySelector('#content-playlist-image')
	const header = document.querySelector('.content-playlist-container-header')

	image.addEventListener('load', () => {
		const canvas = document.createElement('canvas')
		const ctx = canvas.getContext('2d')
		canvas.width = image.width
		canvas.height = image.height
		ctx.drawImage(image, 0, 0)

		const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height).data

		const color = calculateMostCommonColor(imageData)
		color[3] = 0.25 // set alpha

		document.documentElement.style.setProperty('--most-common-playlist-color', `rgba(${color.join(',')})`)

		header.classList.add('loaded')
	})
}

export const calculateMostCommonColor = (imageData) => {
	const colorCount = {}
	for (let i = 0; i < imageData.length; i += 4) {
		const color = `${imageData[i]},${imageData[i + 1]},${imageData[i + 2]}`
		colorCount[color] = (colorCount[color] || 0) + 1
	}

	const mostCommonColor = Object.entries(colorCount)
		.reduce((a, b) => (b[1] > a[1] ? b : a))[0]
		.split(',')
		.map(Number)

	return mostCommonColor
}
