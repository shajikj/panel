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
        // hide all
        document.querySelectorAll('.page').forEach(p => p.style.display = 'none');
        // show selected
        document.getElementById('page-' + page).style.display = 'block';
        // update title
        document.getElementById('page-title').textContent =
            page.charAt(0).toUpperCase() + page.slice(1).replace('-', ' ');
        // set active menu
        document.querySelectorAll('.menu a').forEach(a => a.classList.remove('active'));
        event.currentTarget.classList.add('active');
    }

    window.onload = function () {
        document.querySelectorAll('.page').forEach(p => p.style.display = 'none');
        document.getElementById('page-dashboard').style.display = 'block';
        // reset active menu
        document.querySelectorAll('.menu a').forEach(a => a.classList.remove('active'));
        document.querySelector('.menu a[href="dashboard.php"]').classList.add('active');
        document.getElementById('page-title').textContent = "Dashboard";
    }
</script>