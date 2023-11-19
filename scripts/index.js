import { createLibrary } from './sidebar.js'

fetch('test.php')
	.then((response) => response.text())
	.then((data) => console.log(data))
