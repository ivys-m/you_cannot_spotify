// pain

import { setHeaderMessage } from './header.js'
import { setLibraryContent, setupHomepage, showUserLibraries } from './content/homepage.js'
import { changeContent } from './index.js'
import { setupYourSongsPage } from './content/your_songs.js'

export const menuButton = document.querySelector('#menu-btn')
export const sidebar = document.querySelector('.sidebar')
export const searchButton = document.querySelector('.bx-search')
export const sidebarNavListLibrariesContaienr = document.querySelector('.libraries-container')
export const homeButton = document.querySelector('#homeButton')
export const uploadSongButton = document.querySelector('#upload-song-button')
export const yourSongsButton = document.querySelector('#user-songs-button')

menuButton.onclick = () => {
	sidebar.classList.toggle('active')
}

if (searchButton !== null) {
	searchButton.onclick = () => {
		sidebar.classList.toggle('active')
	}
}

homeButton.onclick = async (event) => {
	event.preventDefault()

	await changeContent('./php/content/homepage.php')
	sidebarNavListLibrariesContaienr.innerHTML = ''
	await setupHomepage()
}

if (!!uploadSongButton) {
	uploadSongButton.onclick = async (event) => {
		event.preventDefault()

		await changeContent('./php/content/upload_song.php', {
			'text-title': 'upload song',
			'text-placeholder': 'song name',
		})
		setHeaderMessage('upload song')
	}
}

if (!!yourSongsButton) {
	yourSongsButton.onclick = async (event) => {
		event.preventDefault()

		await changeContent('./php/content/your_songs.php')
		setupYourSongsPage()
		setHeaderMessage('your songs')
	}
}

export const createLibrary = (library) => {
	const existingLibraryElement = document.querySelector(`[data-lib-id="${library.name}"]`)

	if (existingLibraryElement) {
		return
	}

	const libraryElement = document.createElement('li')
	libraryElement.setAttribute('data-lib-id', library['name'])

	const link = document.createElement('a')
	link.href = '#'
	link.addEventListener('click', (event) => {
		event.preventDefault()

		setLibraryContent({ 'id': library['id'], 'header-text': library['name'] })
	})

	// const icon = document.createElement('i')
	// icon.classList.add('bx')
	// icon.classList.add('bx-library')
	const iconContainer = document.createElement('div')
	iconContainer.classList.add('img-container')

	const icon = document.createElement('img')
	icon.src = library['picture_path']
	icon.alt = library['name']

	iconContainer.appendChild(icon)

	const linkName = document.createElement('span')
	linkName.classList.add('link-name')
	linkName.textContent = library['name']

	link.appendChild(iconContainer)
	link.appendChild(linkName)

	const tooltip = document.createElement('span')
	tooltip.classList.add('tooltip')

	libraryElement.appendChild(link)
	libraryElement.appendChild(tooltip)

	sidebarNavListLibrariesContaienr.appendChild(libraryElement)
}
