export const fileInputOnChange = (sender) => {
	if (sender.files.length === 0) return

	const file = sender.files[0]
	if (!file) return

	const reader = new FileReader()

	reader.onload = (e) => {
		document.getElementById('input-picture-image').src = e.target.result
	}

	reader.readAsDataURL(file)
}

document.addEventListener('change', (event) => {
	const target = event.target

	if (target.id === 'picture-input') {
		fileInputOnChange(target)
	}
})
