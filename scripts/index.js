import { createLibrary } from './sidebar.js'
import { setupHomepage, showUserLibraries } from './content/homepage.js'
import { setHeaderMessage } from './header.js'

document.addEventListener('DOMContentLoaded', () => {
	setupHomepage()
})

const content = document.getElementById('main-content')

export const changeContent = async (fileToReadContentFrom, params) => {
	if (params === undefined) params = {}
	const fetchParams = Object.keys(params)
		.map((key) => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`)
		.join('&')

	const fetchUrl = fetchParams ? `${fileToReadContentFrom}?${fetchParams}` : fileToReadContentFrom

	if ('header-text' in params) {
		setHeaderMessage(params['header-text'])
	}

	try {
		const response = await fetch(fetchUrl, {
			method: 'GET',
		})

		if (!response.ok) {
			throw new Error(`HTTP error! Status: ${response.status}`)
		}

		const data = await response.text()
		content.innerHTML = data
	} catch (err) {
		console.error(err)
		changeContent('php/content/homepage.php')
	}
}

// changeContent('php/content/homepage.php')
