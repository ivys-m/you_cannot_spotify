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
    <link rel="stylesheet" href="./styles/index/main.css">

    <!-- scripts -->
    <script type="module" src="./scripts/index/scrollbar.js" defer></script>
    <script type="module" src="./scripts/index/index.js" defer></script>

    <!-- icons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <!-- bootstrap -->
    <link href=" https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</head>

<body>
    <div class="sidebar">
        <div class="logo-content">
            <div class="logo">
                <i class='bx bx-music'></i>
                <div class="logo-name">You can (not) spotify</div>
            </div>
            <i class='bx bx-menu' id="menu-btn"></i>
        </div>
        <ul class="nav-list">
            <li>
                <a href="">
                    <i class='bx bxs-home'></i>
                    <span class="link-name">Home</span>
                    <span class="tooltip">Home</span>
                </a>
            </li>
            <li>
                <i class='bx bx-search'></i>
                <input type="text" placeholder="Search">
                <!-- <span class="link-name">Search</span> -->
                <span class="tooltip">Search</span>
            </li>
            <div class="libraries-container">
                <li>
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
                </li>
            </div>
        </ul>
    </div>

    <div class="home-content">
        <div class="text">
            <h2 class="text-center">you can (not) spotify</h2>
            fuck
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