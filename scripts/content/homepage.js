// pain

import { setHeaderMessage } from '../header.js'
import { changeContent } from '../index.js'
import { createLibrary, sidebarNavListLibrariesContaienr } from '../sidebar.js'
import { setupPlaylistPage } from './playlist.js'

export const userLibrariesContainer = () => document.querySelector('#user-playlist-container')
export const userLibrariesContainerNextButton = () => document.querySelector('#user-library-next-button')
export const userLibrariesContainerPrevButton = () => document.querySelector('#user-library-prev-button')
export const createNewLibrary = () => document.querySelector('#user-library-create')

export const getBodyWidth = () => document.querySelector('#user-playlist-container').getBoundingClientRect().width
export const getLibraryWidth = () => 100 + 20

export let userLibraries = []
export const maxShowLibraries = Math.floor(getBodyWidth() / getLibraryWidth())
export let currentLibraryIndex = -maxShowLibraries

export const setLibraryContent = async (params) => {
	await changeContent('php/content/playlist.php', params)
	setupPlaylistPage()
}

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
	userLibrariesContainer().appendChild(libraryContainer)
}

export const showUserLibraries = async () => {
	currentLibraryIndex = -maxShowLibraries
	userLibrariesContainer().innerHTML = ''

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
	const data = JSON.parse(text)
	console.table(data)
	userLibraries = data

	while (sidebarNavListLibrariesContaienr.firstChild) {
		sidebarNavListLibrariesContaienr.removeChild(sidebarNavListLibrariesContaienr.firstChild)
	}

	userLibraries.forEach(createLibrary)

	showNextLibraries()
	updateButtonStatuses()
}

const showNextLibraries = () => {
	userLibrariesContainer().innerHTML = ''
	currentLibraryIndex += maxShowLibraries
	for (let i = currentLibraryIndex; i < currentLibraryIndex + maxShowLibraries; i++) {
		addLibraryElementToContainer(userLibraries[i])
	}
	updateButtonStatuses()
}

const showPrevLibraries = () => {
	userLibrariesContainer().innerHTML = ''
	currentLibraryIndex -= maxShowLibraries
	if (currentLibraryIndex <= 0) currentLibraryIndex = 0
	for (let i = currentLibraryIndex; i < currentLibraryIndex + maxShowLibraries; i++) {
		addLibraryElementToContainer(userLibraries[i])
	}
	updateButtonStatuses()
}

const updateButtonStatuses = () => {
	userLibrariesContainerPrevButton().onclick =
		currentLibraryIndex - maxShowLibraries < 0 ? () => console.log('not-active') : showPrevLibraries
	userLibrariesContainerNextButton().onclick =
		currentLibraryIndex + maxShowLibraries >= userLibraries.length
			? () => console.log('not-active')
			: showNextLibraries
}

// userLibrariesContainerNextButton().addEventListener('click', showNextLibraries)
// userLibrariesContainerPrevButton().addEventListener('click', showPrevLibraries)

export const adminLibrariesContainer = () => document.querySelector('#admin-playlist-container')
const setupAdminLibraries = async () => {
	const response = await fetch('php/content/admin_playlists.php')
	const libraries = await response.json()
	libraries.forEach((library) => {
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
		adminLibrariesContainer().appendChild(libraryContainer)
	})
}

export const setupHomepage = async () => {
	await showUserLibraries()
	await setupAdminLibraries()

	createNewLibrary().addEventListener('click', () => {
		changeContent('php/content/create_playlist.php', {
			'text-title': 'playlist name',
			'text-placeholder': 'playlist name',
			'playlist': '1',
		})
		setHeaderMessage('create playlist')
	})

	setHeaderMessage('welcome :3')
}
