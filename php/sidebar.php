<div class="sidebar">
    <div class="logo-content">
        <div class="logo">
            <i class='bx bx-music'></i>
            <div class="logo-name">You can (not) spotify</div>
        </div>
        <i class='bx bx-menu' id="menu-btn"></i>
    </div>
    <ul class="nav-list">
        <li id="homeButton">
            <a href="#">
                <i class='bx bxs-home'></i>
                <span class="link-name">Home</span>
                <span class="tooltip">Home</span>
            </a>
        </li>
        <?php
        if ($_SESSION['type'] === 'Artist') {
        ?>
            <!-- <li id="upload-song-button">
                <a href="#">
                    <i class='bx bx-upload'></i>
                    <span class="link-name">Upload Song</span>
                    <span class="tooltip">Upload Song</span>
                </a>
            </li> -->
            <li id="user-songs-button">
                <a href="#">
                    <i class='bx bxs-music'></i>
                    <span class="link-name">Your Songs</span>
                    <span class="tooltip">Your Songs</span>
                </a>
            </li>
        <?php
        }
        ?>
        <!-- <li>
            <i class='bx bx-search'></i>
            <input type="text" placeholder="Search">
            <span class="tooltip">Search</span>
        </li> -->
        <div class="libraries-container">
            <!-- <li>
                <a href="">
                    <i class='bx bx-library'></i>
                    <span class="link-name">playlist 1</span>
                </a>
                <span class="tooltip">playlist 1</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-library'></i>
                    <span class="link-name">playlist 2</span>
                </a>
                <span class="tooltip">playlist 2</span>
            </li>
            <li>
                <a href="">
                    <i class='bx bx-library'></i>
                    <span class="link-name">playlist 3</span>
                </a>
                <span class="tooltip">playlist 3</span>
            </li> -->
        </div>
    </ul>
</div>