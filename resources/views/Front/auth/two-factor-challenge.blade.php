<x-front-layout title="Two-Factor Verification">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="card login-form">
                        <div class="card-body">
                            <div class="title">
                                <h3>Two-Factor Verification</h3>
                                <p id="challenge-desc">Please enter the authentication code provided by your device.</p>
                            </div>
                            <form action="{{ route('two-factor.login') }}" method="post">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        {{ $errors->first() }}
                                    </div>
                                @endif
                                
                                {{-- 1. App Code Input (Visible by default) --}}
                                <div id="app-code-input" class="form-group input-group">
                                    <label for="reg-code">Authentication Code</label>
                                    <input class="form-control text-center" name="code" type="text" id="reg-code"
                                        placeholder="e.g. 123456" autofocus autocomplete="one-time-code">
                                </div>

                                {{-- 2. Recovery Code Input (Hidden by default) --}}
                                <div id="recovery-code-input" class="form-group input-group" style="display: none;">
                                    <label for="recovery-code">Recovery Code</label>
                                    <input class="form-control text-center" name="recovery_code" type="text"
                                        id="recovery-code" placeholder="Enter recovery code"
                                        autocomplete="one-time-code">
                                </div>

                                <div class="button">
                                    <button class="btn" type="submit">Verify & Login</button>
                                </div>
                            </form>

                            {{-- Toggle Links --}}
                            <div class="text-center mt-3">
                                <p class="text-muted small">
                                    <span id="toggle-to-recovery">
                                        Lost your device?
                                        <a href="javascript:void(0)" onclick="toggleForms(true)">Use a recovery code</a>
                                    </span>
                                    <span id="toggle-to-app" style="display: none;">
                                        Have your device?
                                        <a href="javascript:void(0)" onclick="toggleForms(false)">Use an app code</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function toggleForms(showRecovery) {
                const appInput = document.getElementById('app-code-input');
                const recoveryInput = document.getElementById('recovery-code-input');
                const appLink = document.getElementById('toggle-to-app');
                const recoveryLink = document.getElementById('toggle-to-recovery');
                const desc = document.getElementById('challenge-desc');

                if (showRecovery) {
                    appInput.style.display = 'none';
                    recoveryInput.style.display = 'block';
                    appLink.style.display = 'inline';
                    recoveryLink.style.display = 'none';
                    desc.innerText = 'Please enter one of your emergency recovery codes.';
                    // Clear app code input if any
                    document.getElementById('reg-code').value = '';
                } else {
                    appInput.style.display = 'block';
                    recoveryInput.style.display = 'none';
                    appLink.style.display = 'none';
                    recoveryLink.style.display = 'inline';
                    desc.innerText = 'Please enter the authentication code provided by your device.';
                    // Clear recovery code input if any
                    document.getElementById('recovery-code').value = '';
                }
            }
        </script>
    @endpush
</x-front-layout>
