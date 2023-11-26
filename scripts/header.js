const headerMessageContainer = document.querySelector('.message-container')

export const setHeaderMessage = (message) => {
	headerMessageContainer.innerHTML = `<h2>${message}</h2>`
}
