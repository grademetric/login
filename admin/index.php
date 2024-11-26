<span style="font-family: verdana, geneva, sans-serif;"></span>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>GRADEMETRIC</title>
    <link rel="stylesheet" href="admin.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script languange='javascript'type='text/javascript'>
        function DisableBackButton(){
            window.history.forward()
        }
        window.onload=DisableBackButton;
        window.onpageshow=function(evet){ if (evet.persisted) DisableBackButton}
        window.onunload=function(){void (0)}
    </script>
</head>

<body>
    <div class="container">
        <nav>
            <div class="navbar">
                <div class="logo">
                    <img src="../image/image.logo.png" alt="logo">
                    <h1></h1>
                </div>
                <ul>
                    <li>
                        <a href="index.php">
                            <i class="fas fa fa-home"></i>
                            <span class="nav-item">Admin Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="grading_system_management.php">
                            <i class="fas fa fa-calculator"></i>
                            <span class="nav-item">Grading System Management</span>
                        </a>
                    </li>
                    <li>
                        <a href="user_management.php">
                            <i class="fa fa-user"></i>
                            <span class="nav-item">User Management</span>
                        </a>
                    </li>
                        <li>
                        <a href="../login.php">
                            <i class="fas fa-sign-out-alt"></i>
                            <span class="nav-item">Logout</span>
                        </a>
                    </li>
                    
            </div>
        </nav>

        <section class="main">
            <div class="main-top">
                <p>GRADEMETRIC</p>
            </div>
            <div class="main-body">
                <h1>GradeMetric</h1>

                <div class="search_bar">
                    <input type="text" name="" id="find" placeholder="Search Club here....">

                    <select class="filterButtons">
                        <option>Department</option>
                        <option>CCS</option>
                        <option>CTE</option>
                        <option>CBA</option>
                        <option>CAS</option>
                        <option>CCJE</option>
                    </select>
                </div>
                <div class="row">
                    <p>There are more than <span>10</span> Clubs</p>
                </div>

                <body>

                    <div class="cmuclubs">

                        <div class="cmuclubs-container">

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.jpcs.jpg" alt="CCS">
                                </div>
                                <div class="club-content">
                                    <h3>Junior Philippine Computer Society </h3>
                                    <p>City of Malabon University - Junior Philippine Computer Society</p>
                                    <a href="https://www.facebook.com/cityofmalabonuniversity.jpcs" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.crim..jpg" alt="CCJE">
                                </div>
                                <div class="club-content">
                                    <h3>Union of Criminal Justice Education Students</h3>
                                    <p>City of Malabon University - Union of Criminal Justice Education Students</p>
                                    <a href="https://www.facebook.com/UnionOfCriminalJusticeEducationStudents.CMU"
                                        class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i>28th Nov. 2024</span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.aw.jpg" alt="CTE">
                                </div>
                                <div class="club-content">
                                    <h3>Social Studies Club </h3>
                                    <p>City of Malabon University - Social Studies Club - ComElec </p>
                                    <a href="https://www.facebook.com/cmussccomelec?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024</span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.jfnex.jpg" alt="CBA">
                                </div>
                                <div class="club-content">
                                    <h3>Junior Financial Executive</h3>
                                    <p>City of Malabon University - Junior Financial Executives</p>
                                    <a href="https://www.facebook.com/cmu.jfinexecutives?mibextid=ZbWKwL"
                                        class="btn">Read more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.hr.jpg" alt="CBA">
                                </div>
                                <div class="club-content">
                                    <h3>Human Resource Students Association of the Philippines</h3>
                                    <p>City of Malabon University - Human Resource Students Association of the
                                        Philippines </p>
                                    <a href="https://www.facebook.com/hrsap.cmu?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>


                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.jpia.jpg" alt="CBA">
                                </div>
                                <div class="club-content">
                                    <h3>Junior Philippine Institute of Accountants</h3>
                                    <p>City of Malabon University - Junior Philippine Institute of Accountants</p>
                                    <a href="https://www.facebook.com/cmuc.jpia?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.cbajma.jpg" alt="JMA logo">
                                </div>
                                <div class="club-content">
                                    <h3>Junior Marketing Association</h3>
                                    <p>City of Malabon University - Junior Marketing Association</p>
                                    <a href="https://www.facebook.com/cmu.jma2022?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.English Society .jpg" alt="CTE">
                                </div>
                                <div class="club-content">
                                    <h3>English Society</h3>
                                    <p>City of Malabon University - English Society</p>
                                    <a href="https://www.facebook.com/CMUesoc?mibextid=ZbWKwL" class="btn">Read more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>
                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.firdt hasnd.jpg" alt="CTE">
                                </div>
                                <div class="club-content">
                                    <h3>First Hand Society</h3>
                                    <p>City of Malabon University - First Hand Society</p>
                                    <a href="https://www.facebook.com/fihasoc.cmu?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>
                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.t.jpg" alt="CTE">
                                </div>
                                <div class="club-content">
                                    <h3>Mathematics Society</h3>
                                    <p>City of Malabon University - Mathematics Society</p>
                                    <a href="https://www.facebook.com/CMUmathsoc?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>
                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.apds.jpg" alt="CAS">
                                </div>
                                <div class="club-content">
                                    <h3>Alliance of Public Administration Students</h3>
                                    <p>City of Malabon University - Alliance of Public Administration Students</p>
                                    <a href="https://www.facebook.com/apas.cmu.2022?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>

                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.jwa.jpg" alt="CAS">
                                </div>
                                <div class="club-content">
                                    <h3>Junior Social Workers' Association of the Philippines </h3>
                                    <p>City of Malabon University - Junior Social Workers' Association of the
                                        Philippines
                                    </p>
                                    <a href="https://www.facebook.com/CMUJSWAP?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>


                            <div class="club-box">
                                <div class="club-image">
                                    <img src="../image/image.wawd.jpg" alt="CAS">
                                </div>
                                <div class="club-content">
                                    <h3>Res Publica - CMU</h3>
                                    <p>City of Malabon University - Res Publica</p>
                                    <a href="https://www.facebook.com/respublica.cmu?mibextid=ZbWKwL" class="btn">Read
                                        more</a>
                                    <div class="club-icons">
                                        <span> <i class="fas fa-calendar"></i> 28th Nov. 2024 </span>
                                        <span> <i class="fas fa-user"></i> by admin </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="load-more"> load more </div>
                        <script>
                            
                            let loadMoreBtn = document.querySelector('#load-more');
let currentItem = 3;

loadMoreBtn.onclick = () => {
    let boxes = [...document.querySelectorAll('.cmuclubs .cmuclubs-container .club-box')];
    for (var i = currentItem; i < currentItem + 3; i++) {
        boxes[i].style.display = 'inline-block';
    }
    currentItem += 3;

    if (currentItem >= boxes.length) {
        loadMoreBtn.style.display = 'none';
    }
}

//BOOTSTRAP GUIDE//
const filterButtons = document.querySelectorAll(".filterButtons");
const filterableCards = document.querySelectorAll(".cmuclubs .cmuclubs-container .club-box");
const searchInput = document.getElementById("find");

// Function to filter cards based on filter buttons
const filterCards = (e) => {
    filterableCards.forEach(card => {
        // show the card if it matches the clicked filter or show all cards if "all" filter is clicked
        if (e.target.value === "Department" || card.querySelector('.club-image img').alt === e.target.value) {
            card.style.display = "inline-block";
        } else {
            card.style.display = "none";
        }
    });
}

// Initially hide all cards except the first three
filterableCards.forEach((card, index) => {
    if (index >= 3) {
        card.style.display = "none";
    }
});

// Search Function
searchInput.addEventListener("input", () => {
    const searchTerm = searchInput.value.toLowerCase();
    filterableCards.forEach(card => {
        const clubName = card.querySelector(".club-content h3").textContent.toLowerCase();
        if (clubName.includes(searchTerm)) {
            card.style.display = "inline-block";
        } else {
            card.style.display = "none";
        }
    });
});

filterButtons.forEach(button => button.addEventListener("change", filterCards));
                        </script>


                    </div>

                </body>

</html>
</span>