// pain

export const menuButton = document.querySelector('#menu-btn')
export const sidebar = document.querySelector('.sidebar')
export const searchButton = document.querySelector('.bx-search')
export const sidebarNavListLibrariesContaienr = document.querySelector(
	'.libraries-container'
)

menuButton.onclick = () => {
	sidebar.classList.toggle('active')
}

searchButton.onclick = () => {
	sidebar.classList.toggle('active')
}

export const createLibrary = (libraryName) => {
	const library = document.createElement('li')

	const link = document.createElement('a')
	link.href = ''

	const icon = document.createElement('i')
	icon.classList.add('bx')
	icon.classList.add('bx-library')

	const linkName = document.createElement('span')
	linkName.classList.add('link-name')
	linkName.textContent = libraryName

	link.appendChild(icon)
	link.appendChild(linkName)

	const tooltip = document.createElement('span')
	tooltip.classList.add('tooltip')

	library.appendChild(link)
	library.appendChild(tooltip)

	sidebarNavListLibrariesContaienr.appendChild(library)
}
