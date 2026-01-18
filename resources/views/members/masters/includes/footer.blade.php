<script>
        const sidebar = document.getElementById('sidebar');
        const header = document.getElementById('header');
        const mainContent = document.getElementById('main-content');
        const toggleBtn = document.getElementById('toggleSidebar');
        const closeBtn = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        // Toggle Function (Laptop + Mobile)
        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth > 992) {
                // Laptop View Logic
                sidebar.classList.toggle('collapsed');
                header.classList.toggle('full-width');
                mainContent.classList.toggle('full-width');
            } else {
                // Mobile View Logic
                sidebar.classList.add('active');
                overlay.classList.add('active');
            }
        });

        // Close Sidebar (Mobile X Button)
        closeBtn.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });

        // Close Sidebar (Overlay click)
        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        });
    </script>