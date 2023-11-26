// pain

import { setLibraryContent, setupHomepage, showUserLibraries } from './content/homepage.js'
import { changeContent } from './index.js'

export const menuButton = document.querySelector('#menu-btn')
export const sidebar = document.querySelector('.sidebar')
export const searchButton = document.querySelector('.bx-search')
export const sidebarNavListLibrariesContaienr = document.querySelector('.libraries-container')
export const homeButton = document.querySelector('#homeButton')

menuButton.onclick = () => {
	sidebar.classList.toggle('active')
}

searchButton.onclick = () => {
	sidebar.classList.toggle('active')
}

homeButton.onclick = async (event) => {
	event.preventDefault()

	await changeContent('./php/content/homepage.php')
	await setupHomepage()
}

export const createLibrary = (library) => {
	const existingLibraryElement = document.querySelector(`[data-lib-id="${library.name}"]`)

	if (existingLibraryElement) return

	const libraryElement = document.createElement('li')
	libraryElement.setAttribute('data-lib-id', library['name'])

	const link = document.createElement('a')
	link.href = '#'
	link.addEventListener('click', (event) => {
		event.preventDefault()

		setLibraryContent({ 'id': library['id'], 'header-text': library['name'] })
	})

	const icon = document.createElement('i')
	icon.classList.add('bx')
	icon.classList.add('bx-library')

	const linkName = document.createElement('span')
	linkName.classList.add('link-name')
	linkName.textContent = library['name']

	link.appendChild(icon)
	link.appendChild(linkName)

	const tooltip = document.createElement('span')
	tooltip.classList.add('tooltip')

	libraryElement.appendChild(link)
	libraryElement.appendChild(tooltip)

	sidebarNavListLibrariesContaienr.appendChild(libraryElement)
}
