<style>
    #sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        overflow-y: auto;
        display: flex;
        flex-direction: column;
        z-index: 1000;
    }

    #sidebar::-webkit-scrollbar {
        width: 5px;
    }

    #sidebar::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
    }
</style>
<nav id="sidebar">
    <div class="sidebar-header">
        <h4 class="mb-0 fw-bold"><span style="color:var(--ngo-red)">NGO</span> ADMIN</h4>
        <i class="fas fa-times" id="closeSidebar"></i>
    </div>

    <div class="mt-3 custom-scroll" style="height: 90vh; overflow-y: auto;">

        <a href="{{ route('admin.dashboard') }}" class="nav-link active">
            <i class="fas fa-chart-line"></i> Dashboard
        </a>
        <a href="{{ route('admin.donners.index') }}" class="nav-link"><i class="fas fa-hand-holding-heart"></i> All Donors</a>
        <a href="{{ route('admin.donors.donnerlist') }}" class="nav-link"><i class="fas fa-history"></i> Donation History</a>
        <a href="{{ route('admin.tex_certificates.index') }}" class="nav-link"><i class="fas fa-file-invoice-dollar"></i> Tax Certificates (80G)</a>
        {{-- <a href="#" class="nav-link"><i class="fas fa-redo"></i> Recurring Donations</a> --}}
        <a href="{{ route('admin.campaigns.index') }}" class="nav-link"><i class="fas fa-bullhorn"></i> Active Campaigns</a>
        <a href="{{ route('admin.crowdfunding-teams.index') }}" class="nav-link"><i class="fas fa-users-cog"></i> Crowdfunding Teams</a>
        <a href="{{ route('admin.goals.index') }}" class="nav-link"><i class="fas fa-piggy-bank"></i> Goal Tracking</a>
        <a href="{{ route('admin.events.index') }}" class="nav-link"><i class="fas fa-calendar-check"></i> Event
            Management</a>
        <a href="{{ route('admin.project-locations.index') }}" class="nav-link"><i class="fas fa-map-marked-alt"></i> Project Locations</a>
        <a href="{{ route('admin.volunteers.index') }}" class="nav-link"><i class="fas fa-user-friends"></i> Volunteer Database</a>
        <a href="{{ route('admin.beneficiaries.index') }}" class="nav-link"><i class="fas fa-tasks"></i> Beneficiary List</a>
        <a href="{{ route('admin.audit-reports.index') }}" class="nav-link"><i class="fas fa-file-contract"></i> Audit Reports</a>
        <a href="{{ route('admin.expenses.index') }}" class="nav-link"><i class="fas fa-receipt"></i> Expense Manager</a>
        <a href="{{ route('admin.compliance.index') }}" class="nav-link"><i class="fas fa-balance-scale"></i> Compliance Docs</a>
        <a href="{{ route('admin.gallery.index') }}" class="nav-link"><i class="fas fa-images"></i> Photo/Video
            Gallery</a>
        <a href="{{ route('admin.blogs.index') }}" class="nav-link"><i class="fas fa-blog"></i> Success Stories
            (Blog)</a>
        <a href="#" class="nav-link"><i class="fas fa-microphone"></i> Press Releases</a>
        <a href="{{ route('admin.members.index') }}" class="nav-link"><i class="fas fa-user-shield"></i> User Roles &
            Access</a>
        <a href="{{ route('admin.settings.index') }}" class="nav-link"><i class="fas fa-cogs"></i> Global Settings</a>
        <a href="#" class="nav-link"><i class="fas fa-database"></i> API & Integrations</a>

        <hr class="mx-3 border-light opacity-25">
        <a href="#" class="nav-link text-danger mb-5"><i class="fas fa-power-off"></i> Logout</a>
    </div>
</nav>
