export const setupYourSongsPage = () => {
	const songsRemoveIcons = document.querySelectorAll('#song-actions-delete')
	const container = document.querySelector('#your-songs-container')

	songsRemoveIcons.forEach((songRemoveIcon) => {
		songRemoveIcon.onclick = () => {
			const songId = songRemoveIcon.getAttribute('data-song-id')
			console.log(songId)

			const formData = new FormData()
			formData.append('song-id', songId)
			formData.append('delete', 1)

			fetch('./php/db/songs.php', {
				method: 'POST',
				body: formData,
			})
				.then((response) => response.text())
				.then((result) => {
					if (result === 'success') {
						container.removeChild(document.getElementById(`your-song-container-${songId}`))
					}
				})
				.catch((error) => console.error(error))
		}
	})
}
