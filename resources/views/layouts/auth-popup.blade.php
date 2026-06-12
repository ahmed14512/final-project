<div class="auth-overlay" id="authOverlay" onclick="closeAuthPopup()"></div>

<div class="auth-popup" id="authPopup">

    {{------------------------------------ sign in panel ----------------------------------------}}
    <div class="auth-panel" id="panelSignIn">

        <button class="auth-close" onclick="closeAuthPopup()">
            <img src="{{ asset('images/icons/close-auth.svg') }}" alt="close" class="auth-close-icon">
        </button>

        <h2 class="auth-title">Sign In</h2>

        <form class="auth-form" id="formSignIn">

            {{-- Email --}}
            <div class="auth-field">
                <label class="auth-label">Email</label>
                <input type="email" class="auth-input" placeholder="youremail@example.com" required>
            </div>

            {{-- Password --}}
            <div class="auth-field">
                <label class="auth-label">Password</label>
                <div class="auth-input-wrap">
                    <input type="password" class="auth-input" id="signInPassword" placeholder="Enter your password" required>
                    <button type="button" class="eye-btn" onclick="togglePassword('signInPassword', this)">
                        <img src="{{ asset('images/icons/eye.svg') }}" alt="show" class="eye-icon">
                    </button>
                </div>
            </div>

            {{-- Forgot password --}}
            <div class="auth-forgot">
                <a href="#" onclick="showPanel('panelForgot')" class="auth-link">
                    Forgot Password?
                </a>
            </div>

            {{-- Sign in button --}}
            <button type="submit" class="auth-btn">Sign In</button>

            {{-- Switch to sign up --}}
            <p class="auth-switch">
                New to SmartPickz?
                <a href="#" class="auth-link fw-semibold"
                   onclick="showPanel('panelSignUp')">Sign Up</a>
            </p>

        </form>
    </div>
 

    {{------------------------------------ forgot password panel ----------------------------------------}}
    
    <div class="auth-panel d-none" id="panelForgot">

        <button class="auth-close" onclick="closeAuthPopup()">
            <img src="{{ asset('images/icons/close-auth.svg') }}" alt="close" class="auth-close-icon">
        </button>

        <button class="auth-back" onclick="showPanel('panelSignIn')">
            <img src="{{ asset('images/icons/arrow-left.svg') }}" alt="back" class="auth-back-icon">
            <span>Back to Sign In</span>
        </button>

        <h2 class="auth-title">Forgot Password</h2>
        <p class="auth-subtitle">Enter your email and we'll send you a reset link.</p>

        <form class="auth-form" id="formForgot">

            <div class="auth-field">
                <label class="auth-label">Email Address</label>
                <input type="email" class="auth-input" placeholder="youremail@example.com" required>
            </div>

            <button type="submit" class="auth-btn">Send Reset Link</button>

            <p class="auth-switch">Remember It?
                <a href="#" class="auth-link fw-semibold" onclick="showPanel('panelSignIn')" >Sign In</a>
            </p>
    </div>


    {{------------------------------------ sign up panel ----------------------------------------}}
    <div class="auth-panel d-none" id="panelSignUp">

        <button class="auth-close" onclick="closeAuthPopup()">
            <img src="{{ asset('images/icons/close-auth.svg') }}" alt="close" class="auth-close-icon">
        </button>

            <button class="auth-back" onclick="showpanel('panelSignIn')">
                <img src="{{ asset('images/icons/arrow-left.svg') }}" alt="back" class="auth-back-icon">
                <span>Back to Sign In</span>
            </button>

        <h2 class="auth-title">Create An Account</h2>

        <form class="auth-form" id="formSignUp">
            <div class="auth-row">
                <div class="auth-field">
                    <label class="auth-label">First Name</label>
                    <input type="text" class="auth-input" placeholder="John" Required>
                </div>

                <div class="auth-field">
                    <label class="auth-label">Last Name</label>
                    <input type="text" class="auth-input" placeholder="Silva" Required>
                </div>
            </div>

                <div class="auth-row">
                    <div class="auth-field">
                        <label class="auth-label">Contact Number</label>
                        <div class="auth-input-wrap">
                            <div class="phone-prefix">
                                <img src="{{ asset('images/icons/flag.svg') }}" alt="LK" class="flag-icon">
                                <span>+94</span>
                            </div>
                    
                            <input type="tel" class="auth-input auth-input-phone" placeholder="77 123 4567" required>
                        </div>
                    </div>

                    <div class="auth-field">
                        <label class="auth-label">Email Address</label>
                        <input type="email" class="auth-input" placeholder="you@example.com" Required>
                    </div>    
                </div>

            <div class="auth-field">
                <label class="auth-label">Password</label>
                <div class="auth-input-wrap ">
                    <input type="password" class="auth-input" id="signUpPassword" placeholder="Create a Password" Required>
                        
                    <button type="button" class="eye-btn" onclick="togglePassword('signUpPassword', this)">
                        <img src="{{ asset('images/icons/eye.svg') }}" alt="show" class="eye-icon">
                    </button>
                </div>

                 <p class="pw-hint">Password must be at least <b>8 characters</b> and include at least 3 of the following: <b>uppercase, lowercase, numbers, and special characters.</b>
                 </p>    
            </div>

            <div class="auth-field">
                    <label class="auth-label">Confirm Password</label>
                    <div class="auth-input-wrap">
                        <input type="password" class="auth-input" id="confirmPassword" placeholder="Repeat your password" oninput="checkConfirm(this)" required>
                        <button type="button" class="eye-btn" onclick="togglePassword('confirmPassword', this)">
                            <img src="{{ asset('images/icons/eye.svg') }}" alt="show" class="eye-icon">
                        </button>
                    </div>
                    <span class="pw-match-msg" id="confirmMsg"></span>
                </div>

                {{-- Sign up button --}}
                <button type="submit" class="auth-btn">Sign Up</button>

                {{-- Switch to sign in --}}
                <p class="auth-switch">
                    Have an account?
                    <a href="#" class="auth-link fw-semibold" onclick="showPanel('panelSignIn')">Sign In</a>
                </p>

                
        </form>
    </div>
</div>


<script>

    function openAuthPopup() {
        document.getElementById('authOverlay').classList.add('active');
        document.getElementById('authPopup').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAuthPopup() {
        document.getElementById('authOverlay').classList.remove('active');
        document.getElementById('authPopup').classList.remove('active');
        document.body.style.overflow = '';
    }

    //toggle password
    function togglePassword (inputId, btn){
        const input = document.getElementById(inputId);
        const icon = btn.querySelector('.eye-icon');

        if( input.type === 'password'){
            input.type = 'text';
            icon.src = "{{ asset('images/icons/eye-off.svg') }}";
        }
        else {
            input.type = 'password';
            icon.src = "{{ asset('images/icons/eye.svg') }}";
        }
    }

    function checkConfirm(input) {
        const pw  = document.getElementById('signUpPassword').value;
        const msg = document.getElementById('confirmMsg');
        if (input.value === pw && pw.length > 0) {
            msg.textContent = 'Passwords match';
            msg.className   = 'pw-match-msg match';
        } else {
            msg.textContent = 'Passwords do not match';
            msg.className   = 'pw-match-msg no-match';
        }
    }

        function showPanel(panelId) {
        document.querySelectorAll('.auth-panel').forEach(function (panel) {
            panel.classList.add('d-none');
        });
        document.getElementById(panelId).classList.remove('d-none');
    }

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') closeAuthPopup();
    });

   
</script>