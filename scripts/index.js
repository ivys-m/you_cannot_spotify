import { createLibrary } from './sidebar.js'

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

changeContent('php/content/homepage.php')
