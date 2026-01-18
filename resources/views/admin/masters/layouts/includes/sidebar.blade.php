<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --ngo-red: #ff4d4d;
        --sidebar-bg: #1a1a1a;
        --link-hover: rgba(255, 255, 255, 0.1);
        --sidebar-width: 260px;
    }

    /* Sidebar Base Style */
    #sidebar {
        width: var(--sidebar-width);
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        background: var(--sidebar-bg);
        display: flex;
        flex-direction: column;
        z-index: 1050;
        /* Bootstrap modal se niche lekin content se upar */
        transition: all 0.3s ease-in-out;
    }

    .sidebar-header {
        padding: 20px;
        color: white;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .custom-scroll {
        overflow-y: auto;
        padding-bottom: 50px;
        flex-grow: 1;
    }
    .custom-scroll::-webkit-scrollbar {
        width: 5px;
    }

    .custom-scroll::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }


    .nav-link {
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #adb5bd !important;
        text-decoration: none;
        transition: 0.3s;
        border-left: 4px solid transparent;
        cursor: pointer;
    }

    .nav-link i:first-child {
        width: 25px;
    }

    .nav-link:hover,
    .nav-link.active {
        background: var(--link-hover);
        color: white !important;
        border-left: 4px solid var(--ngo-red);
    }
    .submenu {
        display: none;
        background: #252525;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .submenu .nav-link {
        padding-left: 50px;
        font-size: 0.9rem;
        border-left: none;
    }

    .arrow {
        font-size: 0.7rem;
        transition: transform 0.3s;
    }

    .rotate {
        transform: rotate(90deg);
    }
    @media (max-width: 991.98px) {
        #sidebar {
            left: -260px;
        }

        #sidebar.show {
            left: 0;
            box-shadow: 10px 0 30px rgba(0, 0, 0, 0.5);
        }
        .mobile-toggle-btn {
            display: block;
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1000;
            background: var(--ngo-red);
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
        }
    }
    @media (min-width: 992px) {

        .mobile-toggle-btn,
        #closeSidebar {
            display: none;
        }
        .main-content {
            margin-left: var(--sidebar-width);
        }
    }
</style>

<nav id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold"><span style="color:var(--ngo-red)">NGO</span> ADMIN</h4>
        <i class="fas fa-times" id="closeSidebar" style="cursor:pointer"></i>
    </div>

    <div class="mt-3 custom-scroll">
        <a href="{{ route('admin.dashboard') }}" class="nav-link">
            <span><i class="fas fa-chart-line"></i> Dashboard</span>
        </a>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-hand-holding-heart"></i> Fundraising</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.campaigns.index') }}" class="nav-link">Crowdfunding Campaigns</a>
                <a href="{{ route('admin.donners.index') }}" class="nav-link">Donors Database</a>
                <a href="{{ route('admin.donors.donnerlist') }}" class="nav-link">Donation History</a>
                <a href="{{ route('admin.tex_certificates.index') }}" class="nav-link">80G Certificates</a>
                <a href="{{ route('admin.crowdfunding-teams.index') }}" class="nav-link">Fundraising Teams</a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-globe-asia"></i> Projects & Field</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.project-locations.index') }}" class="nav-link">Project Locations</a>
                <a href="{{ route('admin.beneficiaries.index') }}" class="nav-link">Beneficiary List</a>
                <a href="{{ route('admin.volunteers.index') }}" class="nav-link">Volunteers Database</a>
                <a href="{{ route('admin.goals.index') }}" class="nav-link">Impact Tracking (Goals)</a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-calendar-alt"></i> Events</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.events.index') }}" class="nav-link">Manage Events</a>
                <a href="{{ route('admin.events.registrations') }}" class="nav-link">Event Participants</a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-file-contract"></i> Compliance</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.audit-reports.index') }}" class="nav-link">Audit Reports</a>
                <a href="{{ route('admin.expenses.index') }}" class="nav-link">Expense Manager</a>
                <a href="{{ route('admin.compliance.index') }}" class="nav-link">Legal Documents</a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-desktop"></i> Frontend CMS</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.about.index') }}" class="nav-link">About Us Page</a>
                <a href="{{ route('admin.blogs.index') }}" class="nav-link">Blog & Stories</a>
                <a href="{{ route('admin.gallery.index') }}" class="nav-link">Gallery (Media)</a>
                <a href="#" class="nav-link">Press Releases</a>
            </div>
        </div>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-user-shield"></i> Administration</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.members.index') }}" class="nav-link">Admin Users</a>
                <a href="http://127.0.0.1:8000/manage-roles" class="nav-link">Roles & Permissions (ACL)</a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link">System Settings</a>
            </div>
        </div>

        <hr class="mx-3 border-light opacity-25">

        <form method="POST" action="{{ route('logout') }}" class="mb-5">
            @csrf
            <button type="submit" class="nav-link text-danger w-100 text-start" style="background:none;border:none">
                <span><i class="fas fa-power-off"></i> Logout</span>
            </button>
        </form>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const sidebar = document.getElementById("sidebar");
        const openBtn = document.getElementById("openSidebar");
        const closeBtn = document.getElementById("closeSidebar");
        const dropdownBtns = document.querySelectorAll(".dropdown-btn");
        const allLinks = document.querySelectorAll(".nav-link");

        // --- 1. SIDEBAR OPEN/CLOSE LOGIC (MOBILE) ---
        if (openBtn) {
            openBtn.addEventListener("click", () => sidebar.classList.add("show"));
        }
        if (closeBtn) {
            closeBtn.addEventListener("click", () => sidebar.classList.remove("show"));
        }

        // --- 2. ACCORDION (DROPDOWN) LOGIC ---
        dropdownBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                const submenu = this.nextElementSibling;
                const arrow = this.querySelector(".arrow");
                const isOpen = submenu.style.display === "block";

                // Sabhi dusre submenus aur arrows ko reset karein
                document.querySelectorAll(".submenu").forEach(sub => sub.style.display =
                "none");
                document.querySelectorAll(".arrow").forEach(arr => arr.classList.remove(
                    "rotate"));
                document.querySelectorAll(".dropdown-btn").forEach(db => db.classList.remove(
                    "active"));

                // Agar clicked wala band tha, toh usey kholein
                if (!isOpen) {
                    submenu.style.display = "block";
                    arrow.classList.add("rotate");
                    this.classList.add("active");
                }
            });
        });

        // --- 3. AUTO-ACTIVATE CURRENT URL ---
        const currentUrl = window.location.href;
        allLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("active");
                const parentSubmenu = link.closest(".submenu");
                if (parentSubmenu) {
                    parentSubmenu.style.display = "block";
                    const parentBtn = parentSubmenu.previousElementSibling;
                    parentBtn.classList.add("active");
                    const arrow = parentBtn.querySelector(".arrow");
                    if (arrow) arrow.classList.add("rotate");
                }
            }
        });
    });
</script>
