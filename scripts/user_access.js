document.addEventListener('DOMContentLoaded', () => {
	const form = document.querySelector('form')
	const emailInput = document.getElementById('email')
	const usernameInput = document.getElementById('username')
	const passwordInput = document.getElementById('pswd1')
	const confirmPasswordInput = document.getElementById('pswd2')
	const loginRadio = document.getElementById('login')
	const registerRadio = document.getElementById('register')
	const userTypeInput = document.getElementById('type')

	form.addEventListener('submit', function (event) {
		event.preventDefault()

		const emailValue = emailInput.value
		const usernameValue = usernameInput.value
		const passwordValue = passwordInput.value
		const confirmPasswordValue = confirmPasswordInput.value
		const typeValue = userTypeInput.checked ? 'Artist' : 'Standard'

		const selectedOption = loginRadio.checked ? 'login' : registerRadio.checked ? 'register' : null

		const formData = new FormData()
		if (selectedOption === 'login') {
			formData.append('login', '1')
			formData.append('email-username', emailValue)
			formData.append('password', passwordValue)
			formData.append('type', typeValue)
		} else if (selectedOption === 'register') {
			formData.append('register', '1')
			formData.append('email', emailValue)
			formData.append('username', usernameValue)
			formData.append('password', passwordValue)
			formData.append('type', typeValue)
		} else {
			console.log('No option selected')
			return
		}

		fetch('start_session.php', {
			method: 'POST',
			body: formData,
		})
			.then((response) => response.text())
			.then((response) => {
				let json
				try {
					json = JSON.parse(response)
				} catch {
					json = null
				}
				if (json === null) {
					console.log(response)
					document.getElementById('error-msg').innerText = 'error, try again'
				} else {
					console.dir(json)
					window.location.href = '_index.php'
				}
			})
			.catch((err) => console.error(err))
	})
})
