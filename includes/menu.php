<nav class="sidebar" id="sidebar">
    <h2>Admin Panel</h2>
    <ul class="menu">
        <li><a href="dashboard.php"
                class="<?= basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="subject_master.php"
                class="<?= basename($_SERVER['PHP_SELF']) == 'subject_master.php' ? 'active' : '' ?>">Subject Master</a>
        </li>
         <li><a href="class_master.php"
                class="<?= basename($_SERVER['PHP_SELF']) == 'class_master.php' ? 'active' : '' ?>">Class Master</a>
        </li>
        <li><a href="student_master.php"
                class="<?= basename($_SERVER['PHP_SELF']) == 'student_master.php' ? 'active' : '' ?>">Student Master</a>
        </li>
        <li><a href="teacher_master.php"
                class="<?= basename($_SERVER['PHP_SELF']) == 'teacher_master.php' ? 'active' : '' ?>">Teacher Master</a>
        </li>

        <li><a href="mark_entry.php"
                class="<?= basename($_SERVER['PHP_SELF']) == 'mark_entry.php' ? 'active' : '' ?>">Marks Entry</a></li>


</nav>

<script>
    function showPage(page, event) {
        event.preventDefault();

        // hide all sections (only if they exist)
        document.querySelectorAll('.page').forEach(p => p.style.display = 'none');

        // show selected page (check if it exists)
        const selectedPage = document.getElementById('page-' + page);
        if (selectedPage) {
            selectedPage.style.display = 'block';
        }

        // update title (if exists)
        const pageTitle = document.getElementById('page-title');
        if (pageTitle) {
            pageTitle.textContent = page.charAt(0).toUpperCase() + page.slice(1).replace('-', ' ');
        }

        // update sidebar menu highlight
        document.querySelectorAll('.menu a').forEach(a => a.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }

    window.onload = function () {
        // hide all .page sections (safe check)
        document.querySelectorAll('.page').forEach(p => p.style.display = 'none');

        // only show dashboard if element exists
        const dashboardPage = document.getElementById('page-dashboard');
        if (dashboardPage) {
            dashboardPage.style.display = 'block';
        }

        // highlight the Dashboard menu
        document.querySelectorAll('.menu a').forEach(a => a.classList.remove('active'));

        const dashboardLink = document.querySelector('.menu a[href="dashboard.php"]');
        if (dashboardLink) {
            dashboardLink.classList.add('active');
        }

        // update the title safely
        const title = document.getElementById('page-title');
        if (title) {
            title.textContent = "Dashboard";
        }
    }
</script>
