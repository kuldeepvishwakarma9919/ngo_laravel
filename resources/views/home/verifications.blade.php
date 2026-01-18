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


        /* Report Cards */
        .verify-box {
            max-width: 600px;
            margin: 83px auto;
            background: white;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }

        .status-badge {
            display: inline-block;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 14px;
            margin-bottom: 20px;
        }

        .status-verified {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .status-failed {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .member-details-card {
            background: #f8f9fa;
            border: 1px solid #eee;
            border-radius: 15px;
            padding: 20px;
            display: none;
            text-align: left;
        }

        .member-photo {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid var(--ngo-green);
        }

        .btn-verify {
            background: var(--navy);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            width: 100%;
        }

        .btn-verify:hover {
            background: var(--ngo-green);
        }
    </style>
@endpush
@section('content')
    <div class="apply-header">
        <div class="container">
            <h1 class="fw-bold">Member Membership Form</h1>
            <p>Join our mission to create a positive impact in society.</p>
        </div>
    </div>




    <div class="container">
        <div class="verify-box text-center">
            <i class="fa fa-shield-halved fa-3x text-success mb-3"></i>
            <h3 class="fw-bold mb-4">Member Verification</h3>
            <p class="text-muted small">NGO Member ki authenticity check karne ke liye unka <b>Member ID</b> niche daalein.
            </p>

            <div class="mb-4">
                <input type="text" id="memberIDInput" class="form-control form-control-lg text-center"
                    placeholder="Example: NGO-LKO-001" style="text-transform: uppercase;">
            </div>

            <button class="btn-verify mb-4" onclick="handleVerification()">VERIFY NOW</button>

            <div id="resultArea">
                <div id="statusMsg"></div>

                <div class="member-details-card" id="memberCard">
                    <div class="d-flex align-items-center mb-3">
                        <img id="dispPhoto" src="" class="member-photo me-3" alt="Member">
                        <div>
                            <h5 class="m-0 fw-bold text-navy" id="dispName">---</h5>
                            <span class="text-danger small fw-bold" id="dispRole">---</span>
                        </div>
                    </div>
                    <div class="row g-2 small">
                        <div class="col-6 text-muted">Member ID:</div>
                        <div class="col-6 fw-bold text-end" id="dispID">---</div>
                        <div class="col-6 text-muted">Joining Year:</div>
                        <div class="col-6 fw-bold text-end" id="dispYear">2024</div>
                        <div class="col-6 text-muted">Status:</div>
                        <div class="col-6 text-end text-success fw-bold">ACTIVE MEMBER</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
function handleVerification() {
    const input = document.getElementById('memberIDInput').value.trim();
    const statusMsg = document.getElementById('statusMsg');
    const memberCard = document.getElementById('memberCard');

    fetch("{{ route('verify.member') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            member_id: input
        })
    })
    .then(res => res.json())
    .then(res => {
        if (res.status) {
            statusMsg.innerHTML =
                `<div class="status-badge status-verified">
                    <i class="fa fa-check-circle me-1"></i> VERIFIED MEMBER
                </div>`;

            document.getElementById('dispName').innerText = res.data.name;
            document.getElementById('dispRole').innerText = res.data.role;
            document.getElementById('dispID').innerText = res.data.id;
            document.getElementById('dispPhoto').src = res.data.photo;

            memberCard.style.display = 'block';
        } else {
            statusMsg.innerHTML =
                `<div class="status-badge status-failed">
                    <i class="fa fa-times-circle me-1"></i> RECORD NOT FOUND
                </div>`;
            memberCard.style.display = 'none';
        }
    });
}
</script>

@endpush
