import { setupUserProfilePage } from './content/user_profile.js'
import { changeContent } from './index.js'

const headerMessageContainer = document.querySelector('.message-container')

export const setHeaderMessage = (message) => {
	console.log('updating header message: ', message)
	headerMessageContainer.innerHTML = `<h2>${message}</h2>`
}

export const userProfileIcon = document.querySelector('#userProfilePicture')
userProfileIcon.addEventListener('click', () => {
	changeContent('php/content/user_profile.php', {
		'text-title': 'username',
		'text-placeholder': 'username',
		'email-title': 'email',
		'email-placeholder': 'email',
		'password-title': 'new password',
		'password-placeholder': 'leave empty to not change',
	}).then((res) => setupUserProfilePage())
})
