export const setupPlaylistPage = () => {
	playlistSetHeaderBackground()

	// const actions = document.getElementById('song-actions')
	// actions.addEventListener('click', () => {
	// 	const songId = actions.getAttribute('data-song-id')
	// 	console.log(songId)
	// })

	const savedIcon = document.getElementById('saved-icons')
	savedIcon.addEventListener('click', () => {
		const saved = savedIcon.classList.contains('saved')
		const playlistContainer = document.querySelector('.content-playlist-container')
		const playlistId = playlistContainer.dataset.id
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
				if (data === 'inactive') {
					savedIcon.classList = 'bx bx-heart'
				} else if (data === 'active') {
					savedIcon.classList = 'bx bxs-heart saved'
				}
			})
	})
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
