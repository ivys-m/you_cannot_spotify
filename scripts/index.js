import { createLibrary } from './sidebar.js'
import { showUserLibraries } from './content/homepage.js'

document.addEventListener('DOMContentLoaded', () => {
	showUserLibraries()
})

const changeContent = (fileToReadContentFrom) => {
	fetch(fileToReadContentFrom, {
		method: 'GET',
	})
		.then((response) => response.text())
		.then((data) => {
			console.log(data)
		})
		.catch((err) => {
			console.error(err)
		})
}

// changeContent('php/content/homepage.php')
