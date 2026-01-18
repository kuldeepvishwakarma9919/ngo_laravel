@extends('admin.masters.layouts.app')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-flex align-items-center justify-content-between mb-4">
            <h1 class="h4 text-gray-800 fw-bold">Create Blog</h1>
            <a href="{{ route('admin.expenses.index') }}" class="btn btn-sm btn-dark">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        <!-- Card -->
        <div class="card shadow-sm border-0">
            <div class="card-body">

                <form method="POST" enctype="multipart/form-data" action="{{ route('admin.expenses.store') }}">
                    @csrf

                    <input name="title" class="form-control mb-2" placeholder="Expense Title">

                    <input name="category" class="form-control mb-2" placeholder="Office / Event">

                    <input name="amount" type="number" class="form-control mb-2" placeholder="Amount">

                    <input type="date" name="expense_date" class="form-control mb-2">

                    <select name="payment_mode" class="form-control mb-2">
                        <option>Cash</option>
                        <option>Bank</option>
                        <option>UPI</option>
                    </select>

                    <input name="paid_to" class="form-control mb-2" placeholder="Paid To">

                    <input name="reference_no" class="form-control mb-2" placeholder="Reference No">

                    <input type="file" name="bill" class="form-control mb-2">

                    <textarea name="remarks" class="form-control mb-2" placeholder="Remarks"></textarea>

                    <button class="btn btn-success">Save Expense</button>
                </form>


            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script>
        document.getElementById('type').addEventListener('change', function() {
            if (this.value === 'video') {
                document.getElementById('fileInput').type = 'text';
                document.getElementById('fileInput').placeholder = 'Enter Video URL';
            } else {
                document.getElementById('fileInput').type = 'file';
            }
        });
    </script>
@endpush
