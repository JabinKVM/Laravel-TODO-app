<form method="post" action="{{ route('password.update') }}">

```
@csrf
@method('put')

<h3 style="margin-bottom:25px;">🔒 Change Password</h3>

<div style="max-width:600px;">

    <div style="margin-bottom:20px;">
        <label style="font-weight:600;">Current Password</label>

        <input
            type="password"
            name="current_password"
            class="form-control"
            style="padding:12px;"
            required>
    </div>

    <div style="margin-bottom:20px;">
        <label style="font-weight:600;">New Password</label>

        <input
            type="password"
            name="password"
            class="form-control"
            style="padding:12px;"
            required>
    </div>

    <div style="margin-bottom:20px;">
        <label style="font-weight:600;">Confirm Password</label>

        <input
            type="password"
            name="password_confirmation"
            class="form-control"
            style="padding:12px;"
            required>
    </div>

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
        Update Password
    </button>

</div>


</form>
