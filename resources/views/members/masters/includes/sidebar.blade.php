<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<style>
    :root {
        --ngo-red: #ff4d4d;
        --sidebar-bg: #1a1a1a;
        --link-hover: rgba(255, 255, 255, 0.1);
    }

    #sidebar {
        width: 260px;
        height: 100vh;
        position: fixed;
        top: 0; left: 0;
        background: var(--sidebar-bg);
        display: flex;
        flex-direction: column;
        z-index: 1000;
        transition: all 0.3s;
    }

    .sidebar-header {
        padding: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: white;
    }

    .custom-scroll {
        overflow-y: auto;
        padding-bottom: 50px;
    }
    .custom-scroll::-webkit-scrollbar { width: 5px; }
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

    .nav-link i:first-child { width: 25px; }
    .nav-link:hover, .nav-link.active {
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
    }

    .arrow {
        font-size: 0.7rem;
        transition: transform 0.3s;
    }

    .rotate { transform: rotate(90deg); }
</style>

<nav id="sidebar">
    <div class="sidebar-header d-flex justify-content-between align-items-center">
        <h4 class="mb-0 fw-bold"><span style="color:var(--ngo-red)">NGO</span> ADMIN</h4>
        <i class="fas fa-times" id="closeSidebar" style="cursor:pointer"></i>
    </div>

    <div class="mt-3 custom-scroll">
        <a href="{{ route('member.dashboard') }}" class="nav-link">
            <span><i class="fas fa-chart-line"></i> Dashboard</span>
        </a>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-hand-holding-heart"></i> Donations</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.donners.index') }}" class="nav-link">All Donors</a>
                <a href="{{ route('admin.donors.donnerlist') }}" class="nav-link">Donation History</a>
                <a href="{{ route('admin.tex_certificates.index') }}" class="nav-link">Tax Certificates (80G)</a>
            </div>
        </div>
        @if (auth()->user()->hasPermission('outreach_view'))
        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-bullhorn"></i> Outreach</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.campaigns.index') }}" class="nav-link">Active Campaigns</a>
                <a href="{{ route('admin.crowdfunding-teams.index') }}" class="nav-link">Crowdfunding Teams</a>
                <a href="{{ route('admin.goals.index') }}" class="nav-link">Goal Tracking</a>
                <a href="{{ route('admin.events.index') }}" class="nav-link">Event Management</a>
            </div>
        </div>
        @endif
        @if (auth()->user()->hasPermission('fieldoperation_view'))
        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-tasks"></i> Field Operations</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                 @if (auth()->user()->hasPermission('project_view'))
                <a href="{{ route('admin.project-locations.index') }}" class="nav-link">Project Locations</a>
                @endif
                 @if (auth()->user()->hasPermission('volunteer_view'))
                <a href="{{ route('admin.volunteers.index') }}" class="nav-link">Volunteer Database</a>
                @endif
                 @if (auth()->user()->hasPermission('beneficiary_view'))
                <a href="{{ route('admin.beneficiaries.index') }}" class="nav-link">Beneficiary List</a>
                @endif
            </div>
        </div>
        @endif
          @if (auth()->user()->hasPermission('governancemenu_view'))
        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-file-contract"></i> Governance</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                @if (auth()->user()->hasPermission('audit_view'))
                <a href="{{ route('admin.audit-reports.index') }}" class="nav-link">Audit Reports</a>
                @endif
                @if (auth()->user()->hasPermission('expense_view'))
                <a href="{{ route('admin.expenses.index') }}" class="nav-link">Expense Manager</a>
                @endif
                @if (auth()->user()->hasPermission('compliance_view'))
                <a href="{{ route('admin.compliance.index') }}" class="nav-link">Compliance Docs</a>
                @endif
            </div>
        </div>
        @endif
        @if (auth()->user()->hasPermission('mediamenu_view'))
        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-images"></i> Media & News</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                @if (auth()->user()->hasPermission('gallery_view'))
                <a href="{{ route('admin.gallery.index') }}" class="nav-link">Photo/Video Gallery</a>
                @endif
                @if (auth()->user()->hasPermission('blog_view'))
                <a href="{{ route('admin.blogs.index') }}" class="nav-link">Success Stories (Blog)</a>
                @endif
                @if (auth()->user()->hasPermission('press_view'))
                <a href="#" class="nav-link">Press Releases</a>
                @endif
            </div>
        </div>
        @endif

       @if (auth()->user()->hasPermission('frontendmenu_view'))
        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-images"></i> Frontend</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.about.index') }}" class="nav-link">About</a>
                <a href="{{ route('admin.blogs.index') }}" class="nav-link">Success Stories (Blog)</a>
                <a href="#" class="nav-link">Press Releases</a>
            </div>
        </div>
        @endif
    
     @if (auth()->user()->hasPermission('administration_view'))
        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-cogs"></i> Administration</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="{{ route('admin.members.index') }}" class="nav-link">User Roles & Access</a>
                <a href="http://127.0.0.1:8000/manage-roles" class="nav-link">User Role (ACL)</a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link">Global Settings</a>
                <a href="#" class="nav-link">API & Integrations</a>
            </div>
        </div>
        @endif

        <hr class="mx-3 border-light opacity-25">
        <a href="#" class="nav-link text-danger mb-5">
            <span><i class="fas fa-power-off"></i> Logout</span>
        </a>
    </div>
</nav>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const dropdownBtns = document.querySelectorAll(".dropdown-btn");
        const allLinks = document.querySelectorAll(".nav-link");
        dropdownBtns.forEach(btn => {
            btn.addEventListener("click", function() {
                const submenu = this.nextElementSibling;
                const arrow = this.querySelector(".arrow");
                const isOpened = submenu.style.display === "block";
                submenu.style.display = isOpened ? "none" : "block";
                arrow.classList.toggle("rotate", !isOpened);
            });
        });
        const currentUrl = window.location.href;
        allLinks.forEach(link => {
            if (link.href === currentUrl) {
                link.classList.add("active");
                const parentSubmenu = link.closest(".submenu");
                if (parentSubmenu) {
                    parentSubmenu.style.display = "block";
                    const parentBtn = parentSubmenu.previousElementSibling;
                    parentBtn.classList.add("active");
                    parentBtn.querySelector(".arrow").classList.add("rotate");
                }
            }
        });
    });
</script>



{{-- <nav id="sidebar">
    <div class="sidebar-header">
        <h4><span style="color:#ff4d4d">NGO</span> Member</h4>
    </div>

    <div class="custom-scroll">

        <a href="/dashboard" class="nav-link">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>

        <a href="" class="nav-link">
            <i class="fas fa-user"></i> My Profile
        </a>

        <div class="nav-item">
            <div class="nav-link dropdown-btn">
                <span><i class="fas fa-donate"></i> My Donations</span>
                <i class="fas fa-chevron-right arrow"></i>
            </div>
            <div class="submenu">
                <a href="" class="nav-link">Donation History</a>
                <a href="" class="nav-link">80G Certificate</a>
            </div>
        </div>

        <a href="" class="nav-link">
            <i class="fas fa-id-card"></i> Membership
        </a>

        <a href="" class="nav-link">
            <i class="fas fa-bullhorn"></i> Campaigns & Events
        </a>

        <a href="" class="nav-link">
            <i class="fas fa-file-alt"></i> Reports & Certificates
        </a>

        <a href="" class="nav-link">
            <i class="fas fa-headset"></i> Support
        </a>

        <hr>
        <a href="" class="nav-link text-danger">
            <i class="fas fa-power-off"></i> Logout
        </a>

    </div>
</nav> --}}