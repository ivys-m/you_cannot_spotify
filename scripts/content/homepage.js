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
	let content = ''

	content += `<a class="playlist-container">`

	content += `<div class="playlist-image-container">`
	content += `<img src="${library['picture_path']}" alt="${library['name']}">`
	content += `</div>`

	content += `<div class="playlist-title">`
	content += `<h6> ${library['name']} </h6>`
	content += `</div>`

	content += `</a>`

	userLibrariesContainer.innerHTML += content
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
