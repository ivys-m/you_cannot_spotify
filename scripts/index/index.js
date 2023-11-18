import { createLibrary } from './scrollbar.js'

fetch('test.php')
	.then((response) => response.text())
	.then((data) => console.log(data))
