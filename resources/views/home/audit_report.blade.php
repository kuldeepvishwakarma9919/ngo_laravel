@extends('home.masters.layouts.app')
@section('title', 'Member Apply')
@push('styles')
    <style>
        .apply-header {
            background: linear-gradient(45deg, var(--primary), var(--ngo-green));
            color: white;
            padding: 60px 0;
            text-align: center;
            margin-bottom: -50px;
        }

        .report-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            transition: 0.3s;
            border-left: 5px solid var(--ngo-green);
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .report-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        .report-icon {
            font-size: 40px;
            color: var(--danger);
            margin-right: 20px;
        }

        .report-info h5 {
            margin: 0;
            font-weight: 700;
            color: var(--navy);
        }

        .report-info p {
            margin: 0;
            font-size: 13px;
            color: #777;
        }

        .btn-download {
            background: var(--ngo-green);
            color: white;
            border-radius: 8px;
            padding: 10px 20px;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-download:hover {
            background: var(--navy);
            color: white;
        }

        .stats-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .stats-table thead {
            background: var(--navy);
            color: white;
        }
    </style>
@endpush
@section('content')
    <div class="apply-header ">
        <div class="container">
            <h1 class="fw-bold">Member Membership Form</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>



    <div class="container" style="margin-top: 100px; margin-bottom: 100px">
        <div class="row">
            <div class="col-lg-8">
                <h3 class="fw-bold mb-4 text-navy">Annual Audit Reports</h3>

                <div class="report-card">
                    <div class="d-flex align-items-center">
                        <div class="report-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="report-info">
                            <h5>Audit Report F.Y. 2024-2025</h5>
                            <p>Verified by: Khanna & Associates (Chartered Accountants)</p>
                        </div>
                    </div>
                    <a href="reports/audit-2025.pdf" class="btn-download" download><i class="fa fa-download me-1"></i>
                        PDF</a>
                </div>

                <div class="report-card">
                    <div class="d-flex align-items-center">
                        <div class="report-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="report-info">
                            <h5>Audit Report F.Y. 2023-2024</h5>
                            <p>Full financial disclosure and balance sheet.</p>
                        </div>
                    </div>
                    <a href="reports/audit-2024.pdf" class="btn-download" download><i class="fa fa-download me-1"></i>
                        PDF</a>
                </div>

                <div class="report-card">
                    <div class="d-flex align-items-center">
                        <div class="report-icon"><i class="fa-solid fa-file-pdf"></i></div>
                        <div class="report-info">
                            <h5>Audit Report F.Y. 2022-2023</h5>
                            <p>Annual income and expenditure statement.</p>
                        </div>
                    </div>
                    <a href="reports/audit-2023.pdf" class="btn-download" download><i class="fa fa-download me-1"></i>
                        PDF</a>
                </div>
            </div>

            <div class="col-lg-4">
                <h3 class="fw-bold mb-4 text-navy">Expense Summary</h3>
                <div class="stats-table p-4">
                    <p class="small text-muted mb-3">Last Year Fund Utilization:</p>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">Education</span>
                            <span class="small">45%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 45%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">Health Care</span>
                            <span class="small">30%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 30%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">Food Drive</span>
                            <span class="small">15%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" style="width: 15%"></div>
                        </div>
                    </div>
                    <div class="mb-0">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="small fw-bold">Admin/Other</span>
                            <span class="small">10%</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" style="width: 10%"></div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-info mt-4 border-0 shadow-sm" style="border-radius: 15px;">
                    <i class="fa fa-info-circle me-2"></i>
                    <small>Humari reports FCRA aur Income Tax Act ke tahat audit ki jati hain.</small>
                </div>
            </div>
        </div>
    </div>
@endsection


