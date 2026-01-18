@extends('admin.masters.layouts.app')

@section('content')
<div class="container-fluid">

    <h1 class="h4 mb-4 fw-bold">Tax Certificates (80G)</h1>

    <div class="card shadow-sm">
        <div class="card-body table-responsive">

            <table class="table table-bordered table-hover align-middle">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Certificate No</th>
                        <th>Donor Name</th>
                        <th>Amount (₹)</th>
                        <th>Financial Year</th>
                        <th>Issued Date</th>
                        <th>Status</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($certificates as $key => $cert)
                        <tr>
                            <td>{{ $key + 1 }}</td>

                            <td class="fw-bold text-primary">
                                {{ $cert->certificate_no }}
                            </td>

                            <td>
                                {{ $cert->donation->donor_name ?? '-' }}
                            </td>

                            <td class="fw-bold text-success">
                                ₹ {{ $cert->donation->amount ?? 0 }}
                            </td>

                            <td>{{ $cert->financial_year }}</td>

                            <td>{{ $cert->issued_date->format('d M Y') }}</td>

                            <td>
                                <span class="badge bg-success">Issued</span>
                            </td>

                            <td>
                                <a href="{{ asset($cert->certificate_path) }}"
                                   target="_blank"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-eye"></i>
                                </a>

                                <a href="{{ asset($cert->certificate_path) }}"
                                   download
                                   class="btn btn-sm btn-success">
                                    <i class="fas fa-download"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                No Tax Certificates Found
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>

        </div>
    </div>

</div>
@endsection
