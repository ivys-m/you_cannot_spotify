export const setupPlaylistPage = () => {
	playlistSetHeaderBackground()

	const actions = document.getElementById('song-actions')
	actions.addEventListener('click', () => {
		const songId = actions.getAttribute('data-song-id')
		console.log(songId)
	})
}

export const playlistSetHeaderBackground = () => {
	console.log('setting bg')
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
		color[3] = 0.25

		document.documentElement.style.setProperty('--most-common-playlist-color', `rgba(${color.join(',')})`)

		header.classList.add('loaded')
		console.log('loaded')
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
