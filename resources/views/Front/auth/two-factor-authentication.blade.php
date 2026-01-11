<x-front-layout title="Two-Factor Authentication">

    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <div class="card login-form">
                        <div class="card-body">
                            <div class="title">
                                <h3>Two-Factor Authentication</h3>
                                <p>Enhance your account security using 2FA.</p>
                            </div>
                            {{-- Error Messages --}}
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul class="mb-0">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            @if (!$user->two_factor_secret)
                                <div class="text-center py-3">
                                    <p class="mb-4 text-muted">Two-factor authentication adds an extra layer of security
                                        to your account by requiring more than just a password to log in.</p>
                                    <form action="{{ route('two-factor.enable') }}" method="post">
                                        @csrf
                                        <div class="button">
                                            <button class="btn" type="submit">Enable 2FA Now</button>
                                        </div>
                                    </form>
                                </div>

                            @elseif($user->two_factor_secret && !$user->two_factor_confirmed_at)
                                <div class="text-center">
                                    <div class="alert alert-warning mb-4">
                                        <strong>Action Required:</strong> Please scan the QR code and enter the
                                        verification code to finish setup.
                                    </div>
                                    <div class="mb-4 d-inline-block p-3 bg-white border rounded">
                                        {!! $user->twoFactorQrCodeSvg() !!}
                                    </div>
                                    <form action="/user/confirmed-two-factor-authentication" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label class="mb-2">Verification Code</label>
                                            <input class="form-control text-center" name="code" type="text"
                                                placeholder="123456" maxlength="6" required autofocus>
                                        </div>
                                        <div class="button mt-3">
                                            <button class="btn w-100" type="submit">Confirm & Activate</button>
                                        </div>
                                    </form>
                                </div>

                            @else
                                <div class="text-center py-3">
                                    <div class="mb-4">
                                        <i class="lni lni-shield text-success" style="font-size: 50px;"></i>
                                    </div>
                                    <h4 class="text-success mb-3">2FA is Fully Activated</h4>
                                    <p class="text-muted mb-4">Your account is now more secure. You can use recovery
                                        codes if you lose access to your device.</p>

                                    {{-- Dropdown / Collapse Button For Recovery Code --}}
                                    <div class="mb-4">
                                        <button class="btn btn-sm btn-outline-primary" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#recoveryCodesArea"
                                            aria-expanded="false text-center">
                                            <i class="lni lni-key"></i> Show Recovery Codes
                                        </button>
                                    </div>
                                    <div class="collapse" id="recoveryCodesArea">
                                        <div
                                            class="recovery-codes-box mb-4 text-start bg-light p-3 border rounded shadow-sm">
                                            <h6 class="small fw-bold mb-3 text-danger border-bottom pb-2">
                                                <i class="lni lni-warning"></i> Recovery Codes
                                            </h6>

                                            <div class="row g-2 mb-3" id="recovery-codes-list">
                                                @foreach ($user->recoveryCodes() as $code)
                                                    <div
                                                        class="col-6 small font-monospace text-dark border-bottom pb-1 mb-1">
                                                        {{ $code }}
                                                    </div>
                                                @endforeach
                                            </div>

                                            <div class="d-flex gap-2 justify-content-center border-top pt-3">
                                                <button class="btn btn-sm" style="background: #eee; color: #333;"
                                                    onclick="copyRecoveryCodes()">
                                                    <i class="lni lni-copy"></i> Copy All
                                                </button>

                                                <form method="POST" action="/user/two-factor-recovery-codes">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm"
                                                        style="background: #eee; color: #333;">
                                                        <i class="lni lni-reload"></i> New Codes
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="my-4">
                                    <form action="{{ route('two-factor.enable') }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <div class="button">
                                            <button class="btn " type="submit">Disable 2FA</button>
                                        </div>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            function copyRecoveryCodes() {
                const codes = [];
                document.querySelectorAll('#recovery-codes-list div').forEach(div => {
                    codes.push(div.innerText.trim());
                });
                const textToCopy = codes.join('\n');

                navigator.clipboard.writeText(textToCopy).then(() => {
                    alert('Success: All recovery codes copied to clipboard!');
                }).catch(err => {
                    console.error('Error copying: ', err);
                });
            }
        </script>
    @endpush
</x-front-layout>
