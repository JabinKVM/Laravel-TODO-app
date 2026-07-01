<form method="POST"
      action="{{ route('profile.update') }}"
      enctype="multipart/form-data">


@csrf
@method('patch')
<div style="
    display:flex;
    justify-content:space-between;
    align-items:flex-start;
    width:100%;
">

    <!-- LEFT SIDE -->
    <div style="
    width:65%;
">

        <h3 style="
            margin-bottom:25px;
            font-size:28px;
            font-weight:bold;
        ">
            Profile Information
        </h3>

        <!-- Name -->
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
            ">
                Name
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                style="
                    width:100%;
                    padding:14px;
                    border:1px solid #d1d5db;
                    border-radius:10px;
                    font-size:16px;
                ">
        </div>

        <!-- Email -->
        <div style="margin-bottom:20px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
            ">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                style="
                    width:100%;
                    padding:14px;
                    border:1px solid #d1d5db;
                    border-radius:10px;
                    font-size:16px;
                ">
        </div>

        <!-- Upload -->
        <div style="margin-bottom:25px;">

            <label style="
                display:block;
                margin-bottom:8px;
                font-weight:600;
            ">
                Upload New Photo
            </label>

            <input
                type="file"
                name="profile_photo"
                style="
                    width:100%;
                    padding:14px;
                    border:1px solid #d1d5db;
                    border-radius:10px;
                    background:white;
                ">
        </div>

        <!-- Save Button -->
        <button
            type="submit"
            style="
                background:#2563eb;
                color:white;
                border:none;
                padding:14px 30px;
                border-radius:10px;
                font-size:16px;
                font-weight:bold;
                cursor:pointer;
            ">
            Save Changes
        </button>

    </div>

    <!-- RIGHT SIDE -->
    <div style="
    width:220px;
    margin-left:auto;
    margin-top:89px;
    text-align:center;
">

    @if(Auth::user()->profile_photo)

        <img
            src="{{ asset('storage/' . Auth::user()->profile_photo) }}"
            alt="Profile"
            style="
                width:180px;
                height:180px;
                border-radius:50%;
                object-fit:cover;
                border:4px solid #d1d5db;
            ">

    @else

        <img
            src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&size=300"
            alt="Profile"
            style="
                width:180px;
                height:180px;
                border-radius:50%;
                object-fit:cover;
                border:4px solid #d1d5db;
            ">

    @endif

    <h4 style="margin-top:15px;">
        {{ Auth::user()->name }}
    </h4>

</div>
</div>
</form>