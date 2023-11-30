import { changeContent } from '../index.js'
import { setHeaderMessage } from '../header.js'

export const setupYourSongsPage = () => {
	const songsRemoveIcons = document.querySelectorAll('#song-actions-delete')
	const container = document.querySelector('#your-songs-container')

	songsRemoveIcons.forEach(
		(songRemoveIcon) =>
			(songRemoveIcon.onclick = () => {
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
			}),
	)

	const editSongButtons = document.querySelectorAll('#song-actions-edit')
	editSongButtons.forEach(
		(editSongButton) =>
			(editSongButton.onclick = async () => {
				const songId = editSongButton.getAttribute('data-song-id')

				const formData = new FormData()
				formData.append('song-id', songId)

				await changeContent('./php/content/upload_song.php', {
					'text-title': 'upload song',
					'text-placeholder': 'song name',
					'song': '1',
					'song-id': `${songId}`,
				})
				setHeaderMessage('update song')
			}),
	)

	const uploadSongButton = document.querySelector('#your-songs-upload-song-button')
	uploadSongButton.onclick = async () => {
		await changeContent('./php/content/upload_song.php', {
			'text-title': 'upload song',
			'text-placeholder': 'song name',
			'song': '1',
		})
		setHeaderMessage('upload song')
	}
}
