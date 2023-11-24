// pain

export const userLibrariesContainer = document.querySelector('.playlists-container')
export const userLibrariesContainerNextButton = document.querySelector('#user-library-next-button')
export const userLibrariesContainerPrevButton = document.querySelector('#user-library-prev-button')

export let userLibraries = []
let currentIndex = 0

userLibrariesContainerNextButton.addEventListener('click', () => {
	showNextLibraries()
})

userLibrariesContainerPrevButton.addEventListener('click', () => {
	showPrevLibraries()
})

export const addLibraryElementToContainer = (library) => {
	userLibrariesContainer.innerHTML += library
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

	const data = await response.json()
	userLibraries = data

	showNextLibraries()
}

const showNextLibraries = () => {
	for (let i = currentIndex; i < currentIndex + 6 && i < userLibraries.length; ++i) {
		addLibraryElementToContainer(createLibraryElement(userLibraries[i]))
	}
	currentIndex += 6
	updateButtonsState()
}

const showPrevLibraries = () => {
	currentIndex -= 12
	if (currentIndex < 0) {
		currentIndex = 0
	}
	showNextLibraries()
}

const updateButtonsState = () => {
	userLibrariesContainerPrevButton.disabled = currentIndex === 0
	userLibrariesContainerNextButton.disabled = currentIndex >= userLibraries.length
}
