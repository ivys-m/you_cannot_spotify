<div class="text">
    <div class="header">
        <div class="message-container">
            <h2>welcome :3</h2>
        </div>

        <div class="arrow-container">
            <i class='bx bxs-left-arrow-circle arrow-inactive'></i>
            <i class='bx bxs-right-arrow-circle arrow-inactive'></i>
        </div>

        <div class="profile-container">
            <div class="picture-container">
                <img src="<?= $_SESSION['profile_picture_path'] ?? './db/users/pictures/default.png' ?>" alt="<?= $_SESSION['username'] ?>" id="userProfilePicture">
            </div>
        </div>
    </div>
</div>