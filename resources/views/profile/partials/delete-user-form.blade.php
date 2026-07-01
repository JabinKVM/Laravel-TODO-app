<form method="POST" action="{{ route('profile.destroy') }}">


@csrf
@method('delete')

<h3 style="color:#dc3545; margin-bottom:15px;">
    Delete Account
</h3>

<p style="color:#6b7280; margin-bottom:20px;">
    Enter your password to permanently delete your account.
</p>

<input
    type="password"
    name="password"
    placeholder="Enter your password"
    style="
        width:100%;
        padding:12px;
        border:1px solid #ccc;
        border-radius:8px;
        margin-bottom:20px;
    "
    required>

<button
    type="submit"
    onclick="return confirm('Are you sure you want to delete your account?')"
    style="
        background:#dc3545;
        color:white;
        border:none;
        padding:12px 24px;
        border-radius:8px;
        cursor:pointer;
    ">
    Delete Account
</button>


</form>
