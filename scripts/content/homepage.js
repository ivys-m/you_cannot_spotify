// pain

export const userLibrariesContainer = document.querySelector('.playlists-container')
export const userLibrariesContainerNextButton = document.querySelector('#user-library-next-button')
export const userLibrariesContainerPrevButton = document.querySelector('#user-library-prev-button')

import { changeContent } from '../index.js'
export const setLibraryContent = (params) => {
	changeContent('php/content/playlist.php', params)
}

export let userLibraries = []
let currentIndex = 0

const getBodyWidth = () => document.querySelector('.playlists-container').getBoundingClientRect().width
const getLibraryWidth = () => 100 + 20

userLibrariesContainerNextButton.addEventListener('click', () => {
	showNextLibraries()
})

userLibrariesContainerPrevButton.addEventListener('click', () => {
	showPrevLibraries()
})

export const addLibraryElementToContainer = (library) => {
	if (library === undefined) return

	let content = ''

	const libraryContainer = document.createElement('a')
	libraryContainer.classList.add('playlist-container')

	// user can't see id... I hope
	libraryContainer.addEventListener('click', () => {
		setLibraryContent({ 'id': library['id'], 'header-text': library['name'] })
	})

	content += `<div class="playlist-image-container">`
	content += `<img src="${library['picture_path']}" alt="${library['name']}">`
	content += `</div>`

	content += `<div class="playlist-title">`
	content += `<h6> ${library['name']} </h6>`
	content += `</div>`

	libraryContainer.innerHTML = content
	userLibrariesContainer.appendChild(libraryContainer)
}

export const createLibraryElement = (library) => {
	return library
}

export const showUserLibraries = async () => {
	userLibrariesContainer.innerHTML = ''

	const response = await fetch('./php/index.php', {
		method: 'POST',
		headers: {
			'Accept': 'application/json',
			'Content-Type': 'application/json',
		},
		body: JSON.stringify({
			playlists: 1,
		}),
	})

	const text = await response.text()
	console.log(text)
	const data = JSON.parse(text)
	console.dir(data)
	userLibraries = data

	showNextLibraries()
}

const maxShowLibraries = Math.ceil(getBodyWidth() / getLibraryWidth())
let currentLibraryIndex = -maxShowLibraries
const showNextLibraries = () => {
	userLibrariesContainer.innerHTML = ''
	currentLibraryIndex += maxShowLibraries
	for (let i = currentLibraryIndex; i < currentLibraryIndex + maxShowLibraries; i++) {
		addLibraryElementToContainer(userLibraries[i])
	}
}

const showPrevLibraries = () => {
	userLibrariesContainer.innerHTML = ''
	currentLibraryIndex -= maxShowLibraries
	if (currentLibraryIndex <= 0) currentLibraryIndex = 0
	for (let i = currentLibraryIndex; i < currentLibraryIndex + maxShowLibraries; i++) {
		addLibraryElementToContainer(userLibraries[i])
	}
}

const updateButtonsState = () => {
	userLibrariesContainerPrevButton.disabled = currentIndex === 0
	userLibrariesContainerNextButton.disabled = currentIndex >= userLibraries.length
}
