import { createLibrary } from './sidebar.js'
import { showUserLibraries } from './content/homepage.js'
import { setHeaderMessage } from './header.js'

document.addEventListener('DOMContentLoaded', () => {
	showUserLibraries()
})

const content = document.getElementById('main-content')

export const changeContent = (fileToReadContentFrom, params) => {
	const fetchParams = Object.keys(params)
		.map((key) => `${encodeURIComponent(key)}=${encodeURIComponent(params[key])}`)
		.join('&')

	const fetchUrl = fetchParams ? `${fileToReadContentFrom}?${fetchParams}` : fileToReadContentFrom

	if ('header-text' in params) {
		setHeaderMessage(params['header-text'])
	}

	fetch(fetchUrl, {
		method: 'GET',
	})
		.then((response) => response.text())
		.then((data) => {
			content.innerHTML = data
		})
		.catch((err) => {
			console.error(err)
			changeContent('php/content/homepage.php')
		})
}

// changeContent('php/content/homepage.php')
