// pain

export const userLibrariesContainer = document.querySelector('.playlists-container')
export const userLibrariesContainerNextButton = document.querySelector('#user-library-next-button')
export const userLibrariesContainerPrevButton = document.querySelector('#user-library-prev-button')

export const userLibraries = []

userLibrariesContainerNextButton.addEventListener('click', () => {
	console.log('next')
})

userLibrariesContainerPrevButton.addEventListener('click', () => {
	console.log('prev')
})

export const addLibraryElementToContainer = () => {}

export const createLibraryElement = () => {}

export const showUserLibraries = () => {
	userLibrariesContainer.innerHTML = ''

	userLibraries.forEach((library) => createLibraryElement(library))
}
