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


        .search-box {
            max-width: 500px;
            margin: -50px auto 40px;
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        #card-display-area {
            display: none;
            padding-bottom: 50px;
        }

        #id-card {
            width: 383px;
            height: 542px;
            background: white;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            margin: 0 auto;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.2);
            border: 1px solid #eee;
        }

        .card-top {
            background: var(--ngo-green);
            color: white;
            padding: 15px;
            border-bottom: 5px solid var(--danger);
            text-align: center;
        }

        .user-img {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 4px solid white;
            margin: 15px auto;
            overflow: hidden;
            background: #f0f0f0;
        }

        .user-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .card-info {
            padding: 10px 25px;
        }

        .info-item {
            font-size: 13px;
            margin-bottom: 6px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px dashed #ddd;
            padding-bottom: 2px;
        }

        .card-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #f8f9fa;
            padding: 10px;
            font-size: 10px;
            text-align: center;
            border-top: 1px solid #eee;
        }

        /* --- FOOTER STYLES --- */
        footer {
            background: #111;
            color: #ccc;
            padding: 50px 0 20px;
            margin-top: 50px;
        }

        .footer-logo {
            color: white;
            font-weight: 800;
            font-size: 22px;
            margin-bottom: 15px;
        }

        /* Buttons */
        .btn-search {
            background: var(--ngo-green);
            color: white;
            width: 100%;
            font-weight: 600;
            padding: 12px;
            border: none;
            border-radius: 8px;
            transition: 0.3s;
        }

        .btn-search:hover {
            background: #006400;
        }

        .btn-download {
            background: var(--danger);
            color: white;
            padding: 12px 35px;
            border-radius: 50px;
            border: none;
            font-weight: 600;
            margin-top: 25px;
            box-shadow: 0 5px 15px rgba(204, 0, 0, 0.3);
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
        <div class="search-box text-center">
            <label class="form-label fw-bold">Enter Registered Id Card</label>
            <input type="text" id="mobileInput" class="form-control form-control-lg text-center mb-3"
                placeholder="Id Card">
            <button class="btn-search" onclick="verifyMember()">VERIFY & GENERATE CARD</button>
            <div id="statusMsg" class="mt-3 small fw-bold"></div>
        </div>
    </div>

    <div id="card-display-area" class="container text-center">
        <div id="id-card">
            <div class="card-top">
                <h6 class="m-0 fw-bold">NGO DEMO SEVA SAMITI</h6>
                <small style="font-size: 9px; opacity: 0.9;">IDENTITY CARD</small>
            </div>

            <div class="user-img">
                <img id="mPhoto" src="" alt="Member Photo">
            </div>

            <div class="card-info text-start">
                <h5 class="text-center fw-bold mb-1" id="mName" style="color: var(--navy); text-transform: uppercase;">
                    ---</h5>
                <p class="text-center small fw-bold text-danger mb-3" id="mRole">VOLUNTEER</p>

                <div class="info-item"><strong>Member ID:</strong> <span id="mID">---</span></div>
                <div class="info-item"><strong>Mobile:</strong> <span id="mPhone">---</span></div>
                <div class="info-item"><strong>Blood Group:</strong> <span id="mBlood">---</span></div>
                <div class="info-item"><strong>Valid Till:</strong> <span class="text-success">Life Time</span></div>
            </div>


            <div class="mt-2">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data=VERIFIED-MEMBER" width="50"
                    alt="QR">
            </div>

            <div class="card-footer text-muted">
                <p class="m-0">Registered NGO under Govt. of India</p>
                <p class="m-0 fw-bold text-dark">www.ngodemo.org</p>
            </div>
        </div>

        <button class="btn-download shadow" onclick="saveAsImage()">
            <i class="fa fa-file-image me-2"></i> DOWNLOAD AS PHOTO
        </button>
    </div>
@endsection

@push('scripts')
    <script>
        function verifyMember() {
            const input = document.getElementById('mobileInput').value;
            const status = document.getElementById('statusMsg');
            const cardArea = document.getElementById('card-display-area');

            if (input === '') {
                status.innerHTML = '<span class="text-danger">Please enter ID Card No.</span>';
                cardArea.style.display = 'none';
                return;
            }

            status.innerHTML = '<span class="text-info">Checking member...</span>';

            fetch(`/get-member-by-idcard?id_card_no=${input}`)
                .then(res => res.json())
                .then(res => {
                    if (res.success) {
                        const member = res.member;
                        document.getElementById('mName').innerText = member.name;
                        document.getElementById('mID').innerText = member.id_card_no;
                        document.getElementById('mPhone').innerText = member.mobile;
                        document.getElementById('mBlood').innerText = member.blood;
                        document.getElementById('mRole').innerText = member.role;
                        document.getElementById('mPhoto').src = member.photo;

                        cardArea.style.display = 'block';
                        window.scrollTo({
                            top: cardArea.offsetTop - 100,
                            behavior: 'smooth'
                        });
                        status.innerHTML = '<span class="text-success">Member Found! Card Generated.</span>';
                    } else {
                        status.innerHTML = `<span class="text-danger">${res.message}</span>`;
                        cardArea.style.display = 'none';
                    }
                })
                .catch(err => {
                    console.error(err);
                    status.innerHTML = '<span class="text-danger">Something went wrong. Try again.</span>';
                    cardArea.style.display = 'none';
                });
        }
    </script>
@endpush
