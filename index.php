<?php
require_once __DIR__ . '/php/db/users.php';
require_once __DIR__ . '/php/conn.php';
$result = login('kaname madoka', 'homuhomu', 'madoka@god.com');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>yuri</title>

    <!-- jquery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

    <!-- styles -->
    <!-- why is including fonts so annoying -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="./styles/index.css">

    <!-- scripts -->
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.21/lodash.min.js"></script>

    <script type="module" src="./scripts/content/upload_song.js" defer></script>
    <script type="module" src="./scripts/content/create_playlist.js" defer></script>
    <script type="module" src="./scripts/content/input/file.js" defer></script>

    <script type="module" src="./scripts/header.js" defer></script>
    <script type="module" src="./scripts/content/homepage.js" defer></script>
    <script type="module" src="./scripts/sidebar.js" defer></script>
    <script type="module" src="./scripts/index.js" defer></script>

    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- bootstrap / unused -->
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
</head>

<body>
    <?php
    require('php/sidebar.php');
    ?>

    <div class="home-content">
        <div class="home-container">
            <?php
            require('php/header.php');
            ?>

            <div class="main-content text" id="main-content">
                <?php
                require('php/content/homepage.php')
                ?>
            </div>
        </div>
    </div>

    <div class="controls">
        <div class="current-content">
            <div class="current">
                <div class="current-details">
                    <!-- <img src="" alt=""> -->
                    <i class="bx bx-music"></i>
                    <div class="current-name-author">
                        <div class="current-name">current-fuck</div>
                        <div class="current-author">current-fucker</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="controls-container">
        </div>
    </div>
</body>

</html>