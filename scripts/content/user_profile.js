import { changeContent } from '../index.js'
import { setHeaderMessage, userProfileIcon } from '../header.js'
import { setupHomepage } from './homepage.js'

export const setupUserProfilePage = () => {
	setHeaderMessage('edit user profile')

	const usernameInputButton = document.getElementById('text-input')
	const profilePictureInput = document.getElementById('picture-input')
	const emailInput = document.getElementById('email-input')
	const passwordInput = document.getElementById('password-input')

	const logoutButton = document.getElementById('logout')
	const saveChangesButton = document.getElementById('update')

	logoutButton.onclick = () => {
		console.log('locout')
		fetch('php/logout.php')
		window.location.href = 'index.php'
	}

	saveChangesButton.onclick = () => {
		const username = usernameInputButton.value
		console.log(username)
		if (username === '') {
			return
		}

		const newProfilePicture = profilePictureInput.files[0]
		console.log(newProfilePicture)

		const newEmail = emailInput.value
		console.log(newEmail)
		if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(newEmail)) {
			return
		}

		const newPassword = passwordInput.value

		const formData = new FormData()
		formData.append('update-user', '1')
		formData.append('username', username)
		if (newProfilePicture !== undefined) {
			formData.append('profile-picture', newProfilePicture)
		}
		if (newPassword !== '') {
			formData.append('password', newPassword)
		}
		formData.append('email', newEmail)

		fetch('php/db/users.php', {
			method: 'POST',
			body: formData,
		})
			.then((response) => response.text())
			.then((text) => {
				if (text === 'success') {
					if (newProfilePicture !== undefined) {
						const reader = new FileReader()
						reader.onload = (e) => {
							userProfileIcon.src = e.target.result
						}
						reader.readAsDataURL(newProfilePicture)
					}

					changeContent('php/content/homepage.php').then((res) => {
						setupHomepage()
					})
				} else {
					console.error(text)
				}
			})
			.catch((err) => console.error(err))
	}
}
