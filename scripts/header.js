const headerMessageContainer = document.querySelector('.message-container')

export const setHeaderMessage = (message) => {
	console.log('updating header message: ', message)
	headerMessageContainer.innerHTML = `<h2>${message}</h2>`
}
